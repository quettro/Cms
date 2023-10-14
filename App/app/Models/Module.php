<?php

namespace App\Models;

use App\Enums\ModuleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\Module
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $dateformat
 * @property string $timeformat
 * @property \BenSampo\Enum\Enum|null $type
 * @property string|null $route
 * @property string|null $child_route
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read String $a_route
 * @property-read \App\Collections\ModuleColumnCollection<int, \App\Models\ModuleColumn> $moduleColumns
 * @property-read int|null $module_columns_count
 * @property-read \App\Collections\ModuleDatabaseCollection<int, \App\Models\ModuleDatabase> $moduleDatabase
 * @property-read int|null $module_database_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModuleTemplate> $moduleTemplates
 * @property-read int|null $module_templates_count
 * @method static \Illuminate\Database\Eloquent\Builder|Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Module query()
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereChildRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereDateformat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereTimeformat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Module whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Module extends Model
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
    protected $casts = ['type' => ModuleType::class];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function moduleColumns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ModuleColumn::class, 'module_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function moduleTemplates(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ModuleTemplate::class, 'module_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function moduleDatabase(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ModuleDatabase::class, 'module_id');
    }

    /**
     * @return String
     */
    public function getARouteAttribute(): string
    {
        return WebPage::clearTheRouteOfExtraCharacters($this->route . '/' . $this->child_route);
    }
}
