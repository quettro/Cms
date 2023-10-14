<?php

namespace App\Models;

use App\Enums\ResourcePosition;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\Resource
 *
 * @property int $id
 * @property int $index
 * @property \BenSampo\Enum\Enum|null $position
 * @property int $file_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\File|null $file
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource query()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Resource extends Model
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
    protected $casts = ['position' => ResourcePosition::class];

    /**
     * @var string[]
     */
    protected $guarded = ['id', 'updated_at', 'created_at'];

    /**
     * @var string
     */
    protected static string $orderByColumn = 'index';

    /**
     * @var string
     */
    protected static string $orderByColumnDirection = 'asc';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function file(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

    /**
     * @return bool
     */
    public function isPositionHead(): bool
    {
        return $this->position->is(ResourcePosition::HEAD);
    }

    /**
     * @return bool
     */
    public function isPositionBody(): bool
    {
        return $this->position->is(ResourcePosition::BODY);
    }

    /**
     * @return bool
     */
    public function isExtensionCss(): bool
    {
        return $this->file?->extension === 'css';
    }

    /**
     * @return bool
     */
    public function isExtensionJavascript(): bool
    {
        return $this->file?->extension === 'js';
    }
}
