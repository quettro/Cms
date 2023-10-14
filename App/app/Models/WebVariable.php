<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebVariable
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property int $web_site_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebVariableLanguage> $languages
 * @property-read int|null $languages_count
 * @property-read \App\Models\WebSite|null $webSite
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariable query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariable whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariable whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariable whereWebSiteId($value)
 * @mixin \Eloquent
 */
class WebVariable extends Model
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
    public function webSite(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WebSite::class, 'web_site_id');
    }

    /**
     * @return HasMany
     */
    public function languages(): HasMany
    {
        return $this->hasMany(WebVariableLanguage::class, 'web_variable_id');
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
