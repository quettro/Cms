<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ModuleType extends Enum
{
    /**
     *
     */
    const DEFAULT = 'DEFAULT';

    /**
     *
     */
    const GALLERY = 'GALLERY';

    /**
     *
     */
    const INDIVIDUAL = 'INDIVIDUAL';

    /**
     * @param $value
     * @return string
     */
    public static function getDescription($value): string
    {
        $array = [
            self::DEFAULT => 'Обычный',
            self::GALLERY => 'Галерея',
            self::INDIVIDUAL => 'Индивидуальные ( Возможность открывать каждую сущность на отдельной странице )',
        ];
        return $array[$value] ?? parent::getDescription($value);
    }
}
