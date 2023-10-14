<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileManagementFile\StoreRequest;
use App\Vendor\Timehollyname\FileManagement\Management;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class FileManagementFileController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function show(): View|Factory|Application
    {
        try {
            $file = (new Management('common'))->one(request()->query('path', ''));
        }
        catch (\Throwable $exception) {
            abort(404);
        }

        abort_unless($file->isFile(), 404);

        return view('web.FileManagement.File.show')
            ->with('file', $file);
    }

    public function store(StoreRequest $request)
    {
        $file = $request->file('file');

        try {
            $file->storeAs($request->validated('path'), $file->getClientOriginalName(), 'common');
        }
        catch (\Throwable $exception) {
            return response($exception->getMessage(), status: 400);
        }

        return response(content: 'Файл был успешно загружен.');
    }

    /**
     * @return RedirectResponse
     */
    public function destroy(): RedirectResponse
    {
        try {
            $file = (new Management('common'))->one(request()->query('path', ''));
        }
        catch (\Throwable $exception) {
            abort(404);
        }

        abort_unless($file->isFile(), 404);

        try {
            $file->delete();
        }
        catch (\Throwable $exception) {
            $success = "Произошла ошибка: {$exception->getMessage()}.";

            return redirect()->route('file-management.index')
                ->with('toast:error', $success);
        }

        $success = 'Файл успешно был удален.';

        return redirect()->route('file-management.index')
            ->with('toast:success', $success);
    }
}
