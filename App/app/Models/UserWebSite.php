<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\UserWebSite
 *
 * @property int $id
 * @property int $user_id
 * @property int $web_site_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserWebSite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWebSite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWebSite query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserWebSite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWebSite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWebSite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWebSite whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserWebSite whereWebSiteId($value)
 * @mixin \Eloquent
 */
class UserWebSite extends Model
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
