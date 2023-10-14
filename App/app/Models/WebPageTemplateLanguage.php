<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebPageTemplateLanguage
 *
 * @property int $id
 * @property int $language_id
 * @property int $web_page_template_id
 * @property int|null $web_page_template_language_version_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language|null $language
 * @property-read \App\Models\WebPageTemplateLanguageVersion|null $version
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebPageTemplateLanguageVersion> $versions
 * @property-read int|null $versions_count
 * @property-read \App\Models\WebPageTemplate|null $webPageTemplate
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguage whereWebPageTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguage whereWebPageTemplateLanguageVersionId($value)
 * @mixin \Eloquent
 */
class WebPageTemplateLanguage extends Model
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function webPageTemplate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WebPageTemplate::class, 'web_page_template_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function version(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WebPageTemplateLanguageVersion::class, 'web_page_template_language_version_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function versions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebPageTemplateLanguageVersion::class, 'web_page_template_language_id');
    }
}
