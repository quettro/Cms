<?php

namespace App\Vendor\Timehollyname\FileManagement;

class File extends \SplFileInfo
{
    /**
     * @param Management $management
     * @param string $relative
     */
    public function __construct(public Management $management, public string $relative)
    {
        parent::__construct($management->storage()->path($relative));
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return $this->management->storage()->url($this->relative);
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {
        return $this->management->storage()->{$this->isDir() ? 'deleteDirectory' : 'delete'}($this->relative);
    }
}
