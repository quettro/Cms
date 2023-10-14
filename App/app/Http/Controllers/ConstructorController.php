<?php

namespace App\Http\Controllers;

use App\Constructor;
use App\Http\Requests\Constructor\StoreRequest;
use App\Jobs\WebDataMailing;
use App\Models\Form;
use App\Models\Language;
use App\Models\WebPage;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ConstructorController extends Controller
{
    /**
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function index(): View|Factory|Redirector|RedirectResponse|Application
    {
        $constructor = new Constructor();
        $constructor->collect();

        return view('web.Constructor.index')
            ->with('constructor', $constructor);
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $form = Form::where(['key' => $request->input('_f')])->first();

        $attributes = $request->safe()->only(Form::$reserved);
        $attributes['all'] = $request->except(['_f', '_token']);
        $attributes['validated'] = $request->safe()->except(Form::$reserved);
        $attributes['ip'] = $request->ip();
        $attributes['referer'] = $request->header('referer');
        $attributes['form_id'] = $form?->id;

        $webSite = WebSite::where(['domain' => request()->getHttpHost(), 'enabled' => true])->firstOrFail();

        $referer = $attributes['referer'];
        $referer = WebPage::clearTheRouteOfExtraCharacters(str($referer)->explode($webSite->domain)->last());

        $language = str($referer)->explode('/')->first();
        $language = Language::where(['codename' => $language])->first() ?: $webSite->language;

        $webData = $webSite->webData()->make($attributes);
        $webData->language_id = $language->id;
        $webData->save();

        WebDataMailing::dispatch($webData);

        $redirect = $form?->redirect ? redirect($form->redirect) : redirect()->back();

        return $redirect->with('form:submitted', 'true');
    }
}
