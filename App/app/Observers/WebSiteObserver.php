<?php

namespace App\Observers;

use App\Models\WebSite;
use Illuminate\Support\Facades\Storage;

class WebSiteObserver
{
    /**
     * @param WebSite $webSite
     * @return void
     */
    public function created(WebSite $webSite): void
    {
        $conf_d__filename = $webSite->domain . '.conf';

        $conf_d__configuration = config('common.nginx.80-p');
        $conf_d__configuration = str_replace('{% charset %}', $webSite->charset, $conf_d__configuration);
        $conf_d__configuration = str_replace('{% server_name %}', $webSite->domain, $conf_d__configuration);

        $conf_d__disk = Storage::disk('conf-d');
        $conf_d__disk->put($conf_d__filename, $conf_d__configuration);
    }

    /**
     * @param WebSite $webSite
     * @return void
     */
    public function updated(WebSite $webSite): void
    {
        $conf_d__filename = $webSite->domain . '.conf';

        if (empty($webSite->ssl_certificate) || empty($webSite->ssl_certificate_key)) {
            $conf_d__configuration = config('common.nginx.80-p');
            $conf_d__configuration = str_replace('{% charset %}', $webSite->charset, $conf_d__configuration);
            $conf_d__configuration = str_replace('{% server_name %}', $webSite->domain, $conf_d__configuration);
        }
        else {
            $conf_d__configuration = config('common.nginx.443-p');
            $conf_d__configuration = str_replace('{% charset %}', $webSite->charset, $conf_d__configuration);
            $conf_d__configuration = str_replace('{% server_name %}', $webSite->domain, $conf_d__configuration);
            $conf_d__configuration = str_replace('{% ssl_certificate %}', $webSite->ssl_certificate, $conf_d__configuration);
            $conf_d__configuration = str_replace('{% ssl_certificate_key %}', $webSite->ssl_certificate_key, $conf_d__configuration);
        }

        $conf_d__disk = Storage::disk('conf-d');
        $conf_d__disk->put($conf_d__filename, $conf_d__configuration);
    }

    /**
     * @param WebSite $webSite
     * @return void
     */
    public function deleted(WebSite $webSite): void
    {
        $conf_d__filename = $webSite->domain . '.conf';

        $conf_d__disk = Storage::disk('conf-d');
        $conf_d__disk->delete($conf_d__filename);

        $webSite->webPages->each(static fn ($row) => $row->delete());
        $webSite->webPageTemplates->each(static fn ($row) => $row->delete());
        $webSite->webData->each(static fn ($row) => $row->delete());
        $webSite->webMenu->each(static fn ($row) => $row->delete());
        $webSite->webBlocks->each(static fn ($row) => $row->delete());
        $webSite->webBreadcrumbs->each(static fn ($row) => $row->delete());
        $webSite->webPaginations->each(static fn ($row) => $row->delete());
        $webSite->webVariables->each(static fn ($row) => $row->delete());
        $webSite->webResources->each(static fn ($row) => $row->delete());
        $webSite->webRobbers->each(static fn ($row) => $row->delete());
    }
}
