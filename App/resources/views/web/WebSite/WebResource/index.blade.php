@section('title', __('Ресурсы'))

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
                'name' => 'Ресурсы',
                'href' => ''
            ]
        ]"
    />

    <div class="row gap-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Ресурсы</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:WebResource:Create" :action="route('web-sites.web-resources.create', $webSite->id)"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-primary">
                        Стили и скрипты подключаемые в верхней части сайта - < /head>
                    </div>

                    <table class="table table-bordered" data-toggle="sortable" data-type="table" data-save-to="{{ route('web-sites.web-resources.position', $webSite->id) }}">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Порядок</th>
                                <th scope="col" class="text-center">Наименование</th>
                                <th scope="col" class="text-center">Расширение</th>
                                <th scope="col" class="text-center">Размер</th>
                                <th scope="col" class="text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($webResources as $webResource)
                                @if(!$webResource->isPositionHead())
                                    @continue
                                @endif

                                <tr class="bg-white" data-id="{{ $webResource->id }}">
                                    <td class="text-center"><i class="fa fa-arrows" aria-hidden="true" data-toggle="sortable-handle"></i></td>
                                    <td class="text-center">{{ $webResource->file->filename }}</td>
                                    <td class="text-center">{{ $webResource->file->extension }}</td>
                                    <td class="text-center"><span class="badge bg-primary">{{ round($webResource->file->size / 1024, 2) }} кб.</span></td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <x-link-to-delete
                                                permission="Cms:WebResource:Delete" :action="route('web-sites.web-resources.destroy', [
                                                    'webSite' => $webSite->id,
                                                    'webResource' => $webResource->id
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

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-primary">
                        Стили и скрипты подключаемые в нижней части сайта - < /body>
                    </div>

                    <table class="table table-bordered" data-toggle="sortable" data-type="table" data-save-to="{{ route('web-sites.web-resources.position', $webSite->id) }}">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Порядок</th>
                                <th scope="col" class="text-center">Наименование</th>
                                <th scope="col" class="text-center">Расширение</th>
                                <th scope="col" class="text-center">Размер</th>
                                <th scope="col" class="text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($webResources as $webResource)
                                @if(!$webResource->isPositionBody())
                                    @continue
                                @endif

                                <tr class="bg-white" data-id="{{ $webResource->id }}">
                                    <td class="text-center"><i class="fa fa-arrows" aria-hidden="true" data-toggle="sortable-handle"></i></td>
                                    <td class="text-center">{{ $webResource->file->filename }}</td>
                                    <td class="text-center">{{ $webResource->file->extension }}</td>
                                    <td class="text-center"><span class="badge bg-primary">{{ round($webResource->size / 1024, 2) }} кб.</span></td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <x-link-to-delete
                                                permission="Cms:WebResource:Delete" :action="route('web-sites.web-resources.destroy', [
                                                    'webSite' => $webSite->id,
                                                    'webResource' => $webResource->id
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
