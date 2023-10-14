@section('title', __('Страницы'))

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
                                class="nav-link" :action="route('web-sites.web-pages.index', $webSite->id)"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('web-sites.web-pages.store', $webSite->id)" enctype="multipart/form-data">
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
                                                    <x-input id="webpage.name" name="webpage[name]" :value="old('webpage.name')" :invalid="$errors->has('webpage.name')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpage.name')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpage.route">URL *</x-label>
                                                    <x-input id="webpage.route" name="webpage[route]" :value="old('webpage.route')" :invalid="$errors->has('webpage.route')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpage.route')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpage.parent_id">Родительская страница</x-label>
                                                    <x-select id="webpage.parent_id" name="webpage[parent_id]" :option="$webSite->webPages()->get()->dropdown()" :o_selected="[old('webpage.parent_id', request()->get('parent_id'))]" :invalid="$errors->has('webpage.parent_id')"></x-select>
                                                    <x-invalid-feedback :messages="$errors->get('webpage.parent_id')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.web_page_template_id">Шаблон страницы</x-label>
                                                    <x-select id="webpagelanguage.web_page_template_id" name="webpagelanguage[web_page_template_id]" :option="$webSite->webPageTemplates()->get()->dropdown()" :o_selected="[old('webpagelanguage.web_page_template_id')]" :invalid="$errors->has('webpagelanguage.web_page_template_id')"></x-select>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.web_page_template_id')"></x-invalid-feedback>
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

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.name_of_the_crumb">[ Хлебные крошки ] Наименование</x-label>
                                                    <x-input id="webpagelanguage.name_of_the_crumb" name="webpagelanguage[name_of_the_crumb]" :value="old('webpagelanguage.name_of_the_crumb')" :invalid="$errors->has('webpagelanguage.name_of_the_crumb')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.name_of_the_crumb')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.redirect">[ Дополнительно ] Редирект</x-label>
                                                    <x-input id="webpagelanguage.redirect" name="webpagelanguage[redirect]" :value="old('webpagelanguage.redirect')" :invalid="$errors->has('webpagelanguage.redirect')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.redirect')"></x-invalid-feedback>
                                                    <x-text-feedback>Куда перенаправить пользователя, если он откроет данную страницу?</x-text-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <x-checkbox id="webpagelanguage.is_home" name="webpagelanguage[is_home]" :invalid="$errors->has('webpagelanguage.is_home')">Назначить как главную страницу?</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.is_home')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-0">
                                                    <x-checkbox id="webpagelanguage.is_enabled" name="webpagelanguage[is_enabled]" :invalid="$errors->has('webpagelanguage.is_enabled')" :checked="true">Включить страницу</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.is_enabled')"></x-invalid-feedback>
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
                                            <h6 class="card-title mb-0">Дополнительный код</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="accordion" id="accordion">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-Head" aria-expanded="false" aria-controls="accordion-Head">
                                                        Дополнительный код: < Head> < /Head>
                                                    </button>
                                                </h2>

                                                <div id="accordion-Head" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                                    <div class="accordion-body">
                                                        <x-form-group>
                                                            <x-label for="webpagelanguageversion.additional_head">< /Head> ( По желанию )</x-label>
                                                            <x-codemirror id="webpagelanguageversion.additional_head" name="webpagelanguageversion[additional_head]" :value="old('webpagelanguageversion.additional_head')" :invalid="$errors->has('webpagelanguageversion.additional_head')"></x-codemirror>
                                                            <x-invalid-feedback :messages="$errors->get('webpagelanguageversion.additional_head')"></x-invalid-feedback>
                                                        </x-form-group>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-Body" aria-expanded="false" aria-controls="accordion-Body">
                                                        Дополнительный код: < Body> < /Body>
                                                    </button>
                                                </h2>

                                                <div id="accordion-Body" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                                    <div class="accordion-body">
                                                        <x-form-group>
                                                            <x-label for="webpagelanguageversion.additional_body">< /Body> ( По желанию )</x-label>
                                                            <x-codemirror id="webpagelanguageversion.additional_body" name="webpagelanguageversion[additional_body]" :value="old('webpagelanguageversion.additional_body')" :invalid="$errors->has('webpagelanguageversion.additional_body')"></x-codemirror>
                                                            <x-invalid-feedback :messages="$errors->get('webpagelanguageversion.additional_body')"></x-invalid-feedback>
                                                        </x-form-group>
                                                    </div>
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
                                            <h6 class="card-title mb-0">Текстовый редактор</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="webpagelanguageversion.blade">Blade</x-label>
                                                    <x-codemirror id="webpagelanguageversion.blade" name="webpagelanguageversion[blade]" :value="old('webpagelanguageversion.blade')" :invalid="$errors->has('webpagelanguageversion.blade')"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguageversion.blade')"></x-invalid-feedback>
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
