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
                'name' => $webPagination->name,
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            @foreach($webPagination->languages as $item)
                                <a @class(['small text-decoration-none', 'text-muted' => $webPaginationLanguage->id !== $item->id]) href="?language={{ $item->id }}">
                                    Язык: {{ $item->language->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $webPagination->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:WebPagination:Update" :disabled="$edit" :action="route('web-sites.web-paginations.edit', [
                                    'webSite' => $webSite->id,
                                    'webPagination' => $webPagination->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webPaginationLanguage->id }}">
                            </x-link-to-update>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:WebPagination:Delete" :action="route('web-sites.web-paginations.destroy', [
                                    'webSite' => $webSite->id,
                                    'webPagination' => $webPagination->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webPaginationLanguage->id }}">
                            </x-link-to-delete>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('web-sites.web-paginations.update', [
                            'webSite' => $webSite->id,
                            'webPagination' => $webPagination->id
                        ])"
                    >
                        @method('PATCH')

                        <input type="hidden" name="web_pagination_language_id" value="{{ $webPaginationLanguage->id }}">

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
                                                    <x-input id="webPagination.name" name="webPagination[name]" :value="old('webPagination.name', $webPagination->name)" :invalid="$errors->has('webPagination.name')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webPagination.name')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webPagination.key">Ключ *</x-label>
                                                    <x-input id="webPagination.key" name="webPagination[key]" :value="old('webPagination.key', $webPagination->key)" :invalid="$errors->has('webPagination.key')" :disabled="!$edit"></x-input>
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
                                            <h6 class="card-title mb-0">Мультиязычность - {{ $webPaginationLanguage->language->name }}</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="webPaginationLanguage.blade">Blade</x-label>
                                                    <x-codemirror id="webPaginationLanguage.blade" name="webPaginationLanguage[blade]" :value="old('webPaginationLanguage.blade', $webPaginationLanguage->blade)" :invalid="$errors->has('webPaginationLanguage.blade')" :disabled="!$edit"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('webPaginationLanguage.blade')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($edit)
                                <div class="col-12">
                                    <div class="p-3 bg-light rounded">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <x-button class="btn-primary">
                                                Применить изменения
                                            </x-button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
