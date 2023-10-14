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
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">История изменений</h6>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Страница</th>
                                <th scope="col" class="fw-semibold text-center">Язык</th>
                                <th scope="col" class="fw-semibold text-center">Версия от</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($webPageLanguageVersions as $webPageLanguageVersion)
                                <tr>
                                    <th class="text-center">{{ $webPageLanguageVersion->id }}</th>
                                    <td class="text-center">{{ $webPage->name }}</td>
                                    <td class="text-center">{{ $webPageLanguage->language->name }}</td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-3">
                                            <div class="text-muted">{{ $webPageLanguageVersion->created_at }}</div>

                                            @if($webPageLanguageVersion->id === $webPageLanguage->version->id)
                                                <div class="badge bg-primary">Текущая версия</div>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <x-link-to-view
                                                permission="Cms:WebPage:View" :action="route('web-sites.web-pages.versions.show', [
                                                    'webSite' => $webSite->id,
                                                    'webPage' => $webPage->id,
                                                    'webPageLanguageVersion' => $webPageLanguageVersion->id,
                                                    'language' => $webPageLanguage->id
                                                ])"
                                            />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
