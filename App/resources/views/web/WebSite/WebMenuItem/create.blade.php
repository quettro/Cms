@section('title', __('Ссылки меню'))

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
                'name' => 'Ссылки',
                'href' => route('web-sites.web-menu.web-menu-items.index', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id ])
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
                                class="nav-link" :action="route('web-sites.web-menu.web-menu-items.index', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id ])"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('web-sites.web-menu.web-menu-items.store', [
                            'webSite' => $webSite->id,
                            'webMenu' => $webMenu->id
                        ])"
                    >
                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="webmenuitemlanguage.name">Наименование *</x-label>
                                    <x-input id="webmenuitemlanguage.name" name="webmenuitemlanguage[name]" :value="old('webmenuitemlanguage.name')" :invalid="$errors->has('webmenuitemlanguage.name')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('webmenuitemlanguage.name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="webmenuitemlanguage.route">Куда направить пользователя? *</x-label>
                                    <x-input id="webmenuitemlanguage.route" name="webmenuitemlanguage[route]" :value="old('webmenuitemlanguage.route')" :invalid="$errors->has('webmenuitemlanguage.route')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('webmenuitemlanguage.route')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                @php $v = static fn ($value, $key) => $value->languages()->where('language_id', $webSite->language_id)->first()?->name; @endphp

                                <x-form-group>
                                    <x-label for="webmenuitem.parent_id">Родительский элемент</x-label>
                                    <x-select id="webmenuitem.parent_id" name="webmenuitem[parent_id]" :option="$webMenuItems->dropdown(v: $v)" :o_selected="[old('webmenuitem.parent_id', request()->get('parent_id'))]" :invalid="$errors->has('webmenuitem.parent_id')"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('webmenuitem.parent_id')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-checkbox id="webmenuitemlanguage.is_enabled" name="webmenuitemlanguage[is_enabled]" :invalid="$errors->has('webmenuitemlanguage.is_enabled')" :checked="true">Включить</x-checkbox>
                                    <x-invalid-feedback :messages="$errors->get('webmenuitemlanguage.is_enabled')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="webmenuitemlanguage.blade">Blade</x-label>
                                    <x-codemirror id="webmenuitemlanguage.blade" name="webmenuitemlanguage[blade]" :value="old('webmenuitemlanguage.blade')" :invalid="$errors->has('webmenuitemlanguage.blade')"></x-codemirror>
                                    <x-invalid-feedback :messages="$errors->get('webmenuitemlanguage.blade')"></x-invalid-feedback>
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
</x-app-layout>
