<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebPageLanguageVersion
 *
 * @property int $id
 * @property string|null $blade
 * @property string|null $additional_head
 * @property string|null $additional_body
 * @property int $web_page_language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\WebPageLanguage|null $language
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguageVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguageVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguageVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguageVersion whereAdditionalBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguageVersion whereAdditionalHead($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguageVersion whereBlade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguageVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguageVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguageVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageLanguageVersion whereWebPageLanguageId($value)
 * @mixin \Eloquent
 */
class WebPageLanguageVersion extends Model
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
        return $this->belongsTo(WebPageLanguage::class, 'web_page_language_id');
    }
}
