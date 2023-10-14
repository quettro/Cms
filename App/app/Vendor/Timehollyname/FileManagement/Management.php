<?php

namespace App\Vendor\Timehollyname\FileManagement;

class Management
{
    /**
     * @param string $disk
     */
    public function __construct(public string $disk)
    {
    }

    /**
     * @return \Illuminate\Contracts\Filesystem\Filesystem|\Illuminate\Filesystem\FilesystemAdapter
     */
    public function storage(): \Illuminate\Contracts\Filesystem\Filesystem|\Illuminate\Filesystem\FilesystemAdapter
    {
        return \Illuminate\Support\Facades\Storage::disk($this->disk);
    }

    /**
     * @param string $path
     * @return File
     */
    public function one(string $path): File
    {
        return new File($this, (new \League\Flysystem\WhitespacePathNormalizer())->normalizePath($path));
    }

    /**
     * @param string $path
     * @return bool
     */
    public function makeDirectory(string $path): bool
    {
        return $this->storage()->makeDirectory($path);
    }

    /**
     * @param string $path
     * @return \Illuminate\Support\Collection
     * @throws \League\Flysystem\FilesystemException
     */
    public function collection(string $path = ''): \Illuminate\Support\Collection
    {
        $collection = collect($this->storage()->listContents($path))->sortBy(['type', 'path']);

        return $collection->map(
            function ($item) {
                return $this->one($item->path());
            }
        )
        ->filter(
            function ($item) {
                return $item->isDir() || $item->isFile();
            }
        );
    }
}
