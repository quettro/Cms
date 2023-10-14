@section('title', __('Страницы'))

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
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Страницы</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:WebPage:Create" :action="route('web-sites.web-pages.create', $webSite->id)"
                            />
                        </div>
                    </div>
                </div>
                <div class="card-body"><x-w-tree :root="true" :webSite="$webSite" :webPages="$webPages" /></div>
            </div>
        </div>
    </div>
</x-app-layout>
