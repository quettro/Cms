<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleDatabase\StoreRequest;
use App\Http\Requests\ModuleDatabase\UpdateRequest;
use App\Models\File;
use App\Models\Language;
use App\Models\Module;
use App\Models\ModuleDatabase;
use App\Models\ModuleDatabaseLanguage;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ModuleDatabaseController extends Controller
{
    /**
     * @param Module $module
     * @return Application|Factory|View
     */
    public function index(Module $module): Factory|View|Application
    {
        return view('web.ModuleDatabase.index', [
            'module' => $module,
            'moduleDatabase' => $module->moduleDatabase()->paginate(),
            'moduleColumns' => $module->moduleColumns()->where('table', true)->get(),
        ]);
    }

    /**
     * @param Module $module
     * @return Application|Factory|View
     */
    public function create(Module $module): Factory|View|Application
    {
        return view('web.ModuleDatabase.create', [
            'module' => $module,
            'moduleColumns' => $module->moduleColumns,
        ]);
    }

    /**
     * @param StoreRequest $request
     * @param Module $module
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, Module $module): RedirectResponse
    {
        $validated = $request->validated('default', []);

        if ($request->hasFile('default.og_image')) {
            $validated['og_image_file_id'] = File::store($request->file('default.og_image'))->id;
        }

        $websites = $request->input('default.websites', []);
        $websites = WebSite::find($websites);

        $moduleColumns = $module->moduleColumns;
        $moduleColumnFile = $moduleColumns->firstWhere('type', \App\Enums\ModuleColumnType::_FILE);

        if ($module->type->isNot(\App\Enums\ModuleType::GALLERY) || empty($moduleColumnFile)) {
            $moduleDatabase = $module->moduleDatabase()->create();
            $moduleDatabase->webSites()->attach($websites);

            foreach (Language::all() as $language)
            {
                $moduleDatabaseLanguage = $moduleDatabase->languages()->make($validated);
                $moduleDatabaseLanguage->language_id = $language->id;
                $moduleDatabaseLanguage->save();

                foreach ($moduleColumns as $moduleColumn)
                {
                    $k = 'columns.' . $moduleColumn->key;

                    $moduleDatabaseLanguageColumn = $moduleDatabaseLanguage->moduleDatabaseLanguageColumns()->make();

                    if ($moduleColumn->isTypeFile()) {
                        $moduleDatabaseLanguageColumn->value = $request->hasFile($k) ? File::store($request->file($k))->id : null;
                    }
                    else {
                        $moduleDatabaseLanguageColumn->value = $request->input($k);
                    }

                    $moduleDatabaseLanguageColumn->module_column_id = $moduleColumn->id;
                    $moduleDatabaseLanguageColumn->save();
                }
            }
        }
        else {
            if ($request->hasFile('columns.' . $moduleColumnFile->key)) {
                $moduleColumns = $moduleColumns->whereNotIn('type', [\App\Enums\ModuleColumnType::_FILE]);

                foreach ($request->file('columns.' . $moduleColumnFile->key) as $file)
                {
                    $moduleDatabase = $module->moduleDatabase()->create();
                    $moduleDatabase->webSites()->attach($websites);

                    foreach (Language::all() as $language)
                    {
                        $moduleDatabaseLanguage = $moduleDatabase->languages()->make($validated);
                        $moduleDatabaseLanguage->language_id = $language->id;
                        $moduleDatabaseLanguage->save();

                        $moduleDatabaseLanguageColumn = $moduleDatabaseLanguage->moduleDatabaseLanguageColumns()->make();
                        $moduleDatabaseLanguageColumn->value = File::store($file)->id;
                        $moduleDatabaseLanguageColumn->module_column_id = $moduleColumnFile->id;
                        $moduleDatabaseLanguageColumn->save();

                        foreach ($moduleColumns as $moduleColumn)
                        {
                            $moduleDatabaseLanguageColumn = $moduleDatabaseLanguage->moduleDatabaseLanguageColumns()->make();
                            $moduleDatabaseLanguageColumn->value = $request->input('columns.' . $moduleColumn->key);
                            $moduleDatabaseLanguageColumn->module_column_id = $moduleColumn->id;
                            $moduleDatabaseLanguageColumn->save();
                        }
                    }
                }
            }
        }

        $success = 'Запись в модуле `' . $module->name;
        $success .= '` успешно была создана.';

        if (!isset($moduleDatabase)) {
            return redirect()->route('modules.module-database.index', [
                'module' => $module->id,
            ])
                ->with('toast:success', $success);
        }

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `База данных` модуля `'. $module->name .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $moduleDatabase->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('modules.module-database.show', [
            'module' => $module->id,
            'moduleDatabase' => $moduleDatabase->id,
        ])
            ->with('toast:success', $success);
    }

    /**
     * @param Request $request
     * @param Module $module
     * @param ModuleDatabase $moduleDatabase
     * @return Application|Factory|View
     */
    public function show(Request $request, Module $module, ModuleDatabase $moduleDatabase): Factory|View|Application
    {
        return view('web.ModuleDatabase.detail', [
            'module' => $module,
            'moduleDatabase' => $moduleDatabase,
            'moduleDatabaseLanguage' => $moduleDatabase->getLanguageForBlade($request->get('language')),
            'moduleColumns' => $module->moduleColumns,
            'edit' => false,
        ]);
    }

    /**
     * @param Request $request
     * @param Module $module
     * @param ModuleDatabase $moduleDatabase
     * @return Application|Factory|View
     */
    public function edit(Request $request, Module $module, ModuleDatabase $moduleDatabase): Factory|View|Application
    {
        return view('web.ModuleDatabase.detail', [
            'module' => $module,
            'moduleDatabase' => $moduleDatabase,
            'moduleDatabaseLanguage' => $moduleDatabase->getLanguageForBlade($request->get('language')),
            'moduleColumns' => $module->moduleColumns,
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param Module $module
     * @param ModuleDatabase $moduleDatabase
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Module $module, ModuleDatabase $moduleDatabase): RedirectResponse
    {
        $moduleDatabaseLanguage = $moduleDatabase->languages->where('id', $request->input('module_database_language_id'))->firstOrFail();

        $validated = $request->validated('default', []);

        if ($request->hasFile('default.og_image')) {
            $validated['og_image_file_id'] = File::store($request->file('default.og_image'))->id;
        }

        $websites = $request->input('default.websites', []);
        $websites = WebSite::find($websites);

        $moduleDatabase->webSites()->sync($websites);
        $moduleDatabaseLanguage->update($validated);

        foreach ($module->moduleColumns as $moduleColumn)
        {
            $k = 'columns.' . $moduleColumn->key;

            $moduleDatabaseLanguageColumn = $moduleDatabaseLanguage->moduleDatabaseLanguageColumns()->where('module_column_id', $moduleColumn->id)->first();

            if(!$moduleDatabaseLanguageColumn) {
                $moduleDatabaseLanguageColumn = $moduleDatabaseLanguage->moduleDatabaseLanguageColumns()->make();
                $moduleDatabaseLanguageColumn->module_column_id = $moduleColumn->id;
            }

            if(!$moduleColumn->isTypeFile()) {
                $moduleDatabaseLanguageColumn->value = $request->input($k);
            }
            else {
                if ($request->hasFile($k)) {
                    $moduleDatabaseLanguageColumn->value = File::store($request->file($k))->id;
                }
            }

            $moduleDatabaseLanguageColumn->save();
        }

        $success = 'Запись в модуле `' . $module->name;
        $success .= '` успешно была обновлена.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `База данных` модуля `'. $module->name .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $moduleDatabase->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param Module $module
     * @param ModuleDatabase $moduleDatabase
     * @return RedirectResponse
     */
    public function destroy(Module $module, ModuleDatabase $moduleDatabase): RedirectResponse
    {
        $moduleDatabase->delete();

        $success = 'Запись под номером `' . $moduleDatabase->id;
        $success .= '` была удалена из модуля `' . $module->name . '`.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `База данных` модуля `'. $module->name .'`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $moduleDatabase->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('modules.module-database.index', $module->id)
            ->with('toast:success', $success);
    }

    /**
     * @param Module $module
     * @return RedirectResponse
     */
    public function drop(Module $module): RedirectResponse
    {
        $module->moduleDatabase()->chunk(100, fn ($moduleDatabase) => $moduleDatabase->each(static fn ($row) => $row->delete()));

        $success = 'База данных модуля `' . $module->name . '` успешно была очищена.';

        $attributes = [];
        $attributes['message']  = 'Удалил все записи в разделе `База данных` модуля `'. $module->name .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('modules.module-database.index', $module->id)
            ->with('toast:success', $success);
    }
}
