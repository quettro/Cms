@section('title', __('Копирование страницы'))

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
                'name' => 'Страницы',
                'href' => route('web-sites.web-pages.index', $webSite->id)
            ],
            [
                'name' => $webPage->name,
                'href' => route('web-sites.web-pages.show', ['webSite' => $webSite->id, 'webPage' => $webPage->id ])
            ],
            [
                'name' => 'Копирование страницы',
                'href' => ''
            ]
        ]"
    />

    <div class="row gap-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    Копирование страницы
                </div>
            </div>
        </div>

        <div class="col-12">
            <x-form :action="route('web-sites.web-pages.copy.store', ['webSite' => $webSite->id, 'webPage' => $webPage->id ])" enctype="multipart/form-data">
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
                                            <x-label for="webpage.name">Наименование *</x-label>
                                            <x-input id="webpage.name" name="webpage[name]" :value="old('webpage.name', $webPage->name)" :invalid="$errors->has('webpage.name')"></x-input>
                                            <x-invalid-feedback :messages="$errors->get('webpage.name')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-lg-6">
                                        <x-form-group>
                                            <x-label for="webpage.route">URL *</x-label>
                                            <x-input id="webpage.route" name="webpage[route]" :value="old('webpage.route', $webPage->route)" :invalid="$errors->has('webpage.route')"></x-input>
                                            <x-invalid-feedback :messages="$errors->get('webpage.route')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-lg-6">
                                        <x-form-group>
                                            <x-label for="webpage.web_site_id">Сайт *</x-label>

                                            <x-select-custom id="webpage.web_site_id" name="webpage[web_site_id]" :invalid="$errors->has('webpage.web_site_id')">
                                                @foreach($websites as $_website)
                                                    <x-option :value="$_website->id" :selected="$_website->id == old('webpage.web_site_id')" data-id="website-{{ $_website->id }}">
                                                        {{ $_website->domain }}
                                                    </x-option>
                                                @endforeach
                                            </x-select-custom>

                                            <x-invalid-feedback :messages="$errors->get('webpage.web_site_id')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-lg-6">
                                        <x-form-group>
                                            <x-label for="webpage.parent_id">Родительская страница</x-label>

                                            <x-select-custom id="webpage.parent_id" name="webpage[parent_id]" data-chained="webpage.web_site_id" :invalid="$errors->has('webpage.parent_id')">
                                                @foreach($websites as $_website)
                                                    @foreach($_website->webpages as $_webpage)
                                                        <x-option :value="$_webpage->id" :selected="$_webpage->id == old('webpage.parent_id')" data-chained="website-{{ $_website->id }}">
                                                            [ {{ $_webpage->name }} ] - {{ $_webpage->a_route }}
                                                        </x-option>
                                                    @endforeach
                                                @endforeach
                                            </x-select-custom>

                                            <x-invalid-feedback :messages="$errors->get('webpage.parent_id')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-lg-6">
                                        <x-form-group>
                                            <x-label for="webpagelanguage.web_page_template_id">Шаблон страницы *</x-label>

                                            <x-select-custom id="webpagelanguage.web_page_template_id" name="webpagelanguage[web_page_template_id]" data-chained="webpage.web_site_id" :invalid="$errors->has('webpagelanguage.web_page_template_id')">
                                                @foreach($websites as $_website)
                                                    @foreach($_website->webpagetemplates as $_webpagetemplate)
                                                        <x-option :value="$_webpagetemplate->id" :selected="$_webpagetemplate->id == old('webpagelanguage.web_page_template_id')" data-chained="website-{{ $_website->id }}">
                                                            {{ $_webpagetemplate->name }}
                                                        </x-option>
                                                    @endforeach
                                                @endforeach
                                            </x-select-custom>

                                            <x-invalid-feedback :messages="$errors->get('webpagelanguage.web_page_template_id')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-1">
                                            <x-checkbox id="webpage.is_home" name="webpage[is_home]" :checked="$webPage->is_home">Назначить как главную страницу?</x-checkbox>
                                            <x-invalid-feedback :messages="$errors->get('webpage.is_home')"></x-invalid-feedback>
                                        </div>

                                        <div class="mb-0">
                                            <x-checkbox id="webpage.is_enabled" name="webpage[is_enabled]" :checked="$webPage->is_enabled">Включить страницу</x-checkbox>
                                            <x-invalid-feedback :messages="$errors->get('webpage.is_enabled')"></x-invalid-feedback>
                                        </div>
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
                                    <div class="col-lg-6">
                                        <x-form-group>
                                            <x-label for="webpagelanguage.title">[ Seo ] Заголовок</x-label>
                                            <x-input id="webpagelanguage.title" name="webpagelanguage[title]" :value="old('webpagelanguage.title')" :invalid="$errors->has('webpagelanguage.title')"></x-input>
                                            <x-invalid-feedback :messages="$errors->get('webpagelanguage.title')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-lg-6">
                                        <x-form-group>
                                            <x-label for="webpagelanguage.description">[ Seo ] Описание</x-label>
                                            <x-input id="webpagelanguage.description" name="webpagelanguage[description]" :value="old('webpagelanguage.description')" :invalid="$errors->has('webpagelanguage.description')"></x-input>
                                            <x-invalid-feedback :messages="$errors->get('webpagelanguage.description')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-lg-6">
                                        <x-form-group>
                                            <x-label for="webpagelanguage.keywords">[ Seo ] Ключевые слова</x-label>
                                            <x-input id="webpagelanguage.keywords" name="webpagelanguage[keywords]" :value="old('webpagelanguage.keywords')" :invalid="$errors->has('webpagelanguage.keywords')"></x-input>
                                            <x-invalid-feedback :messages="$errors->get('webpagelanguage.keywords')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-lg-6">
                                        <x-form-group>
                                            <x-label for="webpagelanguage.og_title">[ Open Graph ] Заголовок</x-label>
                                            <x-input id="webpagelanguage.og_title" name="webpagelanguage[og_title]" :value="old('webpagelanguage.og_title')" :invalid="$errors->has('webpagelanguage.og_title')"></x-input>
                                            <x-invalid-feedback :messages="$errors->get('webpagelanguage.og_title')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-lg-6">
                                        <x-form-group>
                                            <x-label for="webpagelanguage.og_description">[ Open Graph ] Описание</x-label>
                                            <x-input id="webpagelanguage.og_description" name="webpagelanguage[og_description]" :value="old('webpagelanguage.og_description')" :invalid="$errors->has('webpagelanguage.og_description')"></x-input>
                                            <x-invalid-feedback :messages="$errors->get('webpagelanguage.og_description')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>

                                    <div class="col-lg-6">
                                        <x-form-group>
                                            <x-label for="webpagelanguage.og_image">[ Open Graph ] Изображение</x-label>
                                            <x-input-file id="webpagelanguage.og_image" name="webpagelanguage[og_image]" accept=".jpg, .jpeg, .png" :invalid="$errors->has('webpagelanguage.og_image')"></x-input-file>
                                            <x-invalid-feedback :messages="$errors->get('webpagelanguage.og_image')"></x-invalid-feedback>
                                        </x-form-group>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card card-body">
                            <div class="d-flex justify-content-end">
                                <x-button class="btn-success">
                                    Продолжить
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </x-form>
        </div>
    </div>
</x-app-layout>
