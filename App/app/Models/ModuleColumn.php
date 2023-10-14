<?php

namespace App\Models;

use App\Collections\ModuleColumnCollection;
use App\Enums\ModuleColumnType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\ModuleColumn
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property \BenSampo\Enum\Enum|null $type
 * @property int $table
 * @property int $required
 * @property int $module_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Module|null $module
 * @method static ModuleColumnCollection<int, static> all($columns = ['*'])
 * @method static ModuleColumnCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn whereTable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleColumn whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ModuleColumn extends Model
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
     * @var string[]
     */
    protected $casts = ['type' => ModuleColumnType::class];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    /**
     * @param array $models
     * @return ModuleColumnCollection
     */
    public function newCollection(array $models = []): ModuleColumnCollection
    {
        return new ModuleColumnCollection($models);
    }

    /**
     * @return bool
     */
    public function isTypeString(): bool
    {
        return $this->type->is(ModuleColumnType::_STRING);
    }

    /**
     * @return bool
     */
    public function isTypeText(): bool
    {
        return $this->type->is(ModuleColumnType::_TEXT);
    }

    /**
     * @return bool
     */
    public function isTypeInteger(): bool
    {
        return $this->type->is(ModuleColumnType::_INTEGER);
    }

    /**
     * @return bool
     */
    public function isTypeDate(): bool
    {
        return $this->type->is(ModuleColumnType::_DATE);
    }

    /**
     * @return bool
     */
    public function isTypeDateTime(): bool
    {
        return $this->type->is(ModuleColumnType::_DATETIME);
    }

    /**
     * @return bool
     */
    public function isTypeTime(): bool
    {
        return $this->type->is(ModuleColumnType::_TIME);
    }

    /**
     * @return bool
     */
    public function isTypeFile(): bool
    {
        return $this->type->is(ModuleColumnType::_FILE);
    }

    /**
     * @return bool
     */
    public function isTypeCodeMirror(): bool
    {
        return $this->type->is(ModuleColumnType::_CODEMIRROR);
    }

    /**
     * @return bool
     */
    public function isTypeYoutube(): bool
    {
        return $this->type->is(ModuleColumnType::_YOUTUBE);
    }
}
