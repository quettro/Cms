<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\ModuleDatabaseLanguageColumn
 *
 * @property int $id
 * @property string|null $value
 * @property int $module_column_id
 * @property int $module_database_language_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\File|null $file
 * @property-read \App\Models\ModuleColumn|null $moduleColumn
 * @property-read \App\Models\ModuleDatabaseLanguage|null $moduleDatabaseLanguage
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguageColumn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguageColumn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguageColumn query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguageColumn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguageColumn whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguageColumn whereModuleColumnId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguageColumn whereModuleDatabaseLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguageColumn whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguageColumn whereValue($value)
 * @mixin \Eloquent
 */
class ModuleDatabaseLanguageColumn extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function file(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(File::class, 'id', 'value');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function moduleColumn(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ModuleColumn::class, 'id', 'module_column_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function moduleDatabaseLanguage(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ModuleDatabaseLanguage::class, 'id', 'module_database_language_id');
    }

    /**
     * @return string|null
     */
    public function formatTheValue(): ?string
    {
        if ($this->moduleColumn->isTypeDate()) {
            return date($this->moduleColumn->module->dateformat, strtotime($this->value));
        }
        else if ($this->moduleColumn->isTypeDateTime()) {
            return date($this->moduleColumn->module->dateformat . ' ' . $this->moduleColumn->module->timeformat, strtotime($this->value));
        }
        else if ($this->moduleColumn->isTypeFile()) {
            return $this->file?->link();
        }
        return $this->value;
    }
}
