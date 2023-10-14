<?php

namespace App\Observers;

use App\Models\Resource;

class ResourceObserver
{
    /**
     * @param Resource $resource
     * @return void
     */
    public function deleted(Resource $resource): void
    {
        $resource->file?->delete();
    }
}
