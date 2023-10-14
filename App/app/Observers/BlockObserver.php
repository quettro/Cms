<?php

namespace App\Observers;

use App\Models\Block;

class BlockObserver
{
    /**
     * @param Block $block
     * @return void
     */
    public function deleted(Block $block): void
    {
        $block->languages->each(static fn ($row) => $row->delete());
    }
}
