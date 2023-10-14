@section('title', __('Пагинации'))

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
                'name' => 'Пагинации',
                'href' => route('web-sites.web-paginations.index', $webSite->id)
            ],
            [
                'name' => 'Новая запись',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Новая запись</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-back
                                class="nav-link" :action="route('web-sites.web-paginations.index', $webSite->id)"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('web-sites.web-paginations.store', $webSite->id)">
                        <div class="row gap-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header py-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="card-title mb-0">Основная информация</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webPagination.name">Наименование *</x-label>
                                                    <x-input id="webPagination.name" name="webPagination[name]" :value="old('webPagination.name')" :invalid="$errors->has('webPagination.name')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webPagination.name')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webPagination.key">Ключ *</x-label>
                                                    <x-input id="webPagination.key" name="webPagination[key]" :value="old('webPagination.key')" :invalid="$errors->has('webPagination.key')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webPagination.key')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header py-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="card-title mb-0">Мультиязычность</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="webPaginationLanguage.blade">Blade</x-label>
                                                    <x-codemirror id="webPaginationLanguage.blade" name="webPaginationLanguage[blade]" :value="old('webPaginationLanguage.blade')" :invalid="$errors->has('webPaginationLanguage.blade')"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('webPaginationLanguage.blade')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
</x-app-layout>
