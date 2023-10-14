<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebResource\PositionUpdateRequest;
use App\Http\Requests\WebResource\StoreRequest;
use App\Models\File;
use App\Models\WebSite;
use App\Models\WebResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class WebResourceController extends Controller
{
    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite): View|Factory|Application
    {
        return view('web.WebSite.WebResource.index', [
            'webSite' => $webSite,
            'webResources' => $webSite->webResources,
        ]);
    }

    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function create(WebSite $webSite): View|Factory|Application
    {
        return view('web.WebSite.WebResource.create', [
            'webSite' => $webSite,
        ]);
    }

    /**
     * @param StoreRequest $request
     * @param WebSite $webSite
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, WebSite $webSite): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('file')) {
            $index = $webSite->webResources()->where(['position' => $validated['position']])->max('index');
            $index = (int) $index;

            foreach ($request->file('file') as $file) {
                $index++;

                $hashName  = pathinfo($file->hashName(), PATHINFO_FILENAME);
                $hashName .= '.' . $file->getClientOriginalExtension();

                $attributes = [];
                $attributes['index'] = $index;
                $attributes['position'] = $validated['position'];
                $attributes['file_id'] = File::store($file, hashName: $hashName)->id;

                $webResource = $webSite->webResources()->make($attributes);
                $webResource->save();
            }
        }

        $success = 'Файл(ы) успешно был(и) загружен(ы) на сервер.';

        $attributes = [];
        $attributes['message'] = 'Добавил новые файлы в разделе `Ресурсы` сайта `'. $webSite->domain .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-resources.index', $webSite->id)
            ->with('toast:success', $success);
    }

    /**
     * @param PositionUpdateRequest $request
     * @param WebSite $webSite
     * @return JsonResponse
     */
    public function position(PositionUpdateRequest $request, WebSite $webSite): JsonResponse
    {
        foreach ($request->input('order') as $order) {
            $webSite->webResources()->where('id', $order['id'])->update(['index' => $order['index']]);
        }

        $attributes = [];
        $attributes['message'] = 'Отредактировал порядок файлов в разделе `Ресурсы` сайта `'. $webSite->domain .'`.';

        request()->user()->history()->create($attributes);

        return response()->json(['status' => true]);
    }

    /**
     * @param WebSite $webSite
     * @param WebResource $webResource
     * @return RedirectResponse
     */
    public function destroy(WebSite $webSite, WebResource $webResource): RedirectResponse
    {
        $webResource->delete();

        $success = 'Файл `' . $webResource->file?->filename . '` успешно был удален.';

        $attributes = [];
        $attributes['message'] = 'Удалил файл `'. $webResource->file?->filename .'` в разделе `Ресурсы` сайта `'. $webSite->domain .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.web-resources.index', $webSite->id)
            ->with('toast:success', $success);
    }
}
