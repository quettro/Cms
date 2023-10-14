<?php

namespace App\Models;

use App\Collections\FormCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\Form
 *
 * @property int $id
 * @property string $key
 * @property string|null $redirect
 * @property array|null $addresses
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FormLanguage> $languages
 * @property-read int|null $languages_count
 * @method static FormCollection<int, static> all($columns = ['*'])
 * @method static FormCollection<int, static> get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Form newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Form newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Form query()
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereAddresses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereRedirect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Form extends Model
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
     * @var array
     */
    protected $guarded = ['id', 'updated_at', 'created_at'];

    /**
     * @var array|string[]
     */
    public static array $reserved = ['name', 'email', 'phone'];

    /**
     * @var string
     */
    protected static string $orderByColumn = 'id';

    /**
     * @var string
     */
    protected static string $orderByColumnDirection = 'desc';

    /**
     * @var array
     */
    protected $casts = ['addresses' => \App\Casts\AddressesCast::class];

    /**
     * @return HasMany
     */
    public function languages(): HasMany
    {
        return $this->hasMany(FormLanguage::class, 'form_id');
    }

    /**
     * @param array $models
     * @return FormCollection
     */
    public function newCollection(array $models = []): FormCollection
    {
        return new FormCollection($models);
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
