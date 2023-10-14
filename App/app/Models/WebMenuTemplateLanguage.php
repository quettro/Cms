<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebMenuTemplateLanguage
 *
 * @property int $id
 * @property string|null $blade
 * @property string|null $blade_for_recursive
 * @property int $language_id
 * @property int $web_menu_template_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language|null $language
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplateLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplateLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplateLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplateLanguage whereBlade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplateLanguage whereBladeForRecursive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplateLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplateLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplateLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplateLanguage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebMenuTemplateLanguage whereWebMenuTemplateId($value)
 * @mixin \Eloquent
 */
class WebMenuTemplateLanguage extends Model
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
