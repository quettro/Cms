<?php

namespace App\Jobs;

use App\Mail\WebDataMail;
use App\Models\WebData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WebDataMailing implements ShouldQueue
{
    /**
     *
     */
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param WebData $webData
     */
    public function __construct(public WebData $webData)
    {
        //
    }

    /**
     * @return void
     */
    public function handle(): void
    {
        if ($this->webData->form) {
            if (!empty($this->webData->form->addresses)) {
                try {
                    Mail::to($this->webData->form->addresses)->send(new WebDataMail($this->webData));
                }
                catch(\Throwable $exception) {
                    Log::channel('daily')->error('[ WebData ] Не удалось отправить сообщения на электронные почты пользователей.');
                    Log::channel('daily')->error('[ WebData ] Электронные почты.', ['addresses' => $this->webData->form->addresses]);
                    Log::channel('daily')->error($exception);
                }
            }
        }
    }
}
