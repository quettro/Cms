<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebSiteCode\UpdateRequest;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class WebSiteCodeController extends Controller
{
    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.code', compact('webSite'));
    }

    /**
     * @param UpdateRequest $request
     * @param WebSite $webSite
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, WebSite $webSite): RedirectResponse
    {
        $webSite->update($request->validated());

        $attributes = [];
        $attributes['message'] = 'Отредактировал код в разделе `Код` сайта `'. $webSite->domain .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', 'Изменения успешно были применены');
    }
}
