<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        'employees' => [
            'driver' => 'local',
            'root' => base_path().('public/uploads/employees/'),
            'url' => env('APP_URL').'/public',
            'visibility' => 'public',
            'throw' => false,
        ],

        'exports' => [
            'driver' => 'local',
            'root' => base_path().('public/uploads/exports/'),
            'url' => env('APP_URL').'/public',
            'visibility' => 'public',
            'throw' => false,
        ],

        'doctors' => [
            'driver' => 'local',
            'root' => base_path().('public/uploads/doctors/'),
            'url' => env('APP_URL').'/public',
            'visibility' => 'public',
            'throw' => false,
        ],

        'offers' => [
            'driver' => 'local',
            'root' => base_path().('public/uploads/offers/'),
            'url' => env('APP_URL').'/public',
            'visibility' => 'public',
            'throw' => false,
        ],
        'subspecialists' => [
            'driver' => 'local',
            'root' => base_path().('public/uploads/subspecialists/'),
            'url' => env('APP_URL').'/public',
            'visibility' => 'public',
            'throw' => false,
        ],

       'services' => [
            'driver' => 'local',
            'root' => base_path().('public/uploads/services/'),
            'url' => env('APP_URL').'/public',
            'visibility' => 'public',
            'throw' => false,
        ],

        

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
