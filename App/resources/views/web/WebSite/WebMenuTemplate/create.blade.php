@section('title', __('Шаблоны'))

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
                'href' => route('web-sites.web-menu.show', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id ])
            ],
            [
                'name' => 'Шаблоны',
                'href' => route('web-sites.web-menu.web-menu-templates.index', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id ])
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
                                class="nav-link" :action="route('web-sites.web-menu.web-menu-templates.index', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id ])"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('web-sites.web-menu.web-menu-templates.store', [
                            'webSite' => $webSite->id,
                            'webMenu' => $webMenu->id,
                        ])"
                    >
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
                                                    <x-label for="webMenuTemplate.name">Наименование *</x-label>
                                                    <x-input id="webMenuTemplate.name" name="webMenuTemplate[name]" :value="old('webMenuTemplate.name')" :invalid="$errors->has('webMenuTemplate.name')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webMenuTemplate.name')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webMenuTemplate.key">Ключ *</x-label>
                                                    <x-input id="webMenuTemplate.key" name="webMenuTemplate[key]" :value="old('webMenuTemplate.key')" :invalid="$errors->has('webMenuTemplate.key')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webMenuTemplate.key')"></x-invalid-feedback>
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
                                                    <x-label for="webMenuTemplateLanguage.blade">Blade</x-label>
                                                    <x-codemirror id="webMenuTemplateLanguage.blade" name="webMenuTemplateLanguage[blade]" :value="old('webMenuTemplateLanguage.blade')" :invalid="$errors->has('webMenuTemplateLanguage.blade')"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('webMenuTemplateLanguage.blade')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="webMenuTemplateLanguage.blade_for_recursive">Рекурсивный Blade для древовидной структуры</x-label>
                                                    <x-codemirror id="webMenuTemplateLanguage.blade_for_recursive" name="webMenuTemplateLanguage[blade_for_recursive]" :value="old('webMenuTemplateLanguage.blade_for_recursive')" :invalid="$errors->has('webMenuTemplateLanguage.blade_for_recursive')"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('webMenuTemplateLanguage.blade_for_recursive')"></x-invalid-feedback>
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
