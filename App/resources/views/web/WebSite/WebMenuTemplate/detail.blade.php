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
                'href' => route('web-sites.web-menu.show', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id])
            ],
            [
                'name' => 'Шаблоны',
                'href' => route('web-sites.web-menu.web-menu-templates.index', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id])
            ],
            [
                'name' => $webMenuTemplate->name,
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
                            @foreach($webMenuTemplate->languages as $item)
                                <a @class(['small text-decoration-none', 'text-muted' => $webMenuTemplateLanguage->id !== $item->id]) href="?language={{ $item->id }}">
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
                        <h6 class="card-title mb-0">{{ $webMenuTemplate->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:WebMenu:Update" :disabled="$edit" :action="route('web-sites.web-menu.web-menu-templates.edit', [
                                    'webSite' => $webSite->id,
                                    'webMenu' => $webMenu->id,
                                    'webMenuTemplate' => $webMenuTemplate->id,
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webMenuTemplateLanguage->id }}">
                            </x-link-to-update>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:WebMenu:Delete" :action="route('web-sites.web-menu.web-menu-templates.destroy', [
                                    'webSite' => $webSite->id,
                                    'webMenu' => $webMenu->id,
                                    'webMenuTemplate' => $webMenuTemplate->id,
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webMenuTemplateLanguage->id }}">
                            </x-link-to-delete>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('web-sites.web-menu.web-menu-templates.update', [
                            'webSite' => $webSite->id,
                            'webMenu' => $webMenu->id,
                            'webMenuTemplate' => $webMenuTemplate->id,
                        ])"
                    >
                        @method('PATCH')

                        <input type="hidden" name="web_menu_template_language_id" value="{{ $webMenuTemplateLanguage->id }}">

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
                                                    <x-input id="webMenuTemplate.name" name="webMenuTemplate[name]" :value="old('webMenuTemplate.name', $webMenuTemplate->name)" :invalid="$errors->has('webMenuTemplate.name')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webMenuTemplate.name')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webMenuTemplate.key">Ключ *</x-label>
                                                    <x-input id="webMenuTemplate.key" name="webMenuTemplate[key]" :value="old('webMenuTemplate.key', $webMenuTemplate->key)" :invalid="$errors->has('webMenuTemplate.key')" :disabled="!$edit"></x-input>
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
                                            <h6 class="card-title mb-0">Мультиязычность - {{ $webMenuTemplateLanguage->language->name }}</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="webMenuTemplateLanguage.blade">Blade</x-label>
                                                    <x-codemirror id="webMenuTemplateLanguage.blade" name="webMenuTemplateLanguage[blade]" :value="old('webMenuTemplateLanguage.blade', $webMenuTemplateLanguage->blade)" :invalid="$errors->has('webMenuTemplateLanguage.blade')" :disabled="!$edit"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('webMenuTemplateLanguage.blade')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="webMenuTemplateLanguage.blade_for_recursive">Рекурсивный Blade для древовидной структуры</x-label>
                                                    <x-codemirror id="webMenuTemplateLanguage.blade_for_recursive" name="webMenuTemplateLanguage[blade_for_recursive]" :value="old('webMenuTemplateLanguage.blade_for_recursive', $webMenuTemplateLanguage->blade_for_recursive)" :invalid="$errors->has('webMenuTemplateLanguage.blade_for_recursive')" :disabled="!$edit"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('webMenuTemplateLanguage.blade_for_recursive')"></x-invalid-feedback>
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
