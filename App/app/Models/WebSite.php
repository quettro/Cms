<?php

namespace App\Models;

use App\Collections\WebSiteCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebSite
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $domain
 * @property int $language_id
 * @property string $charset
 * @property string $dateformat
 * @property string $timeformat
 * @property string|null $head
 * @property string|null $body
 * @property string|null $ssl_certificate
 * @property string|null $ssl_certificate_key
 * @property int $enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language|null $language
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebBlock> $webBlocks
 * @property-read int|null $web_blocks_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebBreadcrumb> $webBreadcrumbs
 * @property-read int|null $web_breadcrumbs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebData> $webData
 * @property-read int|null $web_data_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebMenu> $webMenu
 * @property-read int|null $web_menu_count
 * @property-read \App\Collections\WebPageTemplateCollection<int, \App\Models\WebPageTemplate> $webPageTemplates
 * @property-read int|null $web_page_templates_count
 * @property-read \App\Collections\WebPageCollection<int, \App\Models\WebPage> $webPages
 * @property-read int|null $web_pages_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebPagination> $webPaginations
 * @property-read int|null $web_paginations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebResource> $webResources
 * @property-read int|null $web_resources_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebRobber> $webRobbers
 * @property-read int|null $web_robbers_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebVariable> $webVariables
 * @property-read int|null $web_variables_count
 * @method static WebSiteCollection<int, static> all($columns = ['*'])
 * @method static WebSiteCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereCharset($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereDateformat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereHead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereSslCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereSslCertificateKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereTimeformat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebSite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WebSite extends Model
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
    protected static string $orderByColumn = 'web_sites.id';

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webPages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebPage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webPageTemplates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebPageTemplate::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webData(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebData::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webMenu(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebMenu::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webBlocks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebBlock::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webBreadcrumbs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebBreadcrumb::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webPaginations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebPagination::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webVariables(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebVariable::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webResources(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebResource::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webRobbers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebRobber::class);
    }

    /**
     * @param array $models
     * @return WebSiteCollection
     */
    public function newCollection(array $models = []): WebSiteCollection
    {
        return new WebSiteCollection($models);
    }
}
