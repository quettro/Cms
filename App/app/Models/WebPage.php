<?php

namespace App\Models;

use App\Collections\WebPageCollection;
use App\Vendor\Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\WebPage
 *
 * @property int $id
 * @property string $name
 * @property string $route
 * @property string $a_route
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property int $web_site_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read WebPageCollection<int, WebPage> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebPageLanguage> $languages
 * @property-read int|null $languages_count
 * @property-read WebPage|null $parent
 * @property-read \App\Models\WebSite|null $webSite
 * @method static WebPageCollection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage fixTree($root = null)
 * @method static WebPageCollection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereARoute($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereRoute($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage whereWebSiteId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebPage withoutRoot()
 * @mixin \Eloquent
 */
class WebPage extends Model
{
    /**
     *
     */
    use NodeTrait;

    /**
     *
     */
    use HasFactory;

    /**
     * @var string[]
     */
    protected $guarded = ['id', 'updated_at', 'created_at'];

    /**
     * @var string
     */
    public static string $regexTheRouteForValidation = '([a-zA-Z0-9\-\_]+|[\/]{1})';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function webSite(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WebSite::class, 'web_site_id');
    }

    /**
     * @return HasMany
     */
    public function languages(): HasMany
    {
        return $this->hasMany(WebPageLanguage::class, 'web_page_id');
    }

    /**
     * @param array $models
     * @return WebPageCollection
     */
    public function newCollection(array $models = []): WebPageCollection
    {
        return new WebPageCollection($models);
    }

    /**
     * @param String|null $value
     * @return void
     */
    public function setRouteAttribute(?string $value): void
    {
        $this->attributes['route'] = self::clearTheRouteOfExtraCharacters($value);
    }

    /**
     * @param String|null $route
     * @return String
     */
    public static function clearTheRouteOfExtraCharacters(?String $route): String
    {
        return trim(preg_replace(['/(\/)+$/', '/^(\/)+/'], '', $route)) ?: '/';
    }

    /**
     * @param Int|null $language
     * @return Model|HasMany|null
     */
    public function getLanguageForBlade(?int $language): Model|HasMany|null
    {
        if (!is_null($language)) {
            if ($instance = $this->languages()->with('version')->where(['id' => $language])->first()) {
                return $instance;
            }
        }
        return $this->languages()->with('version')->first();
    }
}
