<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

class FileManager
{
    /**
     * @var string
     */
    public static string $disk = 'common';

    /**
     * @return \Illuminate\Contracts\Filesystem\Filesystem|\Illuminate\Filesystem\FilesystemAdapter
     */
    public static function storage(): \Illuminate\Contracts\Filesystem\Filesystem|\Illuminate\Filesystem\FilesystemAdapter
    {
        return Storage::disk(self::$disk);
    }
}
