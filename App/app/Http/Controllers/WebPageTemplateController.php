<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebPageTemplate\StoreRequest;
use App\Http\Requests\WebPageTemplate\UpdateRequest;
use App\Models\Language;
use App\Models\WebPageTemplate;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WebPageTemplateController extends Controller
{
    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.WebPageTemplate.index', [
            'webSite' => $webSite,
            'webPageTemplates' => $webSite->webPageTemplates()->paginate(),
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

        $webPageTemplate = $webSite->webPageTemplates()->create($validated['webpagetemplate']);

        foreach (Language::all() as $language) {
            $webPageTemplateLanguage = $webPageTemplate->languages()->create(['language_id' => $language->id]);

            $webPageTemplateLanguageVersion = $webPageTemplateLanguage->version()->make($validated['webpagetemplatelanguageversion']);
            $webPageTemplateLanguageVersion->web_page_template_language_id = $webPageTemplateLanguage->id;
            $webPageTemplateLanguageVersion->save();

            $webPageTemplateLanguage->web_page_template_language_version_id = $webPageTemplateLanguageVersion->id;
            $webPageTemplateLanguage->save();
        }

        $success = 'Шаблон `' . $webPageTemplate->name . '` успешно был создан.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Шаблоны страниц` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webPageTemplate->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-page-templates.show', [
            'webSite' => $webSite->id,
            'webPageTemplate' => $webPageTemplate->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function create(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.WebPageTemplate.create', [
            'webSite' => $webSite,
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebPageTemplate $webPageTemplate
     * @return Application|Factory|View
     */
    public function show(Request $request, WebSite $webSite, WebPageTemplate $webPageTemplate): Factory|View|Application
    {
        return view('web.WebSite.WebPageTemplate.detail', [
            'webSite' => $webSite,
            'webPageTemplate' => $webPageTemplate,
            'webPageTemplateLanguage' => $webPageTemplate->getLanguageForBlade($request->get('language')),
            'edit' => false,
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebPageTemplate $webPageTemplate
     * @return Application|Factory|View
     */
    public function edit(Request $request, WebSite $webSite, WebPageTemplate $webPageTemplate): Factory|View|Application
    {
        return view('web.WebSite.WebPageTemplate.detail', [
            'webSite' => $webSite,
            'webPageTemplate' => $webPageTemplate,
            'webPageTemplateLanguage' => $webPageTemplate->getLanguageForBlade($request->get('language')),
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param WebSite $webSite
     * @param WebPageTemplate $webPageTemplate
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, WebSite $webSite, WebPageTemplate $webPageTemplate): RedirectResponse
    {
        $validated = $request->validated();

        $webPageTemplateLanguage = $webPageTemplate->languages->where('id', $validated['web_page_template_language_id'])->firstOrFail();

        $webPageTemplate->update($validated['webpagetemplate']);

        $webPageTemplateLanguageVersion = $webPageTemplateLanguage->version()->make($validated['webpagetemplatelanguageversion']);
        $webPageTemplateLanguageVersion->web_page_template_language_id = $webPageTemplateLanguage->id;
        $webPageTemplateLanguageVersion->save();

        $webPageTemplateLanguage->web_page_template_language_version_id = $webPageTemplateLanguageVersion->id;
        $webPageTemplateLanguage->save();

        $success = 'Шаблон `' . $webPageTemplate->name . '` успешно был обновлен.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Шаблоны страниц` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webPageTemplate->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @param WebPageTemplate $webPageTemplate
     * @return RedirectResponse
     */
    public function destroy(WebSite $webSite, WebPageTemplate $webPageTemplate): RedirectResponse
    {
        $webPageTemplate->delete();

        $success = 'Шаблон `' . $webPageTemplate->name . '` успешно был удален.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Шаблоны страниц` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webPageTemplate->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-page-templates.index', $webSite->id)
            ->with('toast:success', $success);
    }
}
