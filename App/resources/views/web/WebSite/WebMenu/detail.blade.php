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
                'href' => route('web-sites.web-menu.index', $webSite->id)
            ],
            [
                'name' => $webMenu->name,
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $webMenu->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:WebMenu:Update" :disabled="$edit" :action="route('web-sites.web-menu.edit', [
                                    'webSite' => $webSite->id,
                                    'webMenu' => $webMenu->id
                                ])"
                            />

                            <x-link-to-delete
                                class="nav-link" permission="Cms:WebMenu:Delete" :action="route('web-sites.web-menu.destroy', [
                                    'webSite' => $webSite->id,
                                    'webMenu' => $webMenu->id
                                ])"
                            />

                            <x-link-to
                                class="nav-link" permission="Cms:WebMenu:Index" :action="route('web-sites.web-menu.web-menu-items.index', [
                                    'webSite' => $webSite->id,
                                    'webMenu' => $webMenu->id
                                ])"
                            >Ссылки</x-link-to>

                            <x-link-to
                                class="nav-link" permission="Cms:WebMenu:Index" :action="route('web-sites.web-menu.web-menu-templates.index', [
                                    'webSite' => $webSite->id,
                                    'webMenu' => $webMenu->id
                                ])"
                            >Шаблоны</x-link-to>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('web-sites.web-menu.update', [
                            'webSite' => $webSite->id,
                            'webMenu' => $webMenu->id
                        ])"
                    >
                        @method('PATCH')

                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="name">Наименование *</x-label>
                                    <x-input id="name" name="name" :value="old('name', $webMenu->name)" :invalid="$errors->has('name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="key">Ключ *</x-label>
                                    <x-input id="key" name="key" :value="old('key', $webMenu->key)" :invalid="$errors->has('key')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('key')"></x-invalid-feedback>
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
