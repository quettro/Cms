<?php

namespace App\Models;

use App\Collections\WebMenuItemCollection;
use App\Vendor\Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebMenuItem
 *
 * @property int $id
 * @property int $index
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property int $web_menu_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read WebMenuItemCollection<int, WebMenuItem> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WebMenuItemLanguage> $languages
 * @property-read int|null $languages_count
 * @property-read WebMenuItem|null $parent
 * @method static WebMenuItemCollection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem fixTree($root = null)
 * @method static WebMenuItemCollection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereIndex($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem whereWebMenuId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|WebMenuItem withoutRoot()
 * @mixin \Eloquent
 */
class WebMenuItem extends Model
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
    protected static string $orderByColumn = 'index';

    /**
     * @var string
     */
    protected static string $orderByColumnDirection = 'asc';

    /**
     * @return HasMany
     */
    public function languages(): HasMany
    {
        return $this->hasMany(WebMenuItemLanguage::class, 'web_menu_item_id');
    }

    /**
     * @param array $models
     * @return WebMenuItemCollection
     */
    public function newCollection(array $models = []): WebMenuItemCollection
    {
        return new WebMenuItemCollection($models);
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
