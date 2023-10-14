<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\DefaultModelSorting\Traits\DefaultOrderBy;

/**
 * App\Models\WebData
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property array|null $all
 * @property array|null $validated
 * @property string|null $referer
 * @property string|null $ip
 * @property int|null $form_id
 * @property int|null $language_id
 * @property int $web_site_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Form|null $form
 * @property-read \App\Models\Language|null $language
 * @property-read \App\Models\WebSite|null $webSite
 * @method static \Illuminate\Database\Eloquent\Builder|WebData filter($request)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WebData query()
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereAll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereReferer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereValidated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WebData whereWebSiteId($value)
 * @mixin \Eloquent
 */
class WebData extends Model
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
     * @var string[]
     */
    protected $casts = ['all' => 'array', 'validated' => 'array'];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function webSite(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(WebSite::class, 'id', 'web_site_id');
    }

    /**
     * @param $query
     * @param $request
     * @return mixed
     */
    public function scopeFilter($query, $request): mixed
    {
        if ($request->get('form_id'))
            $query = $query->whereFormId($request->get('form_id'));

        if ($request->get('language_id'))
            $query = $query->whereLanguageId($request->get('language_id'));

        if ($request->get('web_site_id'))
            $query = $query->whereWebSiteId($request->get('web_site_id'));

        return $query
            ->where(
                static fn ($query) => $query
                    ->where('name', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('email', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('phone', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('ip', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('referer', 'like', '%' . $request->get('search') . '%')
            );
    }
}
