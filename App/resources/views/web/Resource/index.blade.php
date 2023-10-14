<x-app-layout>
    @section('title', __('Ресурсы'))

    <x-breadcrumb
        :navigation="[
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
                                class="nav-link" permission="Cms:Resource:Create" :action="route('resources.create')"
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
                        Глобальные стили и скрипты подключаемые в верхней части сайта - < /head>
                    </div>

                    <table class="table table-bordered" data-toggle="sortable" data-type="table" data-save-to="{{ route('resources.position') }}">
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
                            @foreach($resources as $resource)
                                @if(!$resource->isPositionHead())
                                    @continue
                                @endif

                                <tr class="bg-white" data-id="{{ $resource->id }}">
                                    <td class="text-center"><i class="fa fa-arrows" aria-hidden="true" data-toggle="sortable-handle"></i></td>
                                    <td class="text-center">{{ $resource->file->filename }}</td>
                                    <td class="text-center">{{ $resource->file->extension }}</td>
                                    <td class="text-center"><span class="badge bg-primary">{{ round($resource->file->size / 1024, 2) }} кб.</span></td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <x-link-to-delete
                                                permission="Cms:Resource:Delete" :action="route('resources.destroy', [
                                                    'resource' => $resource->id,
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
                        Глобальные стили и скрипты подключаемые в нижней части сайта - < /body>
                    </div>

                    <table class="table table-bordered" data-toggle="sortable" data-type="table" data-save-to="{{ route('resources.position') }}">
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
                            @foreach($resources as $resource)
                                @if(!$resource->isPositionBody())
                                    @continue
                                @endif

                                <tr class="bg-white" data-id="{{ $resource->id }}">
                                    <td class="text-center"><i class="fa fa-arrows" data-toggle="sortable-handle"></i></td>
                                    <td class="text-center">{{ $resource->file->filename }}</td>
                                    <td class="text-center">{{ $resource->file->extension }}</td>
                                    <td class="text-center"><span class="badge bg-primary">{{ round($resource->size / 1024, 2) }} кб.</span></td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <x-link-to-delete
                                                permission="Cms:Resource:Delete" :action="route('resources.destroy', [
                                                    'resource' => $resource->id,
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
