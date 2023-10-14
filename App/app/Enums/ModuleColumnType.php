<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ModuleColumnType extends Enum
{
    /**
     *
     */
    const _STRING = 'STRING';

    /**
     *
     */
    const _TEXT = 'TEXT';

    /**
     *
     */
    const _INTEGER = 'INTEGER';

    /**
     *
     */
    const _DATE = 'DATE';

    /**
     *
     */
    const _DATETIME = 'DATETIME';

    /**
     *
     */
    const _TIME = 'TIME';

    /**
     *
     */
    const _FILE = 'FILE';

    /**
     *
     */
    const _CODEMIRROR = 'CODEMIRROR';

    /**
     *
     */
    const _YOUTUBE = 'YOUTUBE';

    /**
     * @param $value
     * @return string
     */
    public static function getDescription($value): string
    {
        $array = [
            self::_STRING => '[ STRING ] Строковое поле',
            self::_TEXT => '[ TEXT ] Текстовое поле',
            self::_INTEGER => '[ INTEGER ] Числовое поле',
            self::_DATE => '[ DATE ] Дата',
            self::_DATETIME => '[ DATETIME ] Дата и время',
            self::_TIME => '[ TIME ] Время',
            self::_FILE => '[ FILE ] Файл',
            self::_CODEMIRROR => '[ CODEMIRROR ] Редактор кода',
            self::_YOUTUBE => '[ YOUTUBE ] Видео с youtube.com'
        ];
        return $array[$value] ?? parent::getDescription($value);
    }
}
