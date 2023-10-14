<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ModuleTemplateOrderBy extends Enum
{
    /**
     *
     */
    const ASC = 'ASC';

    /**
     *
     */
    const DESC = 'DESC';

    /**
     * @param $value
     * @return string
     */
    public static function getDescription($value): string
    {
        $array = [
            self::ASC => 'ASC ( Сортировать набор результатов в порядке возрастания )',
            self::DESC => 'DESC ( Сортировать набор результатов в порядке убывания )',
        ];
        return $array[$value] ?? parent::getDescription($value);
    }
}
