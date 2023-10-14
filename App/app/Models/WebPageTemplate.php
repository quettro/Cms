<?php

namespace App\Models;

use App\Collections\WebPageTemplateCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebPageTemplate
 *
 * @property int $id
 * @property string $name
 * @property int $web_site_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebPageTemplateLanguage> $languages
 * @property-read int|null $languages_count
 * @property-read \App\Models\WebSite|null $webSite
 * @method static WebPageTemplateCollection<int, static> all($columns = ['*'])
 * @method static WebPageTemplateCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplate whereWebSiteId($value)
 * @mixin \Eloquent
 */
class WebPageTemplate extends Model
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
        return $this->hasMany(WebPageTemplateLanguage::class, 'web_page_template_id');
    }

    /**
     * @param array $models
     * @return WebPageTemplateCollection
     */
    public function newCollection(array $models = []): WebPageTemplateCollection
    {
        return new WebPageTemplateCollection($models);
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
