<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebPageLanguage
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $keywords
 * @property string|null $og_title
 * @property string|null $og_description
 * @property string|null $name_of_the_crumb
 * @property string|null $redirect
 * @property int $is_home
 * @property int $is_enabled
 * @property int|null $og_image_file_id
 * @property int $language_id
 * @property int $web_page_id
 * @property int|null $web_page_template_id
 * @property int|null $web_page_language_version_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language|null $language
 * @property-read \App\Models\File|null $ogImageFile
 * @property-read \App\Models\WebPageLanguageVersion|null $version
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebPageLanguageVersion> $versions
 * @property-read int|null $versions_count
 * @property-read \App\Models\WebPage|null $webPage
 * @property-read \App\Models\WebPageTemplate|null $webPageTemplate
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereIsHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereNameOfTheCrumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereOgDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereOgImageFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereOgTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereRedirect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereWebPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereWebPageLanguageVersionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguage whereWebPageTemplateId($value)
 * @mixin \Eloquent
 */
class WebPageLanguage extends Model
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
    public function webPage(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WebPage::class, 'web_page_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ogImageFile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(File::class, 'id', 'og_image_file_id');
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
        return $this->belongsTo(WebPageLanguageVersion::class, 'web_page_language_version_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function versions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebPageLanguageVersion::class, 'web_page_language_id');
    }
}
