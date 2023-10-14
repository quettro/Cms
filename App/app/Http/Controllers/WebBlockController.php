<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebBlock\StoreRequest;
use App\Http\Requests\WebBlock\UpdateRequest;
use App\Models\Language;
use App\Models\WebBlock;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WebBlockController extends Controller
{
    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.WebBlock.index')
            ->with('webSite', $webSite)->with('webBlocks', $webSite->webBlocks()->paginate());
    }

    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function create(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.WebBlock.create')
            ->with('webSite', $webSite);
    }

    /**
     * @param StoreRequest $request
     * @param WebSite $webSite
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, WebSite $webSite): RedirectResponse
    {
        $validated = $request->validated();

        $webBlock = $webSite->webBlocks()->create($validated['webblock']);

        foreach (Language::all() as $language) {
            $webBlockLanguage = $webBlock->languages()->create(['language_id' => $language->id]);

            $webBlockLanguageVersion = $webBlockLanguage->version()->make($validated['webblocklanguageversion']);
            $webBlockLanguageVersion->web_block_language_id = $webBlockLanguage->id;
            $webBlockLanguageVersion->save();

            $webBlockLanguage->web_block_language_version_id = $webBlockLanguageVersion->id;
            $webBlockLanguage->save();
        }

        $success = 'Блок `' . $webBlock->name . '` успешно был создан.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Блоки` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webBlock->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-blocks.show', [
            'webSite' => $webSite->id,
            'webBlock' => $webBlock->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebBlock $webBlock
     * @return Application|Factory|View
     */
    public function show(Request $request, WebSite $webSite, WebBlock $webBlock): Factory|View|Application
    {
        return view('web.WebSite.WebBlock.detail', [
            'webSite' => $webSite,
            'webBlock' => $webBlock,
            'webBlockLanguage' => $webBlock->getLanguageForBlade($request->get('language')),
            'edit' => false,
        ]);
    }

    /**
     * @param Request $request
     * @param WebSite $webSite
     * @param WebBlock $webBlock
     * @return Application|Factory|View
     */
    public function edit(Request $request, WebSite $webSite, WebBlock $webBlock): Factory|View|Application
    {
        return view('web.WebSite.WebBlock.detail', [
            'webSite' => $webSite,
            'webBlock' => $webBlock,
            'webBlockLanguage' => $webBlock->getLanguageForBlade($request->get('language')),
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param WebSite $webSite
     * @param WebBlock $webBlock
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, WebSite $webSite, WebBlock $webBlock): RedirectResponse
    {
        $validated = $request->validated();

        $webBlockLanguage = $webBlock->languages()->where(['id' => $validated['web_block_language_id']])->firstOrFail();

        $webBlock->update($validated['webblock']);

        $webBlockLanguageVersion = $webBlockLanguage->version()->make($validated['webblocklanguageversion']);
        $webBlockLanguageVersion->web_block_language_id = $webBlockLanguage->id;
        $webBlockLanguageVersion->save();

        $webBlockLanguage->web_block_language_version_id = $webBlockLanguageVersion->id;
        $webBlockLanguage->save();

        $success = 'Блок `' . $webBlock->name . '` успешно был обновлен.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Блоки` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webBlock->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @param WebBlock $webBlock
     * @return RedirectResponse
     */
    public function destroy(WebSite $webSite, WebBlock $webBlock): RedirectResponse
    {
        $webBlock->delete();

        $success = 'Блок `' . $webBlock->name . '` успешно был удален.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Блоки` сайта `'. $webSite->domain .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webBlock->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-blocks.index', $webSite->id)
            ->with('toast:success', $success);
    }
}
