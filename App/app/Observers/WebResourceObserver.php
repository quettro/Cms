<?php

namespace App\Observers;

use App\Models\WebResource;

class WebResourceObserver
{
    /**
     * @param WebResource $instance
     * @return void
     */
    public function deleted(WebResource $instance): void
    {
        $instance->file?->delete();
    }
}
