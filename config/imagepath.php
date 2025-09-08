<?php

return [

    // Mapping for the available storage disk names.
    // These values can be modified via your .env file.
    'storage_disks' => [
        'public'    => env('DISK_DEFAULT', 'public'),    // e.g., DISK_DEFAULT=public
        'do_spaces' => env('DISK_DO_SPACES', 'do_spaces'), // e.g., DISK_DO_SPACES=do_spaces
        'minio'     => env('AWS_DISK', 's3'),              // e.g., AWS_DISK=s3
    ],

    // User selects the storage disk key to use.
    // Set STORAGE_DISK in your .env file to one of: public, do_spaces, or minio.
    'select_storage_disk' => env('STORAGE_DISK', 'public'),

    'cdn_url' => env('CDN_URL'),
];
