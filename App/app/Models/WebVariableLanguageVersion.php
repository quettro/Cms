<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebVariableLanguageVersion
 *
 * @property int $id
 * @property string $value
 * @property int $web_variable_language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguageVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguageVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguageVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguageVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguageVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguageVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguageVersion whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguageVersion whereWebVariableLanguageId($value)
 * @mixin \Eloquent
 */
class WebVariableLanguageVersion extends Model
{
    /**
     *
     */
    use HasFactory;

    /**
     *
     */
    use DefaultOrderBy;

    /**
     * @var string[]
     */
    protected $guarded = ['id', 'updated_at', 'created_at'];

    /**
     * @var string
     */
    protected static string $orderByColumn = 'id';

    /**
     * @var string
     */
    protected static string $orderByColumnDirection = 'desc';
}
