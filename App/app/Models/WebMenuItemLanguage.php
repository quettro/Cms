<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebMenuItemLanguage
 *
 * @property int $id
 * @property string $name
 * @property string $route
 * @property int $is_enabled
 * @property string|null $blade
 * @property int $language_id
 * @property int $web_menu_item_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language|null $language
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage whereBlade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuItemLanguage whereWebMenuItemId($value)
 * @mixin \Eloquent
 */
class WebMenuItemLanguage extends Model
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
