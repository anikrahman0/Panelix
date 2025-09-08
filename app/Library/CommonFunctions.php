<?php

namespace App\Library;

use Illuminate\Support\Str;
use App\Library\Traits\DiskTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class CommonFunctions
{
    /**
     * image uploads
     */
    use DiskTrait;


    public static function imageUpload($image, $path)
    {
        $instance = new self(); // if you're using a trait that initializes diskStorage
        $instance->diskInitialize();

        // Handle GdImage object
        if ($image instanceof \GdImage) {
            $tempDir = storage_path('app/temp-images');
            File::ensureDirectoryExists($tempDir);

            $tempFilename = 'user.jpg';
            $tempPath = $tempDir . '/' . $tempFilename;

            // Save GD image to temporary path
            imagejpeg($image, $tempPath, 90);

            // Convert to UploadedFile
            $image = new UploadedFile(
                $tempPath,
                $tempFilename,
                File::mimeType($tempPath),
                null,
                true
            );
        }

        // Now handle uploaded file
        $ext = $image->getClientOriginalExtension();
        $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = Str::slug($originalName) . '-' . time() . '.' . $ext;

        // Upload to cloud (e.g., S3)
        $storedPath = $instance->diskStorage->putFileAs($path, $image, $filename, 'public');

        // Delete temp file if it was created
        if (isset($tempPath) && File::exists($tempPath)) {
            File::delete($tempPath);
        }
        return $storedPath; // Or Storage::disk('s3')->url($storedPath) if you want full URL
    }

    public static function generateImage($name)
    {
        // Prepare the name for the text and file
        $nameText = strtoupper($name);
        $nameText = str_replace(' ', '', $nameText);
        $initialLength = config('profile-imagegenerator.name_initial_length', 2); // Default to 2 if not set
        $nameInitial = substr($nameText, 0, $initialLength); // For display
        $fileName = $nameInitial . time() . '.png'; // For saving

        // Image dimensions
        $width = min(config('profile-imagegenerator.img_width', 200), 512); // Max width 512
        $height = min(config('profile-imagegenerator.img_height', 200), 512); // Max height 512

        // Create the image
        $image = imagecreate($width, $height);

        // Random background color
        $background_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));

        // Determine text color based on background brightness
        $background_rgb = imagecolorsforindex($image, $background_color);
        $background_brightness = ($background_rgb['red'] * 299 + $background_rgb['green'] * 587 + $background_rgb['blue'] * 114) / 1000;

        $text_color = ($background_brightness > 128)
            ? imagecolorallocate($image, 0, 0, 0) // Dark text color for light background
            : imagecolorallocate($image, 255, 255, 255); // Light text color for dark background

        // Set the font file path and font size
        $fontFile = public_path('imagegenerator/fonts/' . config('profile-imagegenerator.font_file', 'LobsterTwo-Regular.ttf'));
        // Validate the font file
        if (!file_exists($fontFile)) {
            throw new \Exception("Font file not found: " . $fontFile);
        }

        // Check the file extension
        if (pathinfo($fontFile, PATHINFO_EXTENSION) !== 'ttf') {
            throw new \Exception("Invalid font file: '{$fontFile}'. Only .ttf files are supported.");
        }
        $fontSize = config('profile-imagegenerator.font_size', 60);

        // Text position
        $bbox = imagettfbbox($fontSize, 0, $fontFile, $nameInitial);
        $textWidth = abs($bbox[4] - $bbox[0]);
        $textHeight = abs($bbox[5] - $bbox[1]);
        $x = ($width - $textWidth) / 2;
        $y = ($height + $textHeight) / 2;

        // Add the text
        imagettftext($image, $fontSize, 0, $x, $y, $text_color, $fontFile, $nameInitial);
        $imagePath = trim(config('profile-imagegenerator.save_img_path', ''));
        if (empty($imagePath)) {
            $imagePath = 'imagegenerator/images';
        }

        // Save the image as PNG
        $imageDir = public_path(config('profile-imagegenerator.save_img_path', 'imagegenerator/images') . '/');
        // dd($imagePath);
        return self::imageUpload($image, $imagePath);
    }

    public static function generate_unique_slug($title, $modelName, $slugColumn)
    {
        if (!class_exists($modelName)) {
            throw new \InvalidArgumentException("Invalid model class: $modelName");
        }
        $slug = Str::slug($title, '-');
        $model = new $modelName;
        $count = $model::where($slugColumn, $slug)->count();
        $suffix = 2;
        while ($count > 0) {
            $newSlug = $slug . '-' . $suffix;
            $count = $model::where($slugColumn, $newSlug)->count();
            if ($count === 0) {
                $slug = $newSlug;
            }
            $suffix++;
        }

        return $slug;
    }
    public static function generate_unique_slug_update($id, $idColumnName, $title, $modelName, $slugColumn)
    {
        if (!class_exists($modelName)) {
            throw new \InvalidArgumentException("Invalid model class: $modelName");
        }
        $slug = Str::slug($title, '-');
        $model = new $modelName;
        $count = $model::where($slugColumn, $slug)->where($idColumnName, '!=', $id)->count();
        $suffix = 2;
        while ($count > 0) {
            $newSlug = $slug . '-' . $suffix;
            $count = $model::where($slugColumn, $newSlug)->where($idColumnName, '!=', $id)->count();
            if ($count === 0) {
                $slug = $newSlug;
            }
            $suffix++;
        }
        return $slug;
    }
}
