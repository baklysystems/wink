<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Wink Database Connection
    |--------------------------------------------------------------------------
    |
    | This is the database connection you want Wink to use while storing &
    | reading your content. By default Wink assumes you've prepared a
    | new connection called "wink". However, you can change that
    | to anything you want.
    |
    */

    'database_connection' => env('WINK_DB_CONNECTION', 'wink'),

    /*
    |--------------------------------------------------------------------------
    | Wink Uploads Disk
    |--------------------------------------------------------------------------
    |
    | This is the storage disk Wink will use to put file uploads, you can use
    | any of the disks defined in your config/filesystems.php file. You may
    | also configure the path where the files should be stored.
    |
    */

    'storage_disk' => env('WINK_STORAGE_DISK', 'local'),

    'storage_path' => env('WINK_STORAGE_PATH', 'public/wink/images'),

    /*
    |--------------------------------------------------------------------------
    | Wink Path
    |--------------------------------------------------------------------------
    |
    | This is the URI prefix where Wink will be accessible from. Feel free to
    | change this path to anything you like.
    |
    */

    'path' => env('WINK_PATH', 'wink'),

    /*
    |--------------------------------------------------------------------------
    | Wink Middleware Group
    |--------------------------------------------------------------------------
    |
    | This is the middleware group that wink use.
    | By default is the web group a correct one.
    | It need at least the next middlewares
    | - StartSession
    | - ShareErrorsFromSession
    |
    */
    'middleware_group' => [
        "web",
        "auth"
    ],

    /*
    |
    |Guard to authenticate the routes by
    |
    */

    'guard'=>env('WINK_GUARD', 'web'),
    /*
    |
    |The column name for the column of foreign key belonging to the foreign table
    |
    */
    'foreign_auth_table_column' => env("WINK_AUTH_TABLE_COLUMN", "user_id"),
    /*
    |
    |The primary identifier for the foreign table
    |
    */
    'foreign_auth_table_column_id' => env("WINK_AUTH_TABLE_COLUMN_ID", "id"),
    /*
    |
    |The foreign table name
    |
    */
    'foreign_auth_table'=> env("WINK_AUTH_TABLE", "users")
];
