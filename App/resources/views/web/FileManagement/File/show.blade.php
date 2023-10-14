<x-app-layout>
    @section('title', __('Файловый менеджер'))

    @php
        $path = request()->query('path', '');
        $path_collection = str($path)->explode(DIRECTORY_SEPARATOR)->filter();
        $path_collection_passed = collect();

        $breadcrumb = collect();
        $breadcrumb->push(['name' => 'Файловый менеджер', 'href' => route('file-management.index')]);

        foreach ($path_collection as $exploded)
        {
            $path_collection_passed->push($exploded);
            $path_collection_passed_imploded = $path_collection_passed->implode(DIRECTORY_SEPARATOR);

            $breadcrumb->push(['name' => $exploded, 'href' => route('file-management.index', ['path' => $path_collection_passed_imploded])]);
        }
    @endphp

    <x-breadcrumb
        :navigation="$breadcrumb"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $file->getBasename() }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-back
                                class="nav-link" :action="url()->previous()"
                            ></x-link-to-back>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:FileManagement:Delete" :action="route('file-management.file.destroy', ['path' => request()->query('path', '')])"
                            ></x-link-to-delete>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex align-items-center">
                            <span class="w-25">Наименование:</span>
                            <span>{{ $file->getBasename() }}</span>
                        </li>

                        <li class="list-group-item d-flex align-items-center">
                            <span class="w-25">Путь:</span>
                            <span>{{ $file->getPathname() }}</span>
                        </li>

                        <li class="list-group-item d-flex align-items-center">
                            <span class="w-25">Расширение:</span>
                            <span>{{ $file->getExtension() }}</span>
                        </li>

                        <li class="list-group-item d-flex align-items-center">
                            <span class="w-25">Размер:</span>
                            <span>{{ round($file->getSize() / 1024 / 1024, 8) }} mb.</span>
                        </li>

                        <li class="list-group-item d-flex align-items-center">
                            <span class="w-25">Ссылка:</span>
                            <span><x-a :href="$file->url()" target="_blank">{{ $file->url() }}</x-a></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
