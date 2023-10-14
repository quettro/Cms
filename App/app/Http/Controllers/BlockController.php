<?php

namespace App\Http\Controllers;

use App\Http\Requests\Block\StoreRequest;
use App\Http\Requests\Block\UpdateRequest;
use App\Models\Block;
use App\Models\Language;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        return view('web.Block.index')
            ->with('blocks', Block::paginate());
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $block = Block::create($validated['block']);

        foreach (Language::all() as $language) {
            $blockLanguage = $block->languages()->create(['language_id' => $language->id]);

            $blockLanguageVersion = $blockLanguage->version()->make($validated['blocklanguageversion']);
            $blockLanguageVersion->block_language_id = $blockLanguage->id;
            $blockLanguageVersion->save();

            $blockLanguage->block_language_version_id = $blockLanguageVersion->id;
            $blockLanguage->save();
        }

        $success = 'Блок `' . $block->name . '` успешно был создан.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Блоки`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $block->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('blocks.show', $block->id)
            ->with('toast:success', $success);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        return view('web.Block.create');
    }

    /**
     * @param Request $request
     * @param Block $block
     * @return Application|Factory|View
     */
    public function show(Request $request, Block $block): Factory|View|Application
    {
        return view('web.Block.detail', [
            'block' => $block,
            'blockLanguage' => $block->getLanguageForBlade($request->get('language')),
            'edit' => false,
        ]);
    }

    /**
     * @param Request $request
     * @param Block $block
     * @return Application|Factory|View
     */
    public function edit(Request $request, Block $block): Factory|View|Application
    {
        return view('web.Block.detail', [
            'block' => $block,
            'blockLanguage' => $block->getLanguageForBlade($request->get('language')),
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param Block $block
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Block $block): RedirectResponse
    {
        $validated = $request->validated();

        $blockLanguage = $block->languages->where('id', $validated['block_language_id'])->firstOrFail();

        $block->update($validated['block']);

        $blockLanguageVersion = $blockLanguage->version()->make($validated['blocklanguageversion']);
        $blockLanguageVersion->block_language_id = $blockLanguage->id;
        $blockLanguageVersion->save();

        $blockLanguage->block_language_version_id = $blockLanguageVersion->id;
        $blockLanguage->save();

        $success = 'Блок `' . $block->name . '` успешно был обновлен.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Блоки`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $block->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param Block $block
     * @return RedirectResponse
     */
    public function destroy(Block $block): RedirectResponse
    {
        $block->delete();

        $success = 'Блок `' . $block->name . '` успешно был удален.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Блоки`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $block->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('blocks.index')
            ->with('toast:success', $success);
    }
}
