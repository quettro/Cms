<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebPagination
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property int $web_site_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebPaginationLanguage> $languages
 * @property-read int|null $languages_count
 * @method static \Illuminate\Database\Eloquent\Builder|WebPagination newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPagination newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPagination query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPagination whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPagination whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPagination whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPagination whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPagination whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPagination whereWebSiteId($value)
 * @mixin \Eloquent
 */
class WebPagination extends Model
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
        return $this->hasMany(WebPaginationLanguage::class, 'web_pagination_id');
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
