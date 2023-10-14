<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebVariableLanguage
 *
 * @property int $id
 * @property int $language_id
 * @property int $web_variable_id
 * @property int|null $web_variable_language_version_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language|null $language
 * @property-read \App\Models\WebVariableLanguageVersion|null $version
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebVariableLanguageVersion> $versions
 * @property-read int|null $versions_count
 * @property-read \App\Models\WebVariable|null $webVariable
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguage whereWebVariableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebVariableLanguage whereWebVariableLanguageVersionId($value)
 * @mixin \Eloquent
 */
class WebVariableLanguage extends Model
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
        return $this->belongsTo(Language::class, 'language_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function webVariable(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WebVariable::class, 'web_variable_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function version(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WebVariableLanguageVersion::class, 'web_variable_language_version_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function versions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebVariableLanguageVersion::class, 'web_variable_language_id');
    }
}
