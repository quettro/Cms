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
                'href' => route('web-sites.web-breadcrumbs.index', $webSite->id)
            ],
            [
                'name' => $webBreadcrumb->name,
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $webBreadcrumb->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:WebBreadcrumb:Update" :disabled="$edit" :action="route('web-sites.web-breadcrumbs.edit', [
                                    'webSite' => $webSite->id,
                                    'webBreadcrumb' => $webBreadcrumb->id
                                ])"
                            />

                            <x-link-to-delete
                                class="nav-link" permission="Cms:WebBreadcrumb:Delete" :action="route('web-sites.web-breadcrumbs.destroy', [
                                    'webSite' => $webSite->id,
                                    'webBreadcrumb' => $webBreadcrumb->id
                                ])"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('web-sites.web-breadcrumbs.update', [
                            'webSite' => $webSite->id,
                            'webBreadcrumb' => $webBreadcrumb->id
                        ])"
                    >
                        @method('PATCH')

                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="name">Наименование *</x-label>
                                    <x-input id="name" name="name" :value="old('name', $webBreadcrumb->name)" :invalid="$errors->has('name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="key">Ключ *</x-label>
                                    <x-input id="key" name="key" :value="old('key', $webBreadcrumb->key)" :invalid="$errors->has('key')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="blade">Blade</x-label>
                                    <x-codemirror id="blade" name="blade" :value="old('blade', $webBreadcrumb->blade)" :invalid="$errors->has('blade')" :disabled="!$edit"></x-codemirror>
                                    <x-invalid-feedback :messages="$errors->get('blade')"></x-invalid-feedback>
                                </x-form-group>
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
