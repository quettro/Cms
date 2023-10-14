<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebVariable\StoreRequest;
use App\Http\Requests\WebVariable\UpdateRequest;
use App\Models\Language;
use App\Models\WebSite;
use App\Models\WebVariable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WebVariableController extends Controller
{
    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite): View|Factory|Application
    {
        return view('web.WebSite.WebVariable.index', [
            'webSite' => $webSite,
            'webVariables' => $webSite->webVariables()->paginate(),
        ]);
    }

    /**
     * @param StoreRequest $request
     * @param WebSite $webSite
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, WebSite $webSite): RedirectResponse
    {
        $validated = $request->validated();

        $webVariable = $webSite->webVariables()->create($validated);

        foreach (Language::all() as $language) {
            $webVariableLanguage = $webVariable->languages()->create(['language_id' => $language->id]);

            $webVariableLanguageVersion = $webVariableLanguage->version()->make($validated);
            $webVariableLanguageVersion->web_variable_language_id = $webVariableLanguage->id;
            $webVariableLanguageVersion->save();

            $webVariableLanguage->web_variable_language_version_id = $webVariableLanguageVersion->id;
            $webVariableLanguage->save();
        }

        $success = 'Переменная `' . $webVariable->name . '` успешно была создана.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Переменные` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webVariable->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-variables.show', [
            'webSite' => $webSite->id,
            'webVariable' => $webVariable->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function create(WebSite $webSite): View|Factory|Application
    {
        return view('web.WebSite.WebVariable.create', [
            'webSite' => $webSite,
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebVariable $webVariable
     * @return Application|Factory|View
     */
    public function show(Request $request, WebSite $webSite, WebVariable $webVariable): View|Factory|Application
    {
        return view('web.WebSite.WebVariable.detail', [
            'webSite' => $webSite,
            'webVariable' => $webVariable,
            'webVariableLanguage' => $webVariable->getLanguageForBlade($request->get('language')),
            'edit' => false,
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebVariable $webVariable
     * @return Application|Factory|View
     */
    public function edit(Request $request, WebSite $webSite, WebVariable $webVariable): View|Factory|Application
    {
        return view('web.WebSite.WebVariable.detail', [
            'webSite' => $webSite,
            'webVariable' => $webVariable,
            'webVariableLanguage' => $webVariable->getLanguageForBlade($request->get('language')),
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param WebSite $webSite
     * @param WebVariable $webVariable
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, WebSite $webSite, WebVariable $webVariable): RedirectResponse
    {
        $validated = $request->validated();

        $webVariableLanguage = $webVariable->languages->where('id', $validated['web_variable_language_id'])->firstOrFail();

        $webVariable->update($validated);

        $webVariableLanguageVersion = $webVariableLanguage->version()->make($validated);
        $webVariableLanguageVersion->web_variable_language_id = $webVariableLanguage->id;
        $webVariableLanguageVersion->save();

        $webVariableLanguage->web_variable_language_version_id = $webVariableLanguageVersion->id;
        $webVariableLanguage->save();

        $success = 'Переменная `' . $webVariable->name . '` успешно была обновлена.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Переменные` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webVariable->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @param WebVariable $webVariable
     * @return RedirectResponse
     */
    public function destroy(WebSite $webSite, WebVariable $webVariable): RedirectResponse
    {
        $webVariable->delete();

        $success = 'Переменная `' . $webVariable->name . '` успешно была удалена.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Переменные` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webVariable->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-variables.index', $webSite->id)
            ->with('toast:success', $success);
    }
}
