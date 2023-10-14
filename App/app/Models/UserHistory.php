<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\UserHistory
 *
 * @property int $id
 * @property string|null $message
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static Builder|UserHistory filter(\App\Filters\QueryFilter $filter)
 * @method static Builder|UserHistory newModelQuery()
 * @method static Builder|UserHistory newQuery()
 * @method static Builder|UserHistory query()
 * @method static Builder|UserHistory whereCreatedAt($value)
 * @method static Builder|UserHistory whereId($value)
 * @method static Builder|UserHistory whereMessage($value)
 * @method static Builder|UserHistory whereUpdatedAt($value)
 * @method static Builder|UserHistory whereUserId($value)
 * @mixin \Eloquent
 */
class UserHistory extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @param Builder $builder
     * @param QueryFilter $filter
     * @return Builder
     */
    public function scopeFilter(Builder $builder, QueryFilter $filter): Builder
    {
        return $filter->applyBuilder($builder);
    }
}
