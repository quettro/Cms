<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebSite\StoreRequest;
use App\Http\Requests\WebSite\UpdateRequest;
use App\Models\WebSite;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class WebSiteController extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        return view('web.WebSite.index', [
            'webSites' => $request->user()->webSites()->paginate(),
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('web.WebSite.create');
    }

    /**
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $webSite = new WebSite($request->validated());
        $webSite->save();

        $request->user()->websites()->attach($webSite->id);

        $success = 'Сайт `' . $webSite->domain . '` успешно был создан.';

        $attributes = [];
        $attributes['message']  = 'Добавил новую запись в разделе `Сайты`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webSite->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.show', $webSite->id)
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function show(WebSite $webSite): View|Factory|Application
    {
        return view('web.WebSite.detail', [
            'webSite' => $webSite,
            'edit' => false,
        ]);
    }

    /**
     * @param WebSite $webSite
     * @return Application|Factory|View
     */
    public function edit(WebSite $webSite): View|Factory|Application
    {
        return view('web.WebSite.detail', [
            'webSite' => $webSite,
            'edit' => true,
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param WebSite $webSite
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, WebSite $webSite): RedirectResponse
    {
        $webSite->update($request->validated());

        $success = 'Сайт `' . $webSite->domain . '` успешно был обновлен.';

        $attributes = [];
        $attributes['message']  = 'Отредактировал запись в разделе `Сайты`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webSite->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @return RedirectResponse
     */
    public function destroy(WebSite $webSite): RedirectResponse
    {
        $webSite->delete();

        $success = 'Сайт `' . $webSite->domain . '` успешно был удален.';

        $attributes = [];
        $attributes['message']  = 'Удалил запись в разделе `Сайты`. ';
        $attributes['message'] .= 'Уникальный номер записи `'. $webSite->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->route('web-sites.index')
            ->with('toast:success', $success);
    }

    /**
     * @param WebSite $webSite
     * @return RedirectResponse
     */
    public function letsencrypt(WebSite $webSite): RedirectResponse
    {
        try {
            $command = ['certbot', 'certonly', '--webroot', '-w', '/var/www/html/public', '-d', $webSite->domain, '--renew-by-default', '-n', '--agree-tos', '-m', config('letsencrypt.m')];

            $process = new Process($command);
            $process->run();
        }
        catch (\Throwable $exception) {
            Log::channel('daily')->error($exception);

            $message = '[ certbot ] Произошла ошибка: `' . $exception->getMessage() . '`.';

            return redirect()->back()
                ->with('toast:error', $message);
        }

        try {
            if(!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }
        }
        catch (ProcessFailedException $exception) {
            Log::channel('daily')->error($exception);

            $message = '[ certbot ] Произошла ошибка: `' . $exception->getMessage() . '`.';

            return redirect()->back()
                ->with('toast:error', $message);
        }

        try {
            throw_if(!preg_match('/\/etc\/letsencrypt\/live\/(.*?)\/fullchain.pem/', $process->getOutput(), $name), 'Не удалось получить наименование сертификата.');
        }
        catch (\Throwable $exception) {
            Log::channel('daily')->error($exception);

            $message = '[ regex ] Произошла ошибка: `' . $exception->getMessage() . '`.';

            return redirect()->back()
                ->with('toast:error', $message);
        }

        try {
            $f = new File('/etc/letsencrypt/live/'. $name[1] .'/fullchain.pem');
            $p = new File('/etc/letsencrypt/live/'. $name[1] .'/privkey.pem');

            $letsencrypt = Storage::disk('letsencrypt')->path($webSite->domain);

            $webSite->ssl_certificate = $f->move($letsencrypt)->getPathname();
            $webSite->ssl_certificate_key = $p->move($letsencrypt)->getPathname();
            $webSite->save();
        }
        catch (\Throwable $exception) {
            Log::channel('daily')->error($exception);

            $message = '[ letsencrypt ] Произошла ошибка: `' . $exception->getMessage() . '`.';

            return redirect()->back()
                ->with('toast:error', $message);
        }

        $message = 'Сертификат для сайта `' . $webSite->domain . '` успешно был установлен.';

        $attributes = [];
        $attributes['message']  = 'Выпустил сертификат Letsencrypt в разделе `Сайты`. ';
        $attributes['message'] .= 'Уникальный номер сайта `'. $webSite->id .'`.';

        request()->user()->history()->create($attributes);

        return redirect()->back()
            ->with('toast:success', $message);
    }
}
