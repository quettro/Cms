<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\ModuleDatabaseWebSite
 *
 * @property int $id
 * @property int $web_site_id
 * @property int $module_database_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ModuleDatabase|null $moduleDatabase
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseWebSite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseWebSite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseWebSite query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseWebSite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseWebSite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseWebSite whereModuleDatabaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseWebSite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseWebSite whereWebSiteId($value)
 * @mixin \Eloquent
 */
class ModuleDatabaseWebSite extends Model
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
    protected static string $orderByColumn = 'module_database_web_sites.id';

    /**
     * @var string
     */
    protected static string $orderByColumnDirection = 'desc';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function moduleDatabase(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModuleDatabase::class, 'module_database_id');
    }
}
