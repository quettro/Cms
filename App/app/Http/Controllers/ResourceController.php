<?php

namespace App\Http\Controllers;

use App\Http\Requests\Resource\PositionUpdateRequest;
use App\Http\Requests\Resource\StoreRequest;
use App\Models\File;
use App\Models\Resource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ResourceController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('web.Resource.index')
            ->with('resources', Resource::query()->get());
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('web.Resource.create');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('file')) {
            $index = Resource::where(['position' => $validated['position']])->max('index');
            $index = (int) $index;

            foreach ($request->file('file') as $file) {
                $index++;

                $hashName  = pathinfo($file->hashName(), PATHINFO_FILENAME);
                $hashName .= '.' . $file->getClientOriginalExtension();

                $attributes = [];
                $attributes['index'] = $index;
                $attributes['position'] = $validated['position'];
                $attributes['file_id'] = File::store($file, hashName: $hashName)->id;

                $resource = new Resource($attributes);
                $resource->save();
            }
        }

        $success = 'Файл(ы) успешно был(и) загружен(ы) на сервер.';

        $attributes = [];
        $attributes['message'] = 'Добавил новые файлы в разделе `Ресурсы`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('resources.index')
            ->with('toast:success', $success);
    }

    /**
     * @param PositionUpdateRequest $request
     * @return JsonResponse
     */
    public function position(PositionUpdateRequest $request): JsonResponse
    {
        foreach ($request->input('order') as $order) {
            Resource::where('id', $order['id'])->update(['index' => $order['index']]);
        }

        $attributes = [];
        $attributes['message'] = 'Отредактировал порядок файлов в разделе `Ресурсы`.';

        request()->user()->history()->create($attributes);

        return response()->json(['status' => true]);
    }

    /**
     * @param Resource $resource
     * @return RedirectResponse
     */
    public function destroy(Resource $resource): RedirectResponse
    {
        $resource->delete();

        $success = 'Файл `' . $resource->file?->filename . '` успешно был удален.';

        $attributes = [];
        $attributes['message'] = 'Удалил файл `'. $resource->file?->filename .'` в разделе `Ресурсы`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('resources.index')
            ->with('toast:success', $success);
    }
}
