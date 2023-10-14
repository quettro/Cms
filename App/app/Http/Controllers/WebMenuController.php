<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebMenu\StoreRequest;
use App\Http\Requests\WebMenu\UpdateRequest;
use App\Models\WebMenu;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class WebMenuController extends Controller
{
    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.WebMenu.index', [
            'webSite' => $webSite,
            'webMenu' => $webSite->webMenu()->paginate(),
        ]);
    }

    /**
     * @param StoreRequest $request
     * @param WebSite $webSite
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, WebSite $webSite): RedirectResponse
    {
        $webMenu = $webSite->webMenu()->create($request->validated());

        $success = 'Меню `' . $webMenu->name . '` успешно был создан.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Меню` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webMenu->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-menu.show', [
            'webSite' => $webSite->id,
            'webMenu' => $webMenu->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function create(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.WebMenu.create', [
            'webSite' => $webSite,
        ]);
    }

    /**
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @return Application|Factory|View
     */
    public function show(WebSite $webSite, WebMenu $webMenu): Factory|View|Application
    {
        return view('web.WebSite.WebMenu.detail', [
            'webSite' => $webSite,
            'webMenu' => $webMenu,
            'edit' => false,
        ]);
    }

    /**
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @return Application|Factory|View
     */
    public function edit(WebSite $webSite, WebMenu $webMenu): Factory|View|Application
    {
        return view('web.WebSite.WebMenu.detail', [
            'webSite' => $webSite,
            'webMenu' => $webMenu,
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, WebSite $webSite, WebMenu $webMenu): RedirectResponse
    {
        $webMenu->update($request->validated());

        $success = 'Меню `' . $webMenu->name . '` успешно был обновлен.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Меню` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webMenu->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @return RedirectResponse
     */
    public function destroy(WebSite $webSite, WebMenu $webMenu): RedirectResponse
    {
        $webMenu->delete();

        $success = 'Меню `' . $webMenu->name . '` успешно был удален.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Меню` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webMenu->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-menu.index', $webSite->id)
            ->with('toast:success', $success);
    }
}
