<?php

namespace App\Jobs;

use App\Enums\WebRobberStatus;
use App\Models\Language;
use App\Models\WebPage;
use App\Models\WebPageLanguage;
use App\Models\WebPageLanguageVersion;
use App\Models\WebRobber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;
use Throwable;

class WebRobberJob implements ShouldQueue
{
    /**
     *
     */
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @param WebRobber $webRobber
     */
    public function __construct(public WebRobber $webRobber)
    {
        //
    }

    /**
     * @param Throwable $exception
     * @return void
     */
    public function failed(Throwable $exception): void
    {
        Log::channel('daily')->error($exception);

        $message = $exception->getMessage();
        $message = "Произошла ошибка. {$message}";

        $this->webRobber->status = WebRobberStatus::COMPLETED;
        $this->webRobber->message = trim($message);
        $this->webRobber->save();
    }

    /**
     * @return void
     * @throws Throwable
     */
    public function handle(): void
    {
        if ($this->webRobber->status->is(WebRobberStatus::QUEUE) !== true) return;

        $this->webRobber->update(['status' => WebRobberStatus::PROCESS]);

        $this->execute();

        $this->webRobber->update(['status' => WebRobberStatus::COMPLETED]);
    }

    /**
     * @return void
     * @throws Throwable
     */
    public function execute(): void
    {
        /**
         *
         */
        $languages = Language::orderBy('id')->get();

        /**
         *
         */
        $theLastSyllable = str($this->webRobber->route)->explode('/')->last();
        $theLastSyllable = WebPage::clearTheRouteOfExtraCharacters($theLastSyllable);

        /**
         *
         */
        foreach ($languages as $language)
        {
            /**
             *
             */
            sleep(10);

            /**
             *
             */
            $redirect = $this->webRobber->domain . '/' . $language->codename . '/' . $this->webRobber->route;

            /**
             *
             */
            try {
                $response = Http::get($redirect);
                $response->throwUnlessStatus(200);
            }
            catch (Throwable $exception) {
                Log::channel('daily')->error($exception);

                $this->webRobber->message  = "{$this->webRobber->message} Не удалось спарсить страницу: ";
                $this->webRobber->message .= "{$redirect}.";
                $this->webRobber->message  = trim($this->webRobber->message);
                $this->webRobber->save();

                continue;
            }

            /**
             *
             */
            $responseBody = $response->body();
            $responseBody = iconv('windows-1251', 'UTF-8', $responseBody);

            /**
             *
             */
            $crawler = new Crawler();
            $crawler->addHtmlContent($responseBody);

            /**
             *
             */
            $content = $crawler->filter('.main_inner')->first()->html();

            $tidy__params = [];
            $tidy__params['wrap'] = 0;
            $tidy__params['indent'] = true;
            $tidy__params['indent-spaces'] = 4;
            $tidy__params['show-body-only'] = true;
            $tidy__params['fix-style-tags'] = false;
            $tidy__params['merge-divs'] = false;
            $tidy__params['drop-empty-paras'] = false;
            $tidy__params['drop-empty-elements'] = false;

            $tidy = new \tidy();
            $tidy->parseString($content, $tidy__params);
            $tidy->cleanRepair();

            $content = tidy_get_output($tidy);

            /**
             *
             */
            $crawler__content = new Crawler();
            $crawler__content->addHtmlContent($content);

            /**
             *
             */
            $attributes_0 = [];
            $attributes_0['route'] = $theLastSyllable;
            $attributes_0['parent_id'] = $this->webRobber->webSite->webPages()->where(['a_route' => $this->webRobber->routeWithoutTheLastSyllable])->first()->id;
            $attributes_0['web_site_id'] = $this->webRobber->webSite->id;

            $attributes_1 = [];
            $attributes_1['name'] = $crawler__content->filter('h1')->first()?->text();
            $attributes_1['name'] = str($attributes_1['name'])->trim()->value() ?: $this->webRobber->route;

            $webPage = WebPage::firstOrCreate($attributes_0, $attributes_1);

            /**
             *
             */
            $attributes_0 = [];
            $attributes_0['language_id'] = $language->id;
            $attributes_0['web_page_id'] = $webPage->id;

            $attributes_1 = [];
            $attributes_1['title'] = $crawler->filter('title')->first()?->text();
            $attributes_1['description'] = $crawler->filter('meta[name="Description"]')->first()?->attr('content');
            $attributes_1['og_title'] = $attributes_1['title'];
            $attributes_1['og_description'] = $attributes_1['description'];
            $attributes_1['name_of_the_crumb'] = $crawler__content->filter('.breadcrumbs span[itemprop="name"]')->last()?->text();
            $attributes_1['is_home'] = false;
            $attributes_1['is_enabled'] = true;
            $attributes_1['web_page_template_id'] = $this->webRobber->webPageTemplate->id;

            $webPageLanguage = WebPageLanguage::updateOrCreate($attributes_0, $attributes_1);

            /**
             *
             */
            $attributes = [];
            $attributes['blade'] = $content;
            $attributes['web_page_language_id'] = $webPageLanguage->id;

            $webPageLanguageVersion = WebPageLanguageVersion::create($attributes);

            $webPageLanguage->web_page_language_version_id = $webPageLanguageVersion->id;
            $webPageLanguage->save();

            /**
             *
             */
            $crawler__content->filter('[src], [href]')->each(
                function ($element) {
                    $attribute = $element->attr('src') ?? $element->attr('href');
                    $attribute = trim($attribute);

                    if (preg_match("/^\/common\/(.*?)$/", $attribute, $path)) {
                        try {
                            $relative = trim($path[1]);
                            $absolute = Storage::disk('common')->path($relative);

                            Log::channel('daily')->info('[ Парсинг ] Найден путь до файла.', ['attribute' => $attribute, 'relative' => $relative, 'absolute' => $absolute]);

                            \Illuminate\Support\Facades\File::ensureDirectoryExists(dirname($absolute));

                            Log::channel('daily')->info('[ Парсинг ] Папка до файла успешно была создана.');

                            $download = Http::timeout(60 * 12)->withOptions(['sink' => $absolute])->get(str($this->webRobber->domain)->append($attribute)->value());
                            $download->throwUnlessStatus(200);
                        }
                        catch (Throwable $exception) {
                            Log::channel('daily')->error($exception);

                            $this->webRobber->message  = "{$this->webRobber->message} Не удалось загрузить файл: ";
                            $this->webRobber->message .= "{$attribute} - {$exception->getMessage()}.";
                            $this->webRobber->message  = trim($this->webRobber->message);
                            $this->webRobber->save();
                        }
                    }
                }
            );
        }
    }
}
