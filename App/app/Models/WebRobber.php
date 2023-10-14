<?php

namespace App\Models;

use App\Enums\WebRobberStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebRobber
 *
 * @property int $id
 * @property string $domain
 * @property string $route
 * @property string $routeWithoutTheLastSyllable
 * @property string|null $message
 * @property \BenSampo\Enum\Enum|null $status
 * @property int $web_page_template_id
 * @property int $web_site_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\WebPageTemplate|null $webPageTemplate
 * @property-read \App\Models\WebSite|null $webSite
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber whereDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber whereRouteWithoutTheLastSyllable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber whereWebPageTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebRobber whereWebSiteId($value)
 * @mixin \Eloquent
 */
class WebRobber extends Model
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
    protected $casts = ['status' => WebRobberStatus::class];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function webSite(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(WebSite::class, 'id', 'web_site_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function webPageTemplate(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(WebPageTemplate::class, 'id', 'web_page_template_id');
    }
}
