<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebPagination\StoreRequest;
use App\Http\Requests\WebPagination\UpdateRequest;
use App\Models\Language;
use App\Models\WebPagination;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WebPaginationController extends Controller
{
    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.WebPagination.index', [
            'webSite' => $webSite,
            'webPaginations' => $webSite->webPaginations()->paginate(),
        ]);
    }

    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function create(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.WebPagination.create', [
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

        $webPagination = $webSite->webPaginations()->create($validated['webPagination']);

        foreach (Language::all() as $language) {
            $webPaginationLanguage = $webPagination->languages()->make($validated['webPaginationLanguage']);
            $webPaginationLanguage->language_id = $language->id;
            $webPaginationLanguage->save();
        }

        $success = 'Пагинация `' . $webPagination->name . '` успешно была создана.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Пагинации` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webPagination->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-paginations.show', [
            'webSite' => $webSite->id,
            'webPagination' => $webPagination->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebPagination $webPagination
     * @return Application|Factory|View
     */
    public function show(Request $request, WebSite $webSite, WebPagination $webPagination): Factory|View|Application
    {
        return view('web.WebSite.WebPagination.detail', [
            'webSite' => $webSite,
            'webPagination' => $webPagination,
            'webPaginationLanguage' => $webPagination->getLanguageForBlade($request->get('language')),
            'edit' => false,
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebPagination $webPagination
     * @return Application|Factory|View
     */
    public function edit(Request $request, WebSite $webSite, WebPagination $webPagination): Factory|View|Application
    {
        return view('web.WebSite.WebPagination.detail', [
            'webSite' => $webSite,
            'webPagination' => $webPagination,
            'webPaginationLanguage' => $webPagination->getLanguageForBlade($request->get('language')),
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param WebSite $webSite
     * @param WebPagination $webPagination
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, WebSite $webSite, WebPagination $webPagination): RedirectResponse
    {
        $validated = $request->validated();

        $webPagination->update($validated['webPagination']);

        $webPaginationLanguage = $webPagination->languages()->where(['id' => $validated['web_pagination_language_id']])->firstOrFail();
        $webPaginationLanguage->update($validated['webPaginationLanguage']);

        $success = 'Пагинация `' . $webPagination->name . '` успешно была обновлена.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Пагинации` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webPagination->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @param WebPagination $webPagination
     * @return RedirectResponse
     */
    public function destroy(WebSite $webSite, WebPagination $webPagination): RedirectResponse
    {
        $webPagination->delete();

        $success = 'Пагинация `' . $webPagination->name . '` успешно была удалена.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Пагинации` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webPagination->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-paginations.index', $webSite->id)
            ->with('toast:success', $success);
    }
}
