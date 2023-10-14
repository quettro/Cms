<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\InputLanguage
 *
 * @property int $id
 * @property string|null $blade
 * @property int $language_id
 * @property int $input_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language|null $language
 * @method static \Illuminate\Database\Eloquent\Builder|InputLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InputLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InputLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|InputLanguage whereBlade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InputLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InputLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InputLanguage whereInputId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InputLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InputLanguage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InputLanguage extends Model
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
