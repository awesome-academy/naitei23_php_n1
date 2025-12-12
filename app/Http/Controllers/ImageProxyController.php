<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ImageProxyController extends Controller
{
    /**
     * Proxy image from S3 or local storage
     */
    public function proxy(Request $request, string $path)
    {
        try {
            // Decode the path
            $decodedPath = base64_decode($path);
            
            if (!$decodedPath || !str_starts_with($decodedPath, 'images/')) {
                abort(404);
            }

            // Try local storage first
            if (Storage::disk('public')->exists($decodedPath)) {
                $file = Storage::disk('public')->get($decodedPath);
                $mimeType = Storage::disk('public')->mimeType($decodedPath);
                
                return response($file, 200)
                    ->header('Content-Type', $mimeType)
                    ->header('Cache-Control', 'public, max-age=31536000');
            }

            // Try S3
            $s3Configured = !empty(env('AWS_ACCESS_KEY_ID')) && 
                           !empty(env('AWS_SECRET_ACCESS_KEY')) && 
                           !empty(env('AWS_BUCKET'));
            
            if ($s3Configured && Storage::disk('s3')->exists($decodedPath)) {
                $file = Storage::disk('s3')->get($decodedPath);
                $mimeType = Storage::disk('s3')->mimeType($decodedPath);
                
                return response($file, 200)
                    ->header('Content-Type', $mimeType)
                    ->header('Cache-Control', 'public, max-age=31536000');
            }

            abort(404);
        } catch (\Exception $e) {
            \Log::error('Image proxy error: ' . $e->getMessage());
            abort(404);
        }
    }
}

