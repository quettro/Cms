@section('title', __('Шаблоны'))

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
                'name' => 'Шаблоны',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Шаблоны</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:WebMenu:Create" :action="route('web-sites.web-menu.web-menu-templates.create', [
                                    'webSite' => $webSite->id,
                                    'webMenu' => $webMenu->id
                                ])"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $webMenuTemplates->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Наименование</th>
                                <th scope="col" class="fw-semibold text-center">Ключ</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($webMenuTemplates as $webMenuTemplate)
                                <tr>
                                    <th class="text-center">{{ $webMenuTemplate->id }}</th>
                                    <td class="text-center">{{ $webMenuTemplate->name }}</td>
                                    <td class="text-center">{{ $webMenuTemplate->key }}</td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <x-link-to-view
                                                permission="Cms:WebMenu:View" :action="route('web-sites.web-menu.web-menu-templates.show', [
                                                    'webSite' => $webSite->id,
                                                    'webMenu' => $webMenu->id,
                                                    'webMenuTemplate' => $webMenuTemplate->id,
                                                ])"
                                            />

                                            <x-link-to-delete
                                                permission="Cms:WebMenu:Delete" :action="route('web-sites.web-menu.web-menu-templates.destroy', [
                                                    'webSite' => $webSite->id,
                                                    'webMenu' => $webMenu->id,
                                                    'webMenuTemplate' => $webMenuTemplate->id,
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
