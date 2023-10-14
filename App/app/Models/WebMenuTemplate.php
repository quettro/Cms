<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebMenuTemplate
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property int $web_menu_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebMenuTemplateLanguage> $languages
 * @property-read int|null $languages_count
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplate whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplate whereWebMenuId($value)
 * @mixin \Eloquent
 */
class WebMenuTemplate extends Model
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
     * @return HasMany
     */
    public function languages(): HasMany
    {
        return $this->hasMany(WebMenuTemplateLanguage::class, 'web_menu_template_id');
    }

    /**
     * @param Int|null $language
     * @return Model|HasMany|null
     */
    public function getLanguageForBlade(?int $language): Model|HasMany|null
    {
        if (!is_null($language)) {
            if ($instance = $this->languages()->where(['id' => $language])->first()) {
                return $instance;
            }
        }
        return $this->languages()->first();
    }
}
