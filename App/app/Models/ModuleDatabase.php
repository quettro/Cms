<?php

namespace App\Models;

use App\Collections\ModuleDatabaseCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\ModuleDatabase
 *
 * @property int $id
 * @property int $module_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModuleDatabaseLanguage> $languages
 * @property-read int|null $languages_count
 * @property-read \App\Models\Module|null $module
 * @property-read \App\Collections\WebSiteCollection<int, \App\Models\WebSite> $webSites
 * @property-read int|null $web_sites_count
 * @method static ModuleDatabaseCollection<int, static> all($columns = ['*'])
 * @method static ModuleDatabaseCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabase query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabase whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabase whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ModuleDatabase extends Model
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
    protected static string $orderByColumn = 'module_databases.id';

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function webSites(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(WebSite::class, 'module_database_web_sites');
    }

    /**
     * @return HasMany
     */
    public function languages(): HasMany
    {
        return $this->hasMany(ModuleDatabaseLanguage::class, 'module_database_id');
    }

    /**
     * @param array $models
     * @return ModuleDatabaseCollection
     */
    public function newCollection(array $models = []): ModuleDatabaseCollection
    {
        return new ModuleDatabaseCollection($models);
    }

    /**
     * @param Int|null $language
     * @return Model|HasMany|null
     */
    public function getLanguageForBlade(?int $language): Model|HasMany|null
    {
        if (!is_null($language)) {
            if ($instance = $this->languages()->where(['id' => $language])->first()) {
                return $instance;
            }
        }
        return $this->languages()->first();
    }
}
