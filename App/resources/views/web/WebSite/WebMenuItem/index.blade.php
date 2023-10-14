@section('title', __('Ссылки меню'))

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
                'name' => 'Меню',
                'href' => route('web-sites.web-menu.index', $webSite->id)
            ],
            [
                'name' => $webMenu->name,
                'href' => route('web-sites.web-menu.show', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id ])
            ],
            [
                'name' => 'Ссылки',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Ссылки</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:WebMenu:Create" :action="route('web-sites.web-menu.web-menu-items.create', [
                                    'webSite' => $webSite->id,
                                    'webMenu' => $webMenu->id
                                ])"
                            />
                        </div>
                    </div>
                </div>
                <div class="card-body"><x-menu-tree :root="true" :webSite="$webSite" :webMenu="$webMenu" :webMenuItems="$webMenuItems" /></div>
            </div>
        </div>
    </div>
</x-app-layout>
