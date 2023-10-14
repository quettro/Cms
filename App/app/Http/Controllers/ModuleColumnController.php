<?php

namespace App\Http\Controllers;

use App\Enums\ModuleColumnType;
use App\Http\Requests\ModuleColumn\StoreRequest;
use App\Http\Requests\ModuleColumn\UpdateRequest;
use App\Models\Module;
use App\Models\ModuleColumn;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ModuleColumnController extends Controller
{
    /**
     * @param Module $module
     * @return Application|Factory|View
     */
    public function index(Module $module): View|Factory|Application
    {
        return view('web.ModuleColumn.index', [
            'module' => $module,
            'moduleColumns' => $module->moduleColumns()->paginate(),
        ]);
    }

    /**
     * @param StoreRequest $request
     * @param Module $module
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, Module $module): RedirectResponse
    {
        $moduleColumn = $module->moduleColumns()->create($request->validated());

        $success = 'Колонка `' . $moduleColumn->key . '` успешно была создана.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Колонки` модуля `'. $module->name .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $moduleColumn->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('modules.module-columns.show', [
            'module' => $module->id,
            'moduleColumn' => $moduleColumn->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param Module $module
     * @return Application|Factory|View
     */
    public function create(Module $module): View|Factory|Application
    {
        return view('web.ModuleColumn.create', [
            'module' => $module,
        ]);
    }

    /**
     * @param Module $module
     * @param ModuleColumn $moduleColumn
     * @return Application|Factory|View
     */
    public function show(Module $module, ModuleColumn $moduleColumn): View|Factory|Application
    {
        return view('web.ModuleColumn.detail', [
            'module' => $module,
            'moduleColumn' => $moduleColumn,
            'edit' => false,
        ]);
    }

    /**
     * @param Module $module
     * @param ModuleColumn $moduleColumn
     * @return Application|Factory|View
     */
    public function edit(Module $module, ModuleColumn $moduleColumn): View|Factory|Application
    {
        return view('web.ModuleColumn.detail', [
            'module' => $module,
            'moduleColumn' => $moduleColumn,
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param Module $module
     * @param ModuleColumn $moduleColumn
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Module $module, ModuleColumn $moduleColumn): RedirectResponse
    {
        $moduleColumn->update($request->validated());

        $success = 'Колонка `' . $moduleColumn->key . '` успешно была обновлена.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Колонки` модуля `'. $module->name .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $moduleColumn->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param Module $module
     * @param ModuleColumn $moduleColumn
     * @return RedirectResponse
     */
    public function destroy(Module $module, ModuleColumn $moduleColumn): RedirectResponse
    {
        $moduleColumn->delete();

        $success = 'Колонка `' . $moduleColumn->key . '` успешно была удалена.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Колонки` модуля `'. $module->name .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $moduleColumn->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('modules.module-columns.index', $module->id)
            ->with('toast:success', $success);
    }
}
