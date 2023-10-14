<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebBreadcrumb\StoreRequest;
use App\Http\Requests\WebBreadcrumb\UpdateRequest;
use App\Models\WebBreadcrumb;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class WebBreadcrumbController extends Controller
{
    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.WebBreadcrumb.index', [
            'webSite' => $webSite,
            'webBreadcrumbs' => $webSite->webBreadcrumbs()->paginate(),
        ]);
    }

    /**
     * @param StoreRequest $request
     * @param WebSite $webSite
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, WebSite $webSite): RedirectResponse
    {
        $webBreadcrumb = $webSite->webBreadcrumbs()->create($request->validated());

        $success = '"Хлебная крошка" `' . $webBreadcrumb->name . '` успешно была создана.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Хлебные крошки` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webBreadcrumb->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-breadcrumbs.show', [
            'webSite' => $webSite->id,
            'webBreadcrumb' => $webBreadcrumb->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function create(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.WebBreadcrumb.create', [
            'webSite' => $webSite,
        ]);
    }

    /**
     * @param WebSite $webSite
     * @param WebBreadcrumb $webBreadcrumb
     * @return Application|Factory|View
     */
    public function show(WebSite $webSite, WebBreadcrumb $webBreadcrumb): Factory|View|Application
    {
        return view('web.WebSite.WebBreadcrumb.detail', [
            'webSite' => $webSite,
            'webBreadcrumb' => $webBreadcrumb,
            'edit' => false,
        ]);
    }

    /**
     * @param WebSite $webSite
     * @param WebBreadcrumb $webBreadcrumb
     * @return Application|Factory|View
     */
    public function edit(WebSite $webSite, WebBreadcrumb $webBreadcrumb): Factory|View|Application
    {
        return view('web.WebSite.WebBreadcrumb.detail', [
            'webSite' => $webSite,
            'webBreadcrumb' => $webBreadcrumb,
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param WebSite $webSite
     * @param WebBreadcrumb $webBreadcrumb
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, WebSite $webSite, WebBreadcrumb $webBreadcrumb): RedirectResponse
    {
        $webBreadcrumb->update($request->validated());

        $success = '"Хлебная крошка" `' . $webBreadcrumb->name . '` успешно была обновлена.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Хлебные крошки` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webBreadcrumb->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @param WebBreadcrumb $webBreadcrumb
     * @return RedirectResponse
     */
    public function destroy(WebSite $webSite, WebBreadcrumb $webBreadcrumb): RedirectResponse
    {
        $webBreadcrumb->delete();

        $success = '"Хлебная крошка" `' . $webBreadcrumb->name . '` успешно была удалена.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Хлебные крошки` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webBreadcrumb->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-breadcrumbs.index', $webSite->id)
            ->with('toast:success', $success);
    }
}
