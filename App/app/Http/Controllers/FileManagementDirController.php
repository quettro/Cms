<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileManagementDir\StoreRequest;
use App\Vendor\Timehollyname\FileManagement\Management;
use Illuminate\Http\RedirectResponse;

class FileManagementDirController extends Controller
{
    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        $validated['absolute'] = str($validated['path'])->explode(DIRECTORY_SEPARATOR)->filter()->push($validated['name'])->implode(DIRECTORY_SEPARATOR);

        try {
            (new Management('common'))->makeDirectory($validated['absolute']);
        }
        catch (\Throwable $exception) {
            $success = "Произошла ошибка: {$exception->getMessage()}.";

            return redirect()->back()
                ->with('toast:error', $success);
        }

        $success = 'Папка `' . $validated['name'] . '` успешно было создана.';

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        try {
            $dir = (new Management('common'))->one(request()->query('path', ''));
        }
        catch (\Throwable $exception) {
            abort(404);
        }

        abort_unless($dir->isDir(), 404);

        try {
            $dir->delete();
        }
        catch (\Throwable $exception) {
            $success = "Произошла ошибка: {$exception->getMessage()}.";

            return redirect()->route('file-management.index')
                ->with('toast:error', $success);
        }

        $success = 'Папка успешно была удалена.';

        return redirect()->route('file-management.index')
            ->with('toast:success', $success);
    }
}
