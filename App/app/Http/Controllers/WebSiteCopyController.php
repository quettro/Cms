<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebSiteCopy\StoreRequest;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class WebSiteCopyController extends Controller
{
    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.Copy.index')
            ->with('webSite', $webSite);
    }

    /**
     * @param StoreRequest $request
     * @param WebSite $webSite
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, Website $webSite): RedirectResponse
    {
        $success = 'В данный момент, данная функция недоступна.';

        return redirect()->route('web-sites.show', $webSite->id)
            ->with('toast:error', $success);
    }
}
