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
                'name' => $webPage->name,
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
                            @foreach($webPage->languages as $item)
                                <a @class(['small text-decoration-none', 'text-muted' => $webPageLanguage->id !== $item->id]) href="?language={{ $item->id }}">
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
                        <h6 class="card-title mb-0">{{ $webPage->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:WebPage:Update" :disabled="$edit" :action="route('web-sites.web-pages.edit', [
                                    'webSite' => $webSite->id,
                                    'webPage' => $webPage->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webPageLanguage->id }}">
                            </x-link-to-update>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:WebPage:Delete" :action="route('web-sites.web-pages.destroy', [
                                    'webSite' => $webSite->id,
                                    'webPage' => $webPage->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webPageLanguage->id }}">
                            </x-link-to-delete>

                            <x-link-to
                                class="nav-link" permission="Cms:WebPage:Copy" :disabled="true" :action="route('web-sites.web-pages.copy.index', [
                                    'webSite' => $webSite->id,
                                    'webPage' => $webPage->id,
                                    'language' => $webPageLanguage->id,
                                ])"
                            >
                                Копировать страницу</x-link-to>

                            <x-link-to
                                class="nav-link" permission="Cms:WebPage:Index" :action="route('web-sites.web-pages.versions.index', [
                                    'webSite' => $webSite->id,
                                    'webPage' => $webPage->id,
                                    'language' => $webPageLanguage->id,
                                ])"
                            >
                                История изменений</x-link-to>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('web-sites.web-pages.update', [
                            'webSite' => $webSite->id,
                            'webPage' => $webPage->id
                        ])"

                        enctype="multipart/form-data"
                    >
                        @method('PATCH')

                        <div class="row gap-3">
                            <input type="hidden" name="web_page_language_id" value="{{ $webPageLanguage->id }}">

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
                                                    <x-input id="webpage.name" name="webpage[name]" :value="old('webpage.name', $webPage->name)" :invalid="$errors->has('webpage.name')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpage.name')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpage.route">URL *</x-label>
                                                    <x-input id="webpage.route" name="webpage[route]" :value="old('webpage.route', $webPage->route)" :invalid="$errors->has('webpage.route')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpage.route')"></x-invalid-feedback>
                                                    <x-text-feedback>Текущая полная ссылка до страницы: <span class="text-dark">{{ $webPage->a_route }}</span></x-text-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpage.parent_id">Родительская страница</x-label>
                                                    <x-select id="webpage.parent_id" name="webpage[parent_id]" :option="$webPages->dropdown()" :o_selected="[old('webpage.parent_id', $webPage->parent_id)]" :invalid="$errors->has('webpage.parent_id')" :disabled="!$edit"></x-select>
                                                    <x-invalid-feedback :messages="$errors->get('webpage.parent_id')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.web_page_template_id">Шаблон страницы</x-label>
                                                    <x-select id="webpagelanguage.web_page_template_id" name="webpagelanguage[web_page_template_id]" :option="$webSite->webPageTemplates()->get()->dropdown()" :o_selected="[old('webpagelanguage.web_page_template_id', $webPageLanguage->web_page_template_id)]" :invalid="$errors->has('webpagelanguage.web_page_template_id')" :disabled="!$edit"></x-select>
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
                                            <h6 class="card-title mb-0">Мультиязычность - {{ $webPageLanguage->language->name }}</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.title">[ Seo ] Заголовок</x-label>
                                                    <x-input id="webpagelanguage.title" name="webpagelanguage[title]" :value="old('webpagelanguage.title', $webPageLanguage->title)" :invalid="$errors->has('webpagelanguage.title')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.title')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.description">[ Seo ] Описание</x-label>
                                                    <x-input id="webpagelanguage.description" name="webpagelanguage[description]" :value="old('webpagelanguage.description', $webPageLanguage->description)" :invalid="$errors->has('webpagelanguage.description')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.description')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.keywords">[ Seo ] Ключевые слова</x-label>
                                                    <x-input id="webpagelanguage.keywords" name="webpagelanguage[keywords]" :value="old('webpagelanguage.keywords', $webPageLanguage->keywords)" :invalid="$errors->has('webpagelanguage.keywords')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.keywords')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.og_title">[ Open Graph ] Заголовок</x-label>
                                                    <x-input id="webpagelanguage.og_title" name="webpagelanguage[og_title]" :value="old('webpagelanguage.og_title', $webPageLanguage->og_title)" :invalid="$errors->has('webpagelanguage.og_title')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.og_title')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.og_description">[ Open Graph ] Описание</x-label>
                                                    <x-input id="webpagelanguage.og_description" name="webpagelanguage[og_description]" :value="old('webpagelanguage.og_description', $webPageLanguage->og_description)" :invalid="$errors->has('webpagelanguage.og_description')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.og_description')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.og_image">[ Open Graph ] Изображение</x-label>
                                                    <x-input-file id="webpagelanguage.og_image" name="webpagelanguage[og_image]" accept=".jpg, .jpeg, .png" :invalid="$errors->has('webpagelanguage.og_image')" :disabled="!$edit"></x-input-file>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.og_image')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.name_of_the_crumb">[ Хлебные крошки ] Наименование</x-label>
                                                    <x-input id="webpagelanguage.name_of_the_crumb" name="webpagelanguage[name_of_the_crumb]" :value="old('webpagelanguage.name_of_the_crumb', $webPageLanguage->name_of_the_crumb)" :invalid="$errors->has('webpagelanguage.name_of_the_crumb')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.name_of_the_crumb')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="webpagelanguage.redirect">[ Дополнительно ] Редирект</x-label>
                                                    <x-input id="webpagelanguage.redirect" name="webpagelanguage[redirect]" :value="old('webpagelanguage.redirect', $webPageLanguage->redirect)" :invalid="$errors->has('webpagelanguage.redirect')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.redirect')"></x-invalid-feedback>
                                                    <x-text-feedback>Куда перенаправить пользователя, если он откроет данную страницу?</x-text-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <x-checkbox id="webpagelanguage.is_home" name="webpagelanguage[is_home]" :invalid="$errors->has('webpagelanguage.is_home')" :checked="$webPageLanguage->is_home" :disabled="!$edit">Назначить как главную страницу?</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguage.is_home')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-0">
                                                    <x-checkbox id="webpagelanguage.is_enabled" name="webpagelanguage[is_enabled]" :invalid="$errors->has('webpagelanguage.is_enabled')" :checked="$webPageLanguage->is_enabled" :disabled="!$edit">Включить страницу</x-checkbox>
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
                                                            <x-codemirror id="webpagelanguageversion.additional_head" name="webpagelanguageversion[additional_head]" :value="old('webpagelanguageversion.additional_head', $webPageLanguage->version->additional_head)" :invalid="$errors->has('webpagelanguageversion.additional_head')" :disabled="!$edit"></x-codemirror>
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
                                                            <x-codemirror id="webpagelanguageversion.additional_body" name="webpagelanguageversion[additional_body]" :value="old('webpagelanguageversion.additional_body', $webPageLanguage->version->additional_body)" :invalid="$errors->has('webpagelanguageversion.additional_body')" :disabled="!$edit"></x-codemirror>
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
                                                    <x-codemirror id="webpagelanguageversion.blade" name="webpagelanguageversion[blade]" :value="old('webpagelanguageversion.blade', $webPageLanguage->version->blade)" :invalid="$errors->has('webpagelanguageversion.blade')" :disabled="!$edit"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('webpagelanguageversion.blade')"></x-invalid-feedback>
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
                                            <x-button class="btn-primary js--btn-submit-form-iug">
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
