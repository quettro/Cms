@section('title', __('Шаблоны страниц'))

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
                'name' => 'Шаблоны страниц',
                'href' => route('web-sites.web-page-templates.index', $webSite->id)
            ],
            [
                'name' => $webPageTemplate->name,
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
                            @foreach($webPageTemplate->languages as $item)
                                <a @class(['small text-decoration-none', 'text-muted' => $webPageTemplateLanguage->id !== $item->id]) href="?language={{ $item->id }}">
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
                        <h6 class="card-title mb-0">{{ $webPageTemplate->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:WebPageTemplate:Update" :disabled="$edit" :action="route('web-sites.web-page-templates.edit', [
                                    'webSite' => $webSite->id,
                                    'webPageTemplate' => $webPageTemplate->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webPageTemplateLanguage->id }}">
                            </x-link-to-update>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:WebPageTemplate:Delete" :action="route('web-sites.web-page-templates.destroy', [
                                    'webSite' => $webSite->id,
                                    'webPageTemplate' => $webPageTemplate->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webPageTemplateLanguage->id }}">
                            </x-link-to-delete>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('web-sites.web-page-templates.update', [
                            'webSite' => $webSite->id,
                            'webPageTemplate' => $webPageTemplate->id
                        ])"
                    >
                        @method('PATCH')

                        <div class="row">
                            <input type="hidden" name="web_page_template_language_id" value="{{ $webPageTemplateLanguage->id }}">

                        	<div class="col-12">
                        		<x-form-group>
                                    <x-label for="webpagetemplate.name">Наименование *</x-label>
                                    <x-input id="webpagetemplate.name" name="webpagetemplate[name]" :value="old('webpagetemplate.name', $webPageTemplate->name)" :invalid="$errors->has('webpagetemplate.name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('webpagetemplate.name')"></x-invalid-feedback>
                                </x-form-group>
                        	</div>

                        	<div class="col-12">
                                <x-form-group>
                                    <x-label for="webpagetemplatelanguageversion.blade">Blade</x-label>
                                    <x-codemirror id="webpagetemplatelanguageversion.blade" name="webpagetemplatelanguageversion[blade]" :value="old('webpagetemplatelanguageversion.blade', $webPageTemplateLanguage->version->blade)" :invalid="$errors->has('webpagetemplatelanguageversion.blade')" :disabled="!$edit"></x-codemirror>
                                    <x-invalid-feedback :messages="$errors->get('webpagetemplatelanguageversion.blade')"></x-invalid-feedback>
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
