<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebBreadcrumb
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string|null $blade
 * @property int $web_site_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WebBreadcrumb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBreadcrumb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBreadcrumb query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBreadcrumb whereBlade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBreadcrumb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBreadcrumb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBreadcrumb whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBreadcrumb whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBreadcrumb whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBreadcrumb whereWebSiteId($value)
 * @mixin \Eloquent
 */
class WebBreadcrumb extends Model
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
}
