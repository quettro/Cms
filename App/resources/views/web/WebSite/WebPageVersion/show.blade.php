<x-app-layout>
    @include('web.WebSite.sidebar')

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Сайты',
                'href' => route('web-sites.index')
            ],
            [
                'name' => $webSite->domain,
                'href' => route('web-sites.show', $webSite->id)
            ],
            [
                'name' => 'Страницы',
                'href' => route('web-sites.web-pages.index', $webSite->id)
            ],
            [
                'name' => $webPage->name,
                'href' => route('web-sites.web-pages.show', ['webSite' => $webSite->id, 'webPage' => $webPage->id ])
            ],
            [
                'name' => 'История изменений',
                'href' => route('web-sites.web-pages.versions.index', ['webSite' => $webSite->id, 'webPage' => $webPage->id, 'language' => $webPageLanguage->id ])
            ],
            [
                'name' => $webPageLanguageVersion->created_at,
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Версия страницы '{{ $webPage->name }}' от {{ $webPageLanguageVersion->created_at }}</h6>

                        <nav class="nav justify-content-end">
                            @can('Cms:WebPage:Update')
                                <x-form
                                    :action="route('web-sites.web-pages.versions.restore', [
                                        'webSite' => $webSite->id,
                                        'webPage' => $webPage->id,
                                        'webPageLanguageVersion' => $webPageLanguageVersion->id,
                                        'language' => $webPageLanguage->id
                                    ])"
                                >
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-link py-0 nav-link">
                                        Восстановить версию
                                    </button>
                                </x-form>
                            @endcan
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row gap-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header py-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="card-title mb-0">< /HEAD></h6>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <x-codemirror
                                        :value="$webPageLanguageVersion->additional_head" :disabled="true"></x-codemirror>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header py-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="card-title mb-0">< /BODY></h6>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <x-codemirror
                                        :value="$webPageLanguageVersion->additional_body" :disabled="true"></x-codemirror>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header py-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="card-title mb-0">Тестовый редактор</h6>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <x-codemirror
                                        :value="$webPageLanguageVersion->blade" :disabled="true"></x-codemirror>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
