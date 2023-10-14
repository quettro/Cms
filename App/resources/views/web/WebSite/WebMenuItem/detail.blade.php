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
                'href' => route('web-sites.web-menu.show', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id])
            ],
            [
                'name' => 'Ссылки',
                'href' => route('web-sites.web-menu.web-menu-items.index', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id])
            ],
            [
                'name' => $webMenuItemLanguage->name,
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
                            @foreach($webMenuItem->languages as $item)
                                <a @class(['small text-decoration-none', 'text-muted' => $webMenuItemLanguage->id !== $item->id]) href="?language={{ $item->id }}">
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
                        <h6 class="card-title mb-0">{{ $webMenuItemLanguage->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:WebMenu:Update" :disabled="$edit" :action="route('web-sites.web-menu.web-menu-items.edit', [
                                    'webSite' => $webSite->id,
                                    'webMenu' => $webMenu->id,
                                    'webMenuItem' => $webMenuItem->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webMenuItemLanguage->id }}">
                            </x-link-to-update>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:WebMenu:Delete" :action="route('web-sites.web-menu.web-menu-items.destroy', [
                                    'webSite' => $webSite->id,
                                    'webMenu' => $webMenu->id,
                                    'webMenuItem' => $webMenuItem->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webMenuItemLanguage->id }}">
                            </x-link-to-delete>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('web-sites.web-menu.web-menu-items.update', [
                            'webSite' => $webSite->id,
                            'webMenu' => $webMenu->id,
                            'webMenuItem' => $webMenuItem->id
                        ])"
                    >
                        @method('PATCH')

                        <div class="row">
                            <input type="hidden" name="web_menu_item_language_id" value="{{ $webMenuItemLanguage->id }}">

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="webmenuitemlanguage.name">Наименование *</x-label>
                                    <x-input id="webmenuitemlanguage.name" name="webmenuitemlanguage[name]" :value="old('webmenuitemlanguage.name', $webMenuItemLanguage->name)" :invalid="$errors->has('webmenuitemlanguage.name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('webmenuitemlanguage.name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="webmenuitemlanguage.route">Куда направить пользователя? *</x-label>
                                    <x-input id="webmenuitemlanguage.route" name="webmenuitemlanguage[route]" :value="old('webmenuitemlanguage.route', $webMenuItemLanguage->route)" :invalid="$errors->has('webmenuitemlanguage.route')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('webmenuitemlanguage.route')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                @php $v = static fn ($value, $key) => $value->languages()->where('language_id', $webSite->language_id)->first()?->name; @endphp

                                <x-form-group>
                                    <x-label for="webmenuitem.parent_id">Родительский элемент</x-label>
                                    <x-select id="webmenuitem.parent_id" name="webmenuitem[parent_id]" :option="$webMenuItems->dropdown(v: $v)" :o_selected="[old('webmenuitem.parent_id', $webMenuItem->parent_id)]" :invalid="$errors->has('webmenuitem.parent_id')" :disabled="!$edit"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('webmenuitem.parent_id')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-checkbox id="webmenuitemlanguage.is_enabled" name="webmenuitemlanguage[is_enabled]" :invalid="$errors->has('webmenuitemlanguage.is_enabled', $webMenuItemLanguage->is_enabled)" :checked="$webMenuItemLanguage->is_enabled">Включить</x-checkbox>
                                    <x-invalid-feedback :messages="$errors->get('webmenuitemlanguage.is_enabled')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="webmenuitemlanguage.blade">Blade</x-label>
                                    <x-codemirror id="webmenuitemlanguage.blade" name="webmenuitemlanguage[blade]" :value="old('webmenuitemlanguage.blade', $webMenuItemLanguage->blade)" :invalid="$errors->has('webmenuitemlanguage.blade')" :disabled="!$edit"></x-codemirror>
                                    <x-invalid-feedback :messages="$errors->get('webmenuitemlanguage.blade')"></x-invalid-feedback>
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
