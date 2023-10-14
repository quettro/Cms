<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebBlock
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property int $web_site_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebBlockLanguage> $languages
 * @property-read int|null $languages_count
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlock query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlock whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlock whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlock whereWebSiteId($value)
 * @mixin \Eloquent
 */
class WebBlock extends Model
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

    /**
     * @return HasMany
     */
    public function languages(): HasMany
    {
        return $this->hasMany(WebBlockLanguage::class, 'web_block_id');
    }

    /**
     * @param Int|null $language
     * @return Model|HasMany|null
     */
    public function getLanguageForBlade(?int $language): Model|HasMany|null
    {
        if (!is_null($language)) {
            if ($instance = $this->languages()->with('version')->where(['id' => $language])->first()) {
                return $instance;
            }
        }
        return $this->languages()->with('version')->first();
    }
}
