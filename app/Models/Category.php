<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_url',
    ];

    /**
     * Category owns many tours.
     */
    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, 'category_id');
    }

    /**
     * Get the full URL for the category image.
     * Automatically handles both S3 and local storage.
     */
    public function getImageUrlAttribute($value): ?string
    {
        if (!$value) {
            return null;
        }

        // If already a full URL (http/https), return as is
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }

        // If path starts with 'images/', check local storage first, then S3
        if (str_starts_with($value, 'images/')) {
            // Priority 1: Check local storage first (most reliable)
            if (Storage::disk('public')->exists($value)) {
                return Storage::disk('public')->url($value);
            }
            
            // Priority 2: Try S3 if configured
            $s3Configured = !empty(env('AWS_ACCESS_KEY_ID')) && !empty(env('AWS_SECRET_ACCESS_KEY')) && !empty(env('AWS_BUCKET'));
            
            if ($s3Configured) {
                try {
                    // Check if file exists in S3
                    if (Storage::disk('s3')->exists($value)) {
                        // Use proxy route to serve S3 images (since bucket may not be public)
                        // This allows Laravel to fetch from S3 using credentials
                        return route('image.proxy', ['path' => base64_encode($value)]);
                    }
                } catch (\Exception $e) {
                    \Log::warning('S3 URL generation failed: ' . $e->getMessage());
                }
            }
            
            // Last fallback: try asset() for backward compatibility
            return asset($value);
        }

        // For paths that don't start with 'images/', try local storage first
        if (Storage::disk('public')->exists($value)) {
            return Storage::disk('public')->url($value);
        }

        // Final fallback to asset() for backward compatibility
        return asset($value);
    }
}


