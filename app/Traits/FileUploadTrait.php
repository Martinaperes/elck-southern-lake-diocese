<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

trait FileUploadTrait
{
    /**
     * Upload an image to a specified directory and delete the old one if it exists.
     */
    public function uploadImage(UploadedFile $file, string $directory, ?string $oldPath = null, string $disk = 'public'): string
    {
        try {
            if ($oldPath) {
                $this->deleteFile($oldPath, $disk);
            }

            return $file->store($directory, $disk);
        } catch (\Exception $e) {
            Log::error("File upload failed: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Delete a file from a specified disk if it exists.
     */
    public function deleteFile(?string $path, string $disk = 'public'): bool
    {
        if (!$path) {
            return false;
        }

        try {
            // Support for both relative paths (in storage) and absolute paths (for legacy/custom files)
            if (strpos($path, 'http') === 0) {
                return false; // Don't try to delete external URLs
            }

            if (Storage::disk($disk)->exists($path)) {
                return Storage::disk($disk)->delete($path);
            }
            
            // Fallback for direct public path if storage disk doesn't find it (legacy support)
            $publicPath = public_path($path);
            if (file_exists($publicPath) && is_file($publicPath)) {
                return unlink($publicPath);
            }

            return false;
        } catch (\Exception $e) {
            Log::error("File deletion failed for path {$path}: " . $e->getMessage());
            return false;
        }
    }
}

