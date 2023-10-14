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
                'name' => $webBlock->name,
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
                            @foreach($webBlock->languages as $item)
                                <a @class(['small text-decoration-none', 'text-muted' => $webBlockLanguage->id !== $item->id]) href="?language={{ $item->id }}">
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
                        <h6 class="card-title mb-0">{{ $webBlock->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:WebBlock:Update" :disabled="$edit" :action="route('web-sites.web-blocks.edit', [
                                    'webSite' => $webSite->id,
                                    'webBlock' => $webBlock->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webBlockLanguage->id }}">
                            </x-link-to-update>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:WebBlock:Delete" :action="route('web-sites.web-blocks.destroy', [
                                    'webSite' => $webSite->id,
                                    'webBlock' => $webBlock->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webBlockLanguage->id }}">
                            </x-link-to-delete>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('web-sites.web-blocks.update', [
                            'webSite' => $webSite->id,
                            'webBlock' => $webBlock->id,
                        ])"
                    >
                        @method('PATCH')

                        <div class="row">
                            <input type="hidden" name="web_block_language_id" value="{{ $webBlockLanguage->id }}">

                        	<div class="col-lg-6">
                        		<x-form-group>
                                    <x-label for="webblock.name">Наименование *</x-label>
                                    <x-input id="webblock.name" name="webblock[name]" :value="old('webblock.name', $webBlock->name)" :invalid="$errors->has('webblock.name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('webblock.name')"></x-invalid-feedback>
                                </x-form-group>
                        	</div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="webblock.key">Ключ *</x-label>
                                    <x-input id="webblock.key" name="webblock[key]" :value="old('webblock.key', $webBlock->key)" :invalid="$errors->has('webblock.key')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('webblock.key')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                        	<div class="col-12">
                                <x-form-group>
                                    <x-label for="webblocklanguageversion.blade">Blade</x-label>
                                    <x-codemirror id="webblocklanguageversion.blade" name="webblocklanguageversion[blade]" :value="old('webblocklanguageversion.blade', $webBlockLanguage->version->blade)" :invalid="$errors->has('webblocklanguageversion.blade')" :disabled="!$edit"></x-codemirror>
                                    <x-invalid-feedback :messages="$errors->get('webblocklanguageversion.blade')"></x-invalid-feedback>
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
