<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ResourcePosition extends Enum
{
    /**
     *
     */
    const HEAD = 'HEAD';

    /**
     *
     */
    const BODY = 'BODY';

    /**
     * @param $value
     * @return string
     */
    public static function getDescription($value): string
    {
        $array = [
            self::HEAD => '< head>< /head>',
            self::BODY => '< body>< /body>',
        ];
        return $array[$value] ?? parent::getDescription($value);
    }
}
