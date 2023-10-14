<?php

namespace App\Collections;

class ModuleDatabaseCollection extends Collection
{
    /**
     * @param string $column
     * @return ModuleDatabaseCollection
     */
    public function groupByColumn(string $column): ModuleDatabaseCollection
    {
        return $this->groupBy(static fn ($moduleDatabase) => $moduleDatabase->translated->columns[$column]->value);
    }
}
