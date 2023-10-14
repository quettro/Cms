@section('title', __('Меню'))

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
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Меню</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:WebMenu:Create" :action="route('web-sites.web-menu.create', $webSite->id)"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $webMenu->links() }}
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
                            @foreach($webMenu as $wm)
                                <tr>
                                    <th class="text-center">{{ $wm->id }}</th>
                                    <td class="text-center">{{ $wm->name }}</td>
                                    <td class="text-center">{{ $wm->key }}</td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <x-link-to-view
                                                permission="Cms:WebMenu:View" :action="route('web-sites.web-menu.show', [
                                                    'webSite' => $webSite->id,
                                                    'webMenu' => $wm->id
                                                ])"
                                            />

                                            <x-link-to-delete
                                                permission="Cms:WebMenu:Delete" :action="route('web-sites.web-menu.destroy', [
                                                    'webSite' => $webSite->id,
                                                    'webMenu' => $wm->id
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
