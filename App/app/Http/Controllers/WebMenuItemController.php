<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebMenuItem\PositionUpdateRequest;
use App\Http\Requests\WebMenuItem\StoreRequest;
use App\Http\Requests\WebMenuItem\UpdateRequest;
use App\Models\Language;
use App\Models\WebMenu;
use App\Models\WebMenuItem;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WebMenuItemController extends Controller
{
    /**
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite, WebMenu $webMenu): View|Factory|Application
    {
        return view('web.WebSite.WebMenuItem.index', [
            'webSite' => $webSite,
            'webMenu' => $webMenu,
            'webMenuItems' => $webMenu->webMenuItems->toTree(),
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @return Application|Factory|View
     */
    public function create(Request $request, WebSite $webSite, WebMenu $webMenu): View|Factory|Application
    {
        return view('web.WebSite.WebMenuItem.create', [
            'webSite' => $webSite,
            'webMenu' => $webMenu,
            'webMenuItems' => $webMenu->webMenuItems,
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

        $index = $webMenu->webMenuItems();
        $index = $index->where('parent_id', $validated['webmenuitem']['parent_id'])->max('index');
        $index = $index ?: 0;
        $index++;

        $webMenuItem = $webMenu->webMenuItems()->make($validated['webmenuitem']);
        $webMenuItem->index = $index;
        $webMenuItem->save();

        foreach (Language::all() as $language) {
            $webMenuItemLanguage = $webMenuItem->languages()->make($validated['webmenuitemlanguage']);
            $webMenuItemLanguage->language_id = $language->id;
            $webMenuItemLanguage->save();
        }

        $success = 'Ссылка `' . $webMenuItem->id . '` успешно была создана.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Ссылки`, меню `'. $webMenu->name .'` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webMenuItem->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-menu.web-menu-items.show', [
            'webSite' => $webSite->id,
            'webMenu' => $webMenu->id,
            'webMenuItem' => $webMenuItem->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param PositionUpdateRequest $request
     * @return JsonResponse
     */
    public function position(PositionUpdateRequest $request): JsonResponse
    {
        foreach ($request->input('order') as $order) {
            WebMenuItem::where('id', $order['id'])->update(['index' => $order['index']]);
        }
        return response()->json(['status' => true]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @param WebMenuItem $webMenuItem
     * @return Application|Factory|View
     */
    public function show(Request $request, WebSite $webSite, WebMenu $webMenu, WebMenuItem $webMenuItem): View|Factory|Application
    {
        $webMenuItems = $webMenu->webMenuItems()
            ->whereNotIn('id', array_merge([$webMenuItem->id], $webMenuItem->descendants->pluck('id')->toArray()))->get();

        return view('web.WebSite.WebMenuItem.detail', [
            'webSite' => $webSite,
            'webMenu' => $webMenu,
            'webMenuItem' => $webMenuItem,
            'webMenuItems' => $webMenuItems,
            'webMenuItemLanguage' => $webMenuItem->getLanguageForBlade($request->get('language')),
            'edit' => false,
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @param WebMenuItem $webMenuItem
     * @return Application|Factory|View
     */
    public function edit(Request $request, WebSite $webSite, WebMenu $webMenu, WebMenuItem $webMenuItem): View|Factory|Application
    {
        $webMenuItems = $webMenu->webMenuItems()
            ->whereNotIn('id', array_merge([$webMenuItem->id], $webMenuItem->descendants->pluck('id')->toArray()))->get();

        return view('web.WebSite.WebMenuItem.detail', [
            'webSite' => $webSite,
            'webMenu' => $webMenu,
            'webMenuItem' => $webMenuItem,
            'webMenuItems' => $webMenuItems,
            'webMenuItemLanguage' => $webMenuItem->getLanguageForBlade($request->get('language')),
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @param WebMenuItem $webMenuItem
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, WebSite $webSite, WebMenu $webMenu, WebMenuItem $webMenuItem): RedirectResponse
    {
        $validated = $request->validated();

        $webMenuItem->update($validated['webmenuitem']);

        $webMenuItemLanguage = $webMenuItem->languages();
        $webMenuItemLanguage = $webMenuItemLanguage->where('id', $request->input('web_menu_item_language_id'))->firstOrFail();
        $webMenuItemLanguage->update($validated['webmenuitemlanguage']);

        if ($webMenuItem->isDirty('parent_id')) {
            $index = $webMenu->webmenuitems();
            $index = $index->where('parent_id', $webMenuItem->parent_id)->max('index');
            $index = $index ?: 0;
            $index++;

            $webMenuItem->update(['index' => $index]);
        }

        $success = 'Ссылка `' . $webMenuItemLanguage->name . '` успешно была обновлена.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Ссылки`, меню `'. $webMenu->name .'` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webMenuItem->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @param WebMenu $webMenu
     * @param WebMenuItem $webMenuItem
     * @return RedirectResponse
     */
    public function destroy(WebSite $webSite, WebMenu $webMenu, WebMenuItem $webMenuItem): RedirectResponse
    {
        $webMenuItem->delete();

        $success = 'Ссылка `' . $webMenuItem->name . '` успешно была удалена.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Ссылки`, меню `'. $webMenu->name .'` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webMenuItem->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-menu.web-menu-items.index', [
            'webSite' => $webSite->id,
            'webMenu' => $webMenu->id,
        ])
            ->with('toast:success', $success);
    }
}
