<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\ModuleDatabaseLanguage
 *
 * @property int $id
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property string|null $seo_keywords
 * @property string|null $seo_route
 * @property string|null $og_title
 * @property string|null $og_description
 * @property string|null $name_of_the_crumb
 * @property int|null $og_image_file_id
 * @property int $language_id
 * @property int $module_database_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Language|null $language
 * @property-read \App\Models\ModuleDatabase|null $moduleDatabase
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModuleDatabaseLanguageColumn> $moduleDatabaseLanguageColumns
 * @property-read int|null $module_database_language_columns_count
 * @property-read \App\Models\File|null $ogImageFile
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereModuleDatabaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereNameOfTheCrumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereOgDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereOgImageFileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereOgTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereSeoRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModuleDatabaseLanguage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ModuleDatabaseLanguage extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ogImageFile(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(File::class, 'id', 'og_image_file_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function moduleDatabase(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ModuleDatabase::class, 'module_database_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function moduleDatabaseLanguageColumns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ModuleDatabaseLanguageColumn::class, 'module_database_language_id', 'id');
    }
}
