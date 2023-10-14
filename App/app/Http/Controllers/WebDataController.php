<?php

namespace App\Http\Controllers;

use App\Exports\WebDataExport;
use App\Http\Requests\WebData\SearchRequest;
use App\Models\WebData;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class WebDataController extends Controller
{
    /**
     * @param SearchRequest $request
     * @return Application|Factory|View
     */
    public function index(SearchRequest $request): View|Factory|Application
    {
        return view('web.WebData.index')
            ->with('webData', WebData::filter($request)->paginate());
    }

    /**
     * @param WebData $webData
     * @return Application|Factory|View
     */
    public function show(WebData $webData): View|Factory|Application
    {
        return view('web.WebData.show')
            ->with('webData', $webData);
    }

    /**
     * @param WebData $webData
     * @return RedirectResponse
     */
    public function destroy(WebData $webData): RedirectResponse
    {
        $webData->delete();

        $success = 'Данные `№' . $webData->id . '` успешно были удалены.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Веб-данные`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webData->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-data.index')
            ->with('toast:success', $success);
    }

    /**
     * @param Request $request
     * @return Response|BinaryFileResponse
     */
    public function csv(Request $request): Response|BinaryFileResponse
    {
        $collection = WebData::filter($request)->get();

        $attributes = [];
        $attributes['message'] = 'Экспортировал данные из раздела `Веб-данные`. Формат: csv.';

        request()->user()->history()->create($attributes);

        $filename = 'export_' . date('d-m-Y_H:i:s') . '.csv';

        return (new WebDataExport($collection))
            ->download($filename, Excel::CSV, ['Content-Type' => 'text/csv']);
    }

    /**
     * @param Request $request
     * @return Response|BinaryFileResponse
     */
    public function xlsx(Request $request): Response|BinaryFileResponse
    {
        $collection = WebData::filter($request)->with(['form', 'webSite', 'language'])->get();

        $attributes = [];
        $attributes['message'] = 'Экспортировал данные из раздела `Веб-данные`. Формат: xlsx.';

        request()->user()->history()->create($attributes);

        $filename = 'export_' . date('d-m-Y_H:i:s') . '.xlsx';

        return (new WebDataExport($collection))
            ->download($filename, Excel::XLSX);
    }
}
