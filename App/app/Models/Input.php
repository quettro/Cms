<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\Input
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string|null $v_regex
 * @property string|null $v_not_regex
 * @property int $v_required
 * @property int $v_alpha
 * @property int $v_alpha_dash
 * @property int $v_alpha_num
 * @property int $v_string
 * @property int $v_numeric
 * @property int $v_email
 * @property int $v_boolean
 * @property int $v_accepted
 * @property int $v_ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InputLanguage> $languages
 * @property-read int|null $languages_count
 * @method static \Illuminate\Database\Eloquent\Builder|Input newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Input newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Input query()
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVAlpha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVAlphaDash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVAlphaNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVBoolean($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVNotRegex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVNumeric($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVRegex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Input whereVString($value)
 * @mixin \Eloquent
 */
class Input extends Model
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
     * @return HasMany
     */
    public function languages(): HasMany
    {
        return $this->hasMany(InputLanguage::class, 'input_id');
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

    /**
     * @return array
     */
    public function rules(): array
    {
        $_rules = [];

        if($this->v_required) {
            $_rules[] = 'required';
        }

        if(!$this->v_required) {
            $_rules[] = 'nullable';
        }

        if($this->v_regex && !is_null($this->v_regex) && $this->v_regex) {
            $_rules[] = 'regex:' . $this->v_regex;
        }

        if($this->v_not_regex && !is_null($this->v_not_regex) && $this->v_not_regex) {
            $_rules[] = 'not_regex:' . $this->v_not_regex;
        }

        if($this->v_alpha) {
            $_rules[] = 'alpha';
        }

        if($this->v_alpha_dash) {
            $_rules[] = 'alpha_dash';
        }

        if($this->v_alpha_num) {
            $_rules[] = 'alpha_num';
        }

        if($this->v_string) {
            $_rules[] = 'string';
        }

        if($this->v_numeric) {
            $_rules[] = 'numeric';
        }

        if($this->v_email) {
            $_rules[] = 'email';
        }

        if($this->v_boolean) {
            $_rules[] = 'boolean';
        }

        if($this->v_accepted) {
            $_rules[] = 'accepted';
        }

        if($this->v_ip) {
            $_rules[] = 'ip';
        }

        return $_rules;
    }
}
