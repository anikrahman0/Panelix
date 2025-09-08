<?php

namespace App\Library\Traits;

use Illuminate\Support\Facades\Storage;

trait DiskTrait
{
    protected $disk;
    protected $diskStorage;
    protected $cdn_url;

    public function diskInitialize()
    {
        // Get the selected storage disk key from configuration.
        // This will default to "public" if STORAGE_DISK is not set.
        $selectedKey = config('imagepath.select_storage_disk', 'public');

        // Retrieve the mapping of available storage disks.
        $storageDisks = config('imagepath.storage_disks');

        // Determine the actual disk name:
        // If the selected key exists in storage_disks, use its value; otherwise, default to "public".
        $this->disk = isset($storageDisks[$selectedKey]) ? $storageDisks[$selectedKey] : 'public';

        // Initialize the storage disk using the determined disk name.
        $this->diskStorage = Storage::disk($this->disk);

        // Optionally, retrieve the CDN URL from configuration.
        $this->cdn_url = config('imagepath.cdn_url');
    }
}
