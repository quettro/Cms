@section('title', __('Блоки'))

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
                'name' => 'Блоки',
                'href' => route('web-sites.web-blocks.index', $webSite->id)
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
                                class="nav-link" :action="route('web-sites.web-blocks.index', $webSite->id)"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('web-sites.web-blocks.store', $webSite->id)">
                        <div class="row">
                        	<div class="col-lg-6">
                        		<x-form-group>
                                    <x-label for="webblock.name">Наименование *</x-label>
                                    <x-input id="webblock.name" name="webblock[name]" :invalid="$errors->has('webblock.name')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('webblock.name')"></x-invalid-feedback>
                                </x-form-group>
                        	</div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="webblock.key">Ключ *</x-label>
                                    <x-input id="webblock.key" name="webblock[key]" :invalid="$errors->has('webblock.key')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('webblock.key')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                        	<div class="col-12">
                        		<x-form-group>
                                    <x-label for="webblocklanguageversion.blade">Blade</x-label>
                                    <x-codemirror id="webblocklanguageversion.blade" name="webblocklanguageversion[blade]" :value="old('webblocklanguageversion.blade')" :invalid="$errors->has('webblocklanguageversion.blade')"></x-codemirror>
                                    <x-invalid-feedback :messages="$errors->get('webblocklanguageversion.blade')"></x-invalid-feedback>
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
