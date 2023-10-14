<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\FormLanguage
 *
 * @property int $id
 * @property string|null $blade
 * @property int $language_id
 * @property int $form_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Form|null $form
 * @property-read string $formatted
 * @property-read \App\Models\Language|null $language
 * @method static \Illuminate\Database\Eloquent\Builder|FormLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FormLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|FormLanguage whereBlade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormLanguage whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormLanguage whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FormLanguage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FormLanguage extends Model
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
     * @var array
     */
    protected $appends = ['formatted'];

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
    public function form(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Form::class, 'id', 'form_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function language(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    /**
     * @return string
     */
    public function getFormattedAttribute(): string
    {
        $blade = <<<EOF
            @csrf <input type="hidden" name="_f" value="{$this->form->key}"> </form>
        EOF;
        return str($this->blade)->replace("</form>", $blade)->value();
    }
}
