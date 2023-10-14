<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\BlockLanguage
 *
 * @property int $id
 * @property int $language_id
 * @property int $block_id
 * @property int|null $block_language_version_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Block|null $block
 * @property-read \App\Models\Language|null $language
 * @property-read \App\Models\BlockLanguageVersion|null $version
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BlockLanguageVersion> $versions
 * @property-read int|null $versions_count
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguage whereBlockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguage whereBlockLanguageVersionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlockLanguage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BlockLanguage extends Model
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
    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function block(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Block::class, 'block_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function version(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BlockLanguageVersion::class, 'block_language_version_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function versions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BlockLanguageVersion::class, 'block_language_id');
    }
}
