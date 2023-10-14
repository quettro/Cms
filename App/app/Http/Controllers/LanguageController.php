<?php

namespace App\Http\Controllers;

use App\Http\Requests\Language\StoreRequest;
use App\Http\Requests\Language\UpdateRequest;
use App\Models\Language;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('web.Language.index', [
            'languages' => Language::paginate()
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('web.Language.create');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $language = new Language($request->validated());
        $language->save();

        $success = 'Язык `' . $language->name . '` успешно был создан.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Языки`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $language->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('languages.show', $language->id)
            ->with('toast:success', $success);
    }

    /**
     * @param Language $language
     * @return Application|Factory|View
     */
    public function show(Language $language): View|Factory|Application
    {
        return view('web.Language.detail', [
            'language' => $language,
            'edit' => false,
        ]);
    }

    /**
     * @param Language $language
     * @return Application|Factory|View
     */
    public function edit(Language $language): View|Factory|Application
    {
        return view('web.Language.detail', [
            'language' => $language,
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param Language $language
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Language $language): RedirectResponse
    {
        $language->update($request->validated());

        $success = 'Язык `' . $language->name . '` успешно был обновлен.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Языки`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $language->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param Language $language
     * @return RedirectResponse
     */
    public function destroy(Language $language): RedirectResponse
    {
        $language->delete();

        $success = 'Язык `' . $language->name . '` успешно был удален.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Языки`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $language->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('languages.index')
            ->with('toast:success', $success);
    }
}
