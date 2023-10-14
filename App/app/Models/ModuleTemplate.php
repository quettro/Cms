<?php

namespace App\Models;

use App\Enums\ModuleTemplateOrderBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\ModuleTemplate
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property int $count
 * @property string|null $blade
 * @property int|null $order_by_column
 * @property \BenSampo\Enum\Enum|null|null $order_by
 * @property int $module_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Module|null $module
 * @property-read \App\Models\ModuleColumn|null $orderByColumn
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate whereBlade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate whereOrderBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate whereOrderByColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleTemplate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ModuleTemplate extends Model
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
    protected $casts = ['order_by' => ModuleTemplateOrderBy::class];

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
    public function module(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orderByColumn(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModuleColumn::class, 'order_by_column');
    }
}
