<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\BlockLanguageVersion
 *
 * @property int $id
 * @property string|null $blade
 * @property int $block_language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguageVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguageVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguageVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguageVersion whereBlade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguageVersion whereBlockLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguageVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguageVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguageVersion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BlockLanguageVersion extends Model
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
