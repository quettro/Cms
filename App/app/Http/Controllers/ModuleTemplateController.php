<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleTemplate\StoreRequest;
use App\Http\Requests\ModuleTemplate\UpdateRequest;
use App\Models\Module;
use App\Models\ModuleTemplate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ModuleTemplateController extends Controller
{
    /**
     * @param Module $module
     * @return Application|Factory|View
     */
    public function index(Module $module): Factory|View|Application
    {
        return view('web.ModuleTemplate.index', [
            'module' => $module,
            'moduleTemplates' => $module->moduleTemplates()->paginate(),
        ]);
    }

    /**
     * @param StoreRequest $request
     * @param Module $module
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, Module $module): RedirectResponse
    {
        $moduleTemplate = $module->moduleTemplates()->create($request->validated());

        $success = 'Шаблон `' . $moduleTemplate->name . '` успешно был создан.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Шаблоны` модуля `'. $module->name .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $moduleTemplate->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('modules.module-templates.show', [
            'module' => $module->id,
            'moduleTemplate' => $moduleTemplate->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param Module $module
     * @return Application|Factory|View
     */
    public function create(Module $module): Factory|View|Application
    {
        return view('web.ModuleTemplate.create', [
            'module' => $module,
        ]);
    }

    /**
     * @param Module $module
     * @param ModuleTemplate $moduleTemplate
     * @return Application|Factory|View
     */
    public function show(Module $module, ModuleTemplate $moduleTemplate): Factory|View|Application
    {
        return view('web.ModuleTemplate.detail', [
            'module' => $module,
            'moduleTemplate' => $moduleTemplate,
            'edit' => false,
        ]);
    }

    /**
     * @param Module $module
     * @param ModuleTemplate $moduleTemplate
     * @return Application|Factory|View
     */
    public function edit(Module $module, ModuleTemplate $moduleTemplate): Factory|View|Application
    {
        return view('web.ModuleTemplate.detail', [
            'module' => $module,
            'moduleTemplate' => $moduleTemplate,
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param Module $module
     * @param ModuleTemplate $moduleTemplate
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Module $module, ModuleTemplate $moduleTemplate): RedirectResponse
    {
        $moduleTemplate->update($request->validated());

        $success = 'Шаблон `' . $moduleTemplate->name . '` успешно был обновлен.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Шаблоны` модуля `'. $module->name .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $moduleTemplate->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param Module $module
     * @param ModuleTemplate $moduleTemplate
     * @return RedirectResponse
     */
    public function destroy(Module $module, ModuleTemplate $moduleTemplate): RedirectResponse
    {
        $moduleTemplate->delete();

        $success = 'Шаблон `' . $moduleTemplate->name . '` успешно был удален.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Шаблоны` модуля `'. $module->name .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $moduleTemplate->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('modules.module-templates.index', $module->id)
            ->with('toast:success', $success);
    }
}
