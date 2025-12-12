<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExchangeRateService
{
    /**
     * Get VND to USD exchange rate
     * Uses cache to avoid too many API calls
     * 
     * @return float
     */
    public static function getVndToUsdRate(): float
    {
        // Cache for 1 hour (3600 seconds)
        return Cache::remember('vnd_to_usd_rate', 3600, function () {
            try {
                // Try ExchangeRate-API.com first (free, no API key needed for basic)
                $rate = self::fetchFromExchangeRateAPI();
                
                if ($rate) {
                    return $rate;
                }
            } catch (\Exception $e) {
                Log::warning('ExchangeRate-API.com failed, trying fallback', [
                    'error' => $e->getMessage()
                ]);
            }

            try {
                // Fallback to exchangerate.host (completely free, no API key)
                $rate = self::fetchFromExchangeRateHost();
                
                if ($rate) {
                    return $rate;
                }
            } catch (\Exception $e) {
                Log::warning('exchangerate.host failed', [
                    'error' => $e->getMessage()
                ]);
            }

            // If all APIs fail, return default rate
            Log::warning('All exchange rate APIs failed, using default rate');
            return config('services.stripe.vnd_to_usd_rate', 25000);
        });
    }

    /**
     * Fetch rate from ExchangeRate-API.com
     * Free tier: 1,500 requests/month, no API key needed
     * 
     * @return float|null
     */
    private static function fetchFromExchangeRateAPI(): ?float
    {
        $apiKey = config('services.exchange_rate.api_key');
        
        // If API key is provided, use it
        if ($apiKey) {
            $url = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/USD";
        } else {
            // Free tier without API key (limited)
            $url = "https://api.exchangerate-api.com/v4/latest/USD";
        }

        $response = Http::timeout(5)->get($url);

        if ($response->successful()) {
            $data = $response->json();
            
            // ExchangeRate-API.com returns rates where base is USD
            // So VND rate is in data['rates']['VND']
            if (isset($data['rates']['VND'])) {
                $vndRate = $data['rates']['VND'];
                // Convert: 1 USD = X VND, so to get VND to USD: 1 / X
                return (float) $vndRate;
            }
        }

        return null;
    }

    /**
     * Fetch rate from exchangerate.host
     * Completely free, no API key needed
     * 
     * @return float|null
     */
    private static function fetchFromExchangeRateHost(): ?float
    {
        $response = Http::timeout(5)->get('https://api.exchangerate.host/latest', [
            'base' => 'USD',
            'symbols' => 'VND'
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            if (isset($data['rates']['VND'])) {
                $vndRate = $data['rates']['VND'];
                return (float) $vndRate;
            }
        }

        return null;
    }

    /**
     * Clear cached exchange rate
     * Useful for testing or manual refresh
     */
    public static function clearCache(): void
    {
        Cache::forget('vnd_to_usd_rate');
    }

    /**
     * Get exchange rate with fallback to config
     * 
     * @return float
     */
    public static function getRate(): float
    {
        try {
            return self::getVndToUsdRate();
        } catch (\Exception $e) {
            Log::error('Failed to get exchange rate', [
                'error' => $e->getMessage()
            ]);
            
            // Fallback to config value
            return config('services.stripe.vnd_to_usd_rate', 25000);
        }
    }
}


