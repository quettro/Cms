@section('title', __('Хлебные крошки'))

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
                'name' => 'Хлебные крошки',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Хлебные крошки</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:WebBreadcrumb:Create" :action="route('web-sites.web-breadcrumbs.create', $webSite->id)"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $webBreadcrumbs->links() }}
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
                            @foreach($webBreadcrumbs as $webBreadcrumb)
                                <tr>
                                    <th class="text-center">{{ $webBreadcrumb->id }}</th>
                                    <td class="text-center">{{ $webBreadcrumb->name }}</td>
                                    <td class="text-center">{{ $webBreadcrumb->key }}</td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <x-link-to-view
                                                permission="Cms:WebBreadcrumb:View" :action="route('web-sites.web-breadcrumbs.show', [
                                                    'webSite' => $webSite->id,
                                                    'webBreadcrumb' => $webBreadcrumb->id
                                                ])"
                                            />

                                            <x-link-to-delete
                                                permission="Cms:WebBreadcrumb:Delete" :action="route('web-sites.web-breadcrumbs.destroy', [
                                                    'webSite' => $webSite->id,
                                                    'webBreadcrumb' => $webBreadcrumb->id
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
