<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebPageTemplateLanguageVersion
 *
 * @property int $id
 * @property string|null $blade
 * @property int $web_page_template_language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguageVersion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguageVersion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguageVersion query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguageVersion whereBlade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguageVersion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguageVersion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguageVersion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebPageTemplateLanguageVersion whereWebPageTemplateLanguageId($value)
 * @mixin \Eloquent
 */
class WebPageTemplateLanguageVersion extends Model
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
