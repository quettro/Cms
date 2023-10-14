<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebPage\StoreRequest;
use App\Http\Requests\WebPage\UpdateRequest;
use App\Models\File;
use App\Models\Language;
use App\Models\WebPage;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WebPageController extends Controller
{
    /**
     * @param WebSite $webSite
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function index(WebSite $webSite): \Illuminate\Contracts\View\View|Factory|Application
    {
        return view('web.WebSite.WebPage.index', [
            'webSite' => $webSite,
            'webPages' => $webSite->webPages->toTree(),
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request, WebSite $webSite): \Illuminate\Contracts\View\View|Factory|Application
    {
        return view('web.WebSite.WebPage.create', [
            'webSite' => $webSite,
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

        if ($request->hasFile('webpagelanguage.og_image')) {
            $validated['webpagelanguage']['og_image_file_id'] = File::store($request->file('webpagelanguage.og_image'))->id;
        }

        $webPage = $webSite->webPages()->create($validated['webpage']);

        foreach (Language::all() as $language) {
            $webPageLanguage = $webPage->languages()->make($validated['webpagelanguage']);
            $webPageLanguage->language_id = $language->id;
            $webPageLanguage->save();

            $webPageLanguageVersion = $webPageLanguage->version()->make($validated['webpagelanguageversion']);
            $webPageLanguageVersion->web_page_language_id = $webPageLanguage->id;
            $webPageLanguageVersion->save();

            $webPageLanguage->web_page_language_version_id = $webPageLanguageVersion->id;
            $webPageLanguage->save();
        }

        $success = 'Страница `' . $webPage->name . '` успешно была создана.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Страницы` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webPage->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-pages.show', [
            'webSite' => $webSite->id,
            'webPage' => $webPage->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebPage $webPage
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, WebSite $webSite, WebPage $webPage): \Illuminate\Contracts\View\View|Factory|Application
    {
        $webPages = $webSite->webpages()
            ->whereNotIn('id', array_merge([$webPage->id], $webPage->descendants->pluck('id')->toArray()))->get();

        return view('web.WebSite.WebPage.detail', [
            'webSite' => $webSite,
            'webPage' => $webPage,
            'webPageLanguage' => $webPage->getLanguageForBlade($request->get('language')),
            'webPages' => $webPages,
            'edit' => false,
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebPage $webPage
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, WebSite $webSite, WebPage $webPage): \Illuminate\Contracts\View\View|Factory|Application
    {
        $webPages = $webSite->webpages()
            ->whereNotIn('id', array_merge([$webPage->id], $webPage->descendants->pluck('id')->toArray()))->get();

        return view('web.WebSite.WebPage.detail', [
            'webSite' => $webSite,
            'webPage' => $webPage,
            'webPageLanguage' => $webPage->getLanguageForBlade($request->get('language')),
            'webPages' => $webPages,
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param WebSite $webSite
     * @param WebPage $webPage
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, WebSite $webSite, WebPage $webPage): RedirectResponse
    {
        $validated = $request->validated();

        $webPageLanguage = $webPage->languages();
        $webPageLanguage = $webPageLanguage->where('id', $validated['web_page_language_id'])->firstOrFail();

        if ($request->hasFile('webpagelanguage.og_image')) {
            $validated['webpagelanguage']['og_image_file_id'] = File::store($request->file('webpagelanguage.og_image'))->id;
        }

        $webPage->update($validated['webpage']);
        $webPageLanguage->update($validated['webpagelanguage']);

        $webPageLanguageVersion = $webPageLanguage->version()->make($validated['webpagelanguageversion']);
        $webPageLanguageVersion->web_page_language_id = $webPageLanguage->id;
        $webPageLanguageVersion->save();

        $webPageLanguage->web_page_language_version_id = $webPageLanguageVersion->id;
        $webPageLanguage->save();

        $success = 'Страница `' . $webPage->name . '` успешно была обновлена.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Страницы` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webPage->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @param WebPage $webPage
     * @return RedirectResponse
     */
    public function destroy(WebSite $webSite, WebPage $webPage): RedirectResponse
    {
        $webPage->delete();

        $success = 'Страница `' . $webPage->name . '` успешно была удалена.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Страницы` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webPage->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-pages.index', $webSite->id)
            ->with('toast:success', $success);
    }
}
