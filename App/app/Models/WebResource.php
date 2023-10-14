<?php

namespace App\Models;

use App\Enums\ResourcePosition;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebResource
 *
 * @property int $id
 * @property int $index
 * @property \BenSampo\Enum\Enum|null $position
 * @property int $file_id
 * @property int $web_site_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\File|null $file
 * @method static \Illuminate\Database\Eloquent\Builder|WebResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebResource query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebResource whereFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebResource whereIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebResource wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebResource whereWebSiteId($value)
 * @mixin \Eloquent
 */
class WebResource extends Model
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
     * @return HasOne
     */
    public function file(): HasOne
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
