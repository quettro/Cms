@section('title', __('Сайты'))

<x-app-layout>
    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Сайты',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Сайты</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:WebSite:Create" :action="route('web-sites.create')"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $webSites->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Наименование</th>
                                <th scope="col" class="fw-semibold text-center">Домен</th>
                                <th scope="col" class="fw-semibold text-center">Статус</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($webSites->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с сайтами пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($webSites as $webSite)
                                    <tr>
                                        <th class="text-center">{{ $webSite->id }}</th>
                                        <td class="text-center">{{ $webSite->name }}</td>
                                        <td class="text-center">{{ $webSite->domain }}</td>

                                        <td class="text-center">
                                            @if($webSite->enabled)
                                                <span class="badge badge-pill bg-success">Активен</span>
                                            @else
                                                <span class="badge badge-pill bg-danger">Отключен</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view
                                                    permission="Cms:WebSite:View" :action="route('web-sites.show', $webSite->id)"></x-link-to-view>

                                                <x-link-to-delete
                                                    permission="Cms:WebSite:Delete" :action="route('web-sites.destroy', $webSite->id)"></x-link-to-delete>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
