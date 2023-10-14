<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class WebRobberStatus extends Enum
{
    /**
     *
     */
    const QUEUE = 'QUEUE';

    /**
     *
     */
    const PROCESS = 'PROCESS';

    /**
     *
     */
    const COMPLETED = 'COMPLETED';

    /**
     * @param $value
     * @return string
     */
    public static function getDescription($value): string
    {
        $array = [
            self::QUEUE => 'В очереди',
            self::PROCESS => 'В процессе',
            self::COMPLETED => 'Завершенный',
        ];
        return $array[$value] ?? parent::getDescription($value);
    }
}
