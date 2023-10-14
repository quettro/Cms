<?php

namespace App\Observers;

use App\Models\File;

class FileObserver
{
    /**
     * @param File $file
     * @return void
     */
    public function deleted(File $file): void
    {
        if (File::whereAbsolute($file->absolute)->doesntExist()) $file->rm();
    }
}
