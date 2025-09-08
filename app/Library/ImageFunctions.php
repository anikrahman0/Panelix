<?php

namespace App\Library;

use Illuminate\Support\Str;
use App\Library\Traits\DiskTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Exception;

class ImageFunctions
{
    use DiskTrait;

    public static function uploadAndResize($image, $path, $sizes = [])
    {
        $instance = new self();
        $instance->diskInitialize();

        // Handle GdImage object
        if ($image instanceof \GdImage) {
            $tempDir = storage_path('app/temp-images');
            File::ensureDirectoryExists($tempDir);
            $tempPath = $tempDir . '/temp.jpg';
            imagejpeg($image, $tempPath, 90);
            $image = new UploadedFile($tempPath, 'temp.jpg', File::mimeType($tempPath), null, true);
        }

        $originalExt = strtolower($image->getClientOriginalExtension());
        $outputExt = ($originalExt === 'gif') ? 'gif' : 'webp';
        $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $baseFilename = Str::slug($originalName) . '-' . time();

        $sourceImage = self::createImageResource($image->getPathname(), $originalExt);
        if (!$sourceImage) {
            throw new Exception('Failed to create image resource from uploaded file');
        }

        $originalWidth = imagesx($sourceImage);
        $originalHeight = imagesy($sourceImage);

        // Always ensure we have original if requested
        if (!isset($sizes['original'])) {
            $sizes['original'] = ['width' => $originalWidth, 'height' => $originalHeight];
        }

        $results = [];

        foreach ($sizes as $type => $dimensions) {
            $filename = $baseFilename . '-' . $type . '.' . $outputExt;
            $tempPath = storage_path('app/temp-images/' . $filename);
            File::ensureDirectoryExists(dirname($tempPath));

            if ($type === 'original') {
                // Save original as-is (convert format if needed)
                self::saveImageResource($sourceImage, $tempPath, $outputExt);
            } else {
                // Resize with aspect ratio preserved
                $targetWidth = $dimensions['width'] ?? $originalWidth;
                $targetHeight = $dimensions['height'] ??
                    (int)($originalHeight * ($targetWidth / $originalWidth));

                $resizedImage = self::resizeImage(
                    $sourceImage,
                    $originalWidth,
                    $originalHeight,
                    $targetWidth,
                    $targetHeight
                );

                self::saveImageResource($resizedImage, $tempPath, $outputExt);
                imagedestroy($resizedImage);
            }

            $uploadedFile = new UploadedFile($tempPath, $filename, File::mimeType($tempPath), null, true);
            $results[$type] = $instance->diskStorage->putFileAs($path, $uploadedFile, $filename, 'public');
            File::delete($tempPath);
        }

        imagedestroy($sourceImage);
        return $results;
    }

    private static function createImageResource($imagePath, $extension)
    {
        try {
            switch ($extension) {
                case 'jpg':
                case 'jpeg': return @imagecreatefromjpeg($imagePath) ?: @imagecreatefromwebp($imagePath);
                case 'png':  return @imagecreatefrompng($imagePath);
                case 'gif':  return @imagecreatefromgif($imagePath);
                case 'webp': return @imagecreatefromwebp($imagePath);
                default:
                    return @imagecreatefromjpeg($imagePath)
                        ?: @imagecreatefrompng($imagePath)
                        ?: @imagecreatefromwebp($imagePath)
                        ?: @imagecreatefromgif($imagePath);
            }
        } catch (Exception $e) {
            Log::error('Image creation failed: ' . $e->getMessage(), ['path' => $imagePath, 'extension' => $extension]);
            return false;
        }
    }

    private static function saveImageResource($imageResource, $path, $format, $quality = 90)
    {
        if ($format !== 'gif') {
            imagealphablending($imageResource, false);
            imagesavealpha($imageResource, true);
        }

        switch ($format) {
            case 'webp': return imagewebp($imageResource, $path, $quality);
            case 'gif':  return imagegif($imageResource, $path);
            default:     return imagewebp($imageResource, $path, $quality);
        }
    }

    private static function resizeImage($sourceImage, $originalWidth, $originalHeight, $newWidth, $newHeight)
    {
        $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
        imagealphablending($resizedImage, false);
        imagesavealpha($resizedImage, true);
        $transparent = imagecolorallocatealpha($resizedImage, 0, 0, 0, 127);
        imagefilledrectangle($resizedImage, 0, 0, $newWidth, $newHeight, $transparent);

        imagecopyresampled(
            $resizedImage,
            $sourceImage,
            0, 0, 0, 0,
            $newWidth, $newHeight,
            $originalWidth, $originalHeight
        );

        return $resizedImage;
    }
}