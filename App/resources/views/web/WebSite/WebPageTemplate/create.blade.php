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
                                class="nav-link" :action="route('web-sites.web-page-templates.index', $webSite->id)"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('web-sites.web-page-templates.store', $webSite->id)">
                        <div class="row">
                        	<div class="col-12">
                        		<x-form-group>
                                    <x-label for="webpagetemplate.name">Наименование *</x-label>
                                    <x-input id="webpagetemplate.name" name="webpagetemplate[name]" :invalid="$errors->has('webpagetemplate.name')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('webpagetemplate.name')"></x-invalid-feedback>
                                </x-form-group>
                        	</div>

                        	<div class="col-12">
                        		<x-form-group>
                                    <x-label for="webpagetemplatelanguageversion.blade">Blade</x-label>
                                    <x-codemirror id="webpagetemplatelanguageversion.blade" name="webpagetemplatelanguageversion[blade]" :value="old('webpagetemplatelanguageversion.blade')" :invalid="$errors->has('webpagetemplatelanguageversion.blade')"></x-codemirror>
                                    <x-invalid-feedback :messages="$errors->get('webpagetemplatelanguageversion.blade')"></x-invalid-feedback>
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
