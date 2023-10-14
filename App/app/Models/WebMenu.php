<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebMenu
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property int $web_site_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Collections\WebMenuItemCollection<int, \App\Models\WebMenuItem> $webMenuItems
 * @property-read int|null $web_menu_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebMenuTemplate> $webMenuTemplates
 * @property-read int|null $web_menu_templates_count
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenu whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenu whereWebSiteId($value)
 * @mixin \Eloquent
 */
class WebMenu extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webMenuItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebMenuItem::class, 'web_menu_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function webMenuTemplates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebMenuTemplate::class, 'web_menu_id');
    }
}
