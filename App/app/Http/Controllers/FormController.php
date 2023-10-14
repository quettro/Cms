<?php

namespace App\Http\Controllers;

use App\Http\Requests\Form\StoreRequest;
use App\Http\Requests\Form\UpdateRequest;
use App\Models\Form;
use App\Models\Language;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        return view('web.Form.index')
            ->with('forms', Form::paginate());
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): Factory|View|Application
    {
        return view('web.Form.create');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $form = new Form($validated['form']);
        $form->save();

        foreach (Language::all() as $language) {
            $formLanguage = $form->languages()->make($validated['formLanguage']);
            $formLanguage->language_id = $language->id;
            $formLanguage->save();
        }

        $success = 'Форма `' . $form->key . '` успешно была создана.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Формы`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $form->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('forms.show', $form->id)
            ->with('toast:success', $success);
    }

    /**
     * @param Request $request
     * @param Form $form
     * @return Application|Factory|View
     */
    public function show(Request $request, Form $form): Factory|View|Application
    {
        return view('web.Form.detail', [
            'form' => $form,
            'formLanguage' => $form->getLanguageForBlade($request->get('language')),
            'edit' => false,
        ]);
    }

    /**
     * @param Request $request
     * @param Form $form
     * @return Application|Factory|View
     */
    public function edit(Request $request, Form $form): Factory|View|Application
    {
        return view('web.Form.detail', [
            'form' => $form,
            'formLanguage' => $form->getLanguageForBlade($request->get('language')),
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param Form $form
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Form $form): RedirectResponse
    {
        $validated = $request->validated();

        $form->update($validated['form']);

        $formLanguage = $form->languages()->where(['id' => $validated['form_language_id']])->firstOrFail();
        $formLanguage->update($validated['formLanguage']);

        $success = 'Форма `' . $form->key . '` успешно была обновлена.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Формы`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $form->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param Form $form
     * @return RedirectResponse
     */
    public function destroy(Form $form): RedirectResponse
    {
        $form->delete();

        $success = 'Форма `' . $form->key . '` успешно была удалена.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Формы`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $form->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('forms.index')
            ->with('toast:success', $success);
    }
}
