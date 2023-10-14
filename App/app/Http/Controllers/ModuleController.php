<?php

namespace App\Http\Controllers;

use App\Http\Requests\Module\StoreRequest;
use App\Http\Requests\Module\UpdateRequest;
use App\Models\Module;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ModuleController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('web.Module.index', [
            'modules' => Module::paginate()
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('web.Module.create');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $module = new Module($request->validated());
        $module->save();

        $success = 'Модуль `' . $module->name . '` успешно был создан.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Модули`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $module->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('modules.show', $module->id)
            ->with('toast:success', $success);
    }

    /**
     * @param Module $module
     * @return Application|Factory|View
     */
    public function show(Module $module): View|Factory|Application
    {
        return view('web.Module.detail', [
            'module' => $module,
            'edit' => false,
        ]);
    }

    /**
     * @param Module $module
     * @return Application|Factory|View
     */
    public function edit(Module $module): View|Factory|Application
    {
        return view('web.Module.detail', [
            'module' => $module,
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param Module $module
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Module $module): RedirectResponse
    {
        $module->update($request->validated());

        $success = 'Модуль `' . $module->name . '` успешно был обновлен.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Модули`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $module->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param Module $module
     * @return RedirectResponse
     */
    public function destroy(Module $module): RedirectResponse
    {
        $module->delete();

        $success = 'Модуль `' . $module->name . '` успешно был удален.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Модули`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $module->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('modules.index')
            ->with('toast:success', $success);
    }
}
