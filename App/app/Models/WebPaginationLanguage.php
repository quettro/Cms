<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebPaginationLanguage
 *
 * @property int $id
 * @property string|null $blade
 * @property int $language_id
 * @property int $web_pagination_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language|null $language
 * @method static \Illuminate\Database\Eloquent\Builder|WebPaginationLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPaginationLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPaginationLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPaginationLanguage whereBlade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPaginationLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPaginationLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPaginationLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPaginationLanguage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPaginationLanguage whereWebPaginationId($value)
 * @mixin \Eloquent
 */
class WebPaginationLanguage extends Model
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
    public function language(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }
}
