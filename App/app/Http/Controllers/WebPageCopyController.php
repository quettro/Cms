<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebPageCopy\StoreRequest;
use App\Models\WebPage;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Validator;

class WebPageCopyController extends Controller
{
    /**
     * @param WebSite $webSite
     * @param WebPage $webPage
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite, WebPage $webPage): Factory|View|Application
    {
        return view('web.WebSite.WebPage.Copy.index', [
            'webSite' => $webSite,
            'webPage' => $webPage,
            'webSites' => WebSite::query()->withCount('webPageTemplates')->having('webPageTemplates_count', '>', 0)->get(),
        ]);
    }

    /**
     * @param StoreRequest $request
     * @param WebSite $webSite
     * @param WebPage $webPage
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, Website $webSite, WebPage $webPage): RedirectResponse
    {
        $validated = $request->validated();

        $webSite = WebSite::where('id', $validated['webpage']['web_site_id'])->first();
        $webpagelanguages = $webPage->languages;

        if ($validated['webpage']['is_home']) {
            $i = 0;
            $v = Validator::make([], []);

            if ($webSite->webpages()->where('is_home', true)->exists()) {
                $i++;
                $v->errors()->add('webpage.is_home', 'На данный момент главная страница уже существует.');
            }

            if ($i) {
                return redirect()
                    ->back()
                    ->withErrors($v)
                    ->withInput();
            }
        }

        $webpage = $webpage->replicate()->toArray();
        $webpage = array_merge($webpage, $validated['webpage']);

        unset($webpage['a_route']);
        unset($webpage['web_site_id']);

        $webpage = $webSite->webpages()->create($webpage);

        if ($webpagelanguages->count()) {
            foreach ($webpagelanguages as $webpagelanguage) {
                $webpagelanguageversions = $webpagelanguage->versions;
                $webpagelanguage = $webpagelanguage->replicate()->toArray();
                $webpagelanguage = array_merge($webpagelanguage, $validated['webpagelanguage']);

                unset($webpagelanguage['web_page_id']);

                $webpagelanguage = $webpage->languages()
                    ->create($webpagelanguage);

                if (!$webpagelanguageversions->count())
                    continue;

                foreach ($webpagelanguageversions as $webpagelanguageversion) {
                    $webpagelanguageversion = $webpagelanguageversion
                        ->replicate()->toArray();

                    unset($webpagelanguageversion['web_page_language_id']);

                    $webpagelanguageversion = $webpagelanguage->versions()
                        ->create($webpagelanguageversion);
                }

                $webpagelanguage->web_page_language_version_id = $webpagelanguageversion->id;
                $webpagelanguage->save();
            }
        }

        $success = 'Страница `' . $webpage->name . '` успешно была создана.';

        return redirect()->route('web-sites.webpages.show', [
            'webSite' => $webSite->id,
            'webpage' => $webpage->id
        ])->with('toast:success', $success);
    }
}
