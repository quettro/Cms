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
                        <h6 class="card-title mb-0">Файловый менеджер</h6>

                        @can('Cms:FileManagement:Create')
                            <div class="nav justify-content-end">
                                <button class="btn btn-link py-0 text-decoration-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-U" aria-controls="offcanvas-U">Добавить файл(ы)</button>
                                <button class="btn btn-link py-0 text-decoration-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-F" aria-controls="offcanvas-F">Добавить новую папку</button>

                                @if($p = request()->query('path', ''))
                                    @can('Cms:FileManagement:Delete')
                                        <x-form :action="route('file-management.dir.destroy', ['path' => $p])" class="js--form-delete"> @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger py-0 text-decoration-none">
                                                Удалить папку "{{ basename($p) }}"
                                            </button>
                                        </x-form>
                                    @endcan
                                @endif
                            </div>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    @if($collection->isEmpty())
                        На данный момент список пуст.
                    @else
                        <div class="file-management">
                            @foreach($collection as $object)
                                @php
                                    $params = [];
                                    $params['route'] = $object->isFile() ? 'file-management.file.show' : 'file-management.index';
                                @endphp

                                <div class="file-management__item">
                                    <div class="d-flex flex-column-reverse">
                                        <a href="{{ route($params['route'], ['path' => $object->relative]) }}" class="file-management__item-link">{{ $object->getBasename() }}</a>

                                        <div class="file-management__item-preview">
                                            @if(!$object->isFile())
                                                <i class="fa-solid fa-folder text-dark"></i>
                                            @else
                                                @if(str($object->getExtension())->contains(['png', 'jpg', 'jpeg']))
                                                    <img src="{{ $object->url() }}" alt="{{ $object->getBasename() }}">
                                                @else
                                                    @if(empty($object->getExtension()))
                                                        <i class="fa-solid fa-file-circle-exclamation text-muted"></i>
                                                    @else
                                                        <i class="fa-solid fa-file text-muted"></i>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @can('Cms:FileManagement:Create')
        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvas-U" aria-labelledby="offcanvas-U-Label">
            <div class="container">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvas-U-Label">
                        Добавить файл(ы)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                    <x-form id="dropzone" class="dropzone" :action="route('file-management.file.store')" enctype="multipart/form-data">
                        <input type="hidden" name="path" value="{{ request()->query('path', '') }}">

                        <div class="fallback">
                            <input type="file" name="file[]" multiple="" required="">
                        </div>
                    </x-form>

                    @push('up')
                        <script type="module">
                            let _params = {};
                                _params.paramName = 'file';
                                _params.dictDefaultMessage = 'Перетащите файлы сюда, чтобы загрузить их на сервер.';

                            new window.Dropzone('#dropzone', _params);
                        </script>
                    @endpush
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvas-F" aria-labelledby="offcanvas-F-Label">
            <div class="container">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvas-F-Label">
                        Добавить новую папку
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                    <div class="card">
                        <div class="card-body">
                            <x-form :action="route('file-management.dir.store')">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <x-form-group>
                                            <x-label for="path">Путь *</x-label>
                                            <x-input id="path" name="path" :value="old('path', request()->query('path', ''))" :invalid="$errors->has('path')" readonly=""></x-input>
                                            <x-invalid-feedback :messages="$errors->get('path')"></x-invalid-feedback>
                                            <x-text-feedback>Место, где будет создана новая папка. Данное поле только для чтения.</x-text-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-lg-12">
                                        <x-form-group>
                                            <x-label for="name">Наименование *</x-label>
                                            <x-input id="name" name="name" :value="old('name')" :invalid="$errors->has('name')"></x-input>
                                            <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-12">
                                        <div class="p-3 bg-light rounded">
                                            <div class="d-flex justify-content-end align-items-center">
                                                <x-button class="btn-primary">
                                                    Продолжить
                                                </x-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
</x-app-layout>
