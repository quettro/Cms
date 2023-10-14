<?php

namespace App\Http\Controllers;

use App\Http\Requests\Input\StoreRequest;
use App\Http\Requests\Input\UpdateRequest;
use App\Models\Input;
use App\Models\Language;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InputController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        return view('web.Input.index')
            ->with('inputs', Input::paginate());
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        return view('web.Input.create');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $input = new Input($validated['input']);
        $input->save();

        foreach (Language::all() as $language) {
            $inputLanguage = $input->languages()->make($validated['inputLanguage']);
            $inputLanguage->language_id = $language->id;
            $inputLanguage->save();
        }

        $success = 'Поле `' . $input->name . '` успешно было создано.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Поля форм`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $input->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('inputs.show', $input->id)
            ->with('toast:success', $success);
    }

    /**
     * @param Request $request
     * @param Input $input
     * @return Application|Factory|View
     */
    public function show(Request $request, Input $input): Factory|View|Application
    {
        return view('web.Input.detail', [
            'input' => $input,
            'inputLanguage' => $input->getLanguageForBlade($request->get('language')),
            'edit' => false,
        ]);
    }

    /**
     * @param Request $request
     * @param Input $input
     * @return Application|Factory|View
     */
    public function edit(Request $request, Input $input): Factory|View|Application
    {
        return view('web.Input.detail', [
            'input' => $input,
            'inputLanguage' => $input->getLanguageForBlade($request->get('language')),
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param Input $input
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Input $input): RedirectResponse
    {
        $validated = $request->validated();

        $input->update($validated['input']);

        $inputLanguage = $input->languages()->where(['id' => $validated['input_language_id']])->firstOrFail();
        $inputLanguage->update($validated['inputLanguage']);

        $success = 'Поле `' . $input->name . '` успешно было обновлено.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Поля форм`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $input->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param Input $input
     * @return RedirectResponse
     */
    public function destroy(Input $input): RedirectResponse
    {
        $input->delete();

        $success = '`' . $input->name . '` успешно была удалена.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Поля форм`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $input->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('inputs.index')
            ->with('toast:success', $success);
    }
}
