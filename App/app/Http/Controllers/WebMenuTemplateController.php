<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebMenuTemplate\StoreRequest;
use App\Http\Requests\WebMenuTemplate\UpdateRequest;
use App\Models\Language;
use App\Models\WebMenu;
use App\Models\WebMenuTemplate;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WebMenuTemplateController extends Controller
{
    /**
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite, WebMenu $webMenu): View|Factory|Application
    {
        return view('web.WebSite.WebMenuTemplate.index', [
            'webSite' => $webSite,
            'webMenu' => $webMenu,
            'webMenuTemplates' => $webMenu->webMenuTemplates()->paginate(),
        ]);
    }

    /**
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @return Application|Factory|View
     */
    public function create(WebSite $webSite, WebMenu $webMenu): View|Factory|Application
    {
        return view('web.WebSite.WebMenuTemplate.create', [
            'webSite' => $webSite,
            'webMenu' => $webMenu,
        ]);
    }

    /**
     * @param StoreRequest $request
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, WebSite $webSite, WebMenu $webMenu): RedirectResponse
    {
        $validated = $request->validated();

        $webMenuTemplate = $webMenu->webMenuTemplates()->make($validated['webMenuTemplate']);
        $webMenuTemplate->save();

        foreach (Language::all() as $language) {
            $webMenuTemplateLanguage = $webMenuTemplate->languages()->make($validated['webMenuTemplateLanguage']);
            $webMenuTemplateLanguage->language_id = $language->id;
            $webMenuTemplateLanguage->save();
        }

        $success = 'Шаблон `' . $webMenuTemplate->name . '` успешно был создан.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Шаблоны`, меню `'. $webMenu->name .'` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webMenuTemplate->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-menu.web-menu-templates.show', [
            'webSite' => $webSite->id,
            'webMenu' => $webMenu->id,
            'webMenuTemplate' => $webMenuTemplate->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @param WebMenuTemplate $webMenuTemplate
     * @return Application|Factory|View
     */
    public function show(Request $request, WebSite $webSite, WebMenu $webMenu, WebMenuTemplate $webMenuTemplate): View|Factory|Application
    {
        return view('web.WebSite.WebMenuTemplate.detail', [
            'webSite' => $webSite,
            'webMenu' => $webMenu,
            'webMenuTemplate' => $webMenuTemplate,
            'webMenuTemplateLanguage' => $webMenuTemplate->getLanguageForBlade($request->get('language')),
            'edit' => false,
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @param WebMenuTemplate $webMenuTemplate
     * @return Application|Factory|View
     */
    public function edit(Request $request, WebSite $webSite, WebMenu $webMenu, WebMenuTemplate $webMenuTemplate): View|Factory|Application
    {
        return view('web.WebSite.WebMenuTemplate.detail', [
            'webSite' => $webSite,
            'webMenu' => $webMenu,
            'webMenuTemplate' => $webMenuTemplate,
            'webMenuTemplateLanguage' => $webMenuTemplate->getLanguageForBlade($request->get('language')),
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @param WebMenuTemplate $webMenuTemplate
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, WebSite $webSite, WebMenu $webMenu, WebMenuTemplate $webMenuTemplate): RedirectResponse
    {
        $validated = $request->validated();

        $webMenuTemplate->update($validated['webMenuTemplate']);

        $webMenuTemplateLanguage = $webMenuTemplate->languages()->where(['id' => $validated['web_menu_template_language_id']])->firstOrFail();
        $webMenuTemplateLanguage->update($validated['webMenuTemplateLanguage']);

        $success = 'Шаблон `' . $webMenuTemplate->name . '` успешно был обновлен.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Шаблоны`, меню `'. $webMenu->name .'` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webMenuTemplate->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @param WebMenuTemplate $webMenuTemplate
     * @return RedirectResponse
     */
    public function destroy(WebSite $webSite, WebMenu $webMenu, WebMenuTemplate $webMenuTemplate): RedirectResponse
    {
        $webMenuTemplate->delete();

        $success = 'Шаблон `' . $webMenuTemplate->name . '` успешно был удален.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Шаблоны`, меню `'. $webMenu->name .'` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webMenuTemplate->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-menu.web-menu-templates.index', [
            'webSite' => $webSite->id,
            'webMenu' => $webMenu->id,
        ])
            ->with('toast:success', $success);
    }
}
