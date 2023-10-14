<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebBlockLanguage
 *
 * @property int $id
 * @property int $language_id
 * @property int $web_block_id
 * @property int|null $web_block_language_version_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language|null $language
 * @property-read \App\Models\WebBlockLanguageVersion|null $version
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebBlockLanguageVersion> $versions
 * @property-read int|null $versions_count
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguage whereWebBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebBlockLanguage whereWebBlockLanguageVersionId($value)
 * @mixin \Eloquent
 */
class WebBlockLanguage extends Model
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
     * @var array
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
    public function version(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WebBlockLanguageVersion::class, 'web_block_language_version_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function versions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WebBlockLanguageVersion::class, 'web_block_language_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
