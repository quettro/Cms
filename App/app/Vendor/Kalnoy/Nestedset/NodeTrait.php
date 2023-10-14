<?php

namespace App\Vendor\Kalnoy\Nestedset;

trait NodeTrait
{
    /**
     *
     */
    use \Kalnoy\Nestedset\NodeTrait;

    /**
     * @return void
     */
    protected function deleteDescendants(): void
    {
        $lft = $this->getLft();
        $rgt = $this->getRgt();

        $method = $this->usesSoftDelete() && $this->forceDeleting
            ? 'forceDelete'
            : 'delete';

        $this->descendants()->each(static fn ($descendant) => $descendant->{$method}());

        if ($this->hardDeleting()) {
            $height = $rgt - $lft + 1;

            $this->newNestedSetQuery()->makeGap($rgt + 1, -$height);

            // In case if user wants to re-create the node
            $this->makeRoot();

            static::$actionsPerformed++;
        }
    }
}
