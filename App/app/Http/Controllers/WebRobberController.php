<?php

namespace App\Http\Controllers;

use App\Enums\WebRobberStatus;
use App\Http\Requests\WebRobber\StoreRequest;
use App\Jobs\WebRobberJob;
use App\Models\WebRobber;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class WebRobberController extends Controller
{
    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function index(WebSite $webSite): Factory|View|Application
    {
        return view('web.WebSite.WebRobber.index')
            ->with('webSite', $webSite);
    }

    /**
     * @param StoreRequest $request
     * @param WebSite $webSite
     * @return RedirectResponse
     */
    public function store(StoreRequest $request, WebSite $webSite): RedirectResponse
    {
        /* @var WebRobber $webRobber */

        $webRobber = $webSite->webRobbers()->make($request->validated());
        $webRobber->status = WebRobberStatus::QUEUE;
        $webRobber->save();

        WebRobberJob::dispatch($webRobber);

        $message = 'Страница "'. $webRobber->route .'" добавлена в очередь на парсинг.';

        return redirect()->back()
            ->with('toast:success', $message);
    }
}
