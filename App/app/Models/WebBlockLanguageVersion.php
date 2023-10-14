<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebBlockLanguageVersion
 *
 * @property int $id
 * @property string|null $blade
 * @property int $web_block_language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguageVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguageVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguageVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguageVersion whereBlade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguageVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguageVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguageVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguageVersion whereWebBlockLanguageId($value)
 * @mixin \Eloquent
 */
class WebBlockLanguageVersion extends Model
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
     * @var array
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
