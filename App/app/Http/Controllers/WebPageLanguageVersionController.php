<?php

namespace App\Http\Controllers;

use App\Models\WebPage;
use App\Models\WebPageLanguageVersion;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WebPageLanguageVersionController extends Controller
{
    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebPage $webPage
     * @return Application|Factory|View
     */
    public function index(Request $request, WebSite $webSite, WebPage $webPage): View|Factory|Application
    {
        $webPageLanguage = $webPage->getLanguageForBlade($request->get('language'));
        $webPageLanguageVersions = $webPageLanguage->versions()->orderBy('id', 'desc')->get();

        return view('web.WebSite.WebPageVersion.index', [
            'webSite' => $webSite,
            'webPage' => $webPage,
            'webPageLanguage' => $webPageLanguage,
            'webPageLanguageVersions' => $webPageLanguageVersions,
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebPage $webPage
     * @param WebPageLanguageVersion $webPageLanguageVersion
     * @return Application|Factory|View
     */
    public function show(Request $request, WebSite $webSite, WebPage $webPage, WebPageLanguageVersion $webPageLanguageVersion): View|Factory|Application
    {
        return view('web.WebSite.WebPageVersion.show', [
            'webSite' => $webSite,
            'webPage' => $webPage,
            'webPageLanguage' => $webPage->getLanguageForBlade($request->get('language')),
            'webPageLanguageVersion' => $webPageLanguageVersion,
        ]);
    }

    /**
     * @param WebSite $webSite
     * @param WebPage $webPage
     * @param WebPageLanguageVersion $webPageLanguageVersion
     * @return RedirectResponse
     */
    public function restore(WebSite $webSite, WebPage $webPage, WebPageLanguageVersion $webPageLanguageVersion): RedirectResponse
    {
        $webPageLanguageVersion->language->web_page_language_version_id = $webPageLanguageVersion->id;
        $webPageLanguageVersion->language->save();

        $success = 'Версия страницы `' . $webPage->name . '` от `';
        $success .= $webPageLanguageVersion->created_at . '` успешно была восстановлена.';

        $attributes = [];
        $attributes['message'] = 'Восстановил версию страницы `'. $webPage->id .'` от `'. $webPageLanguageVersion->created_at .'` сайта `'. $webSite->domain .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }
}
