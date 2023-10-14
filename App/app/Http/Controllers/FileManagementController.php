<?php

namespace App\Http\Controllers;

use App\Vendor\Timehollyname\FileManagement\Management;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FileManagementController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        try {
            $collection = (new Management('common'))->collection(request()->query('path', ''));
        }
        catch (\Throwable $exception) {
            $collection = collect();
        }

        return view('web.FileManagement.index')
            ->with('collection', $collection);
    }
}
