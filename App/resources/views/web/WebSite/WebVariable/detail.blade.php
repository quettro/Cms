@section('title', __('Переменные'))

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
                'name' => 'Переменные',
                'href' => route('web-sites.web-variables.index', $webSite->id)
            ],
            [
                'name' => $webVariable->name,
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
                            @foreach($webVariable->languages as $item)
                                <a @class(['small text-decoration-none', 'text-muted' => $webVariableLanguage->id !== $item->id]) href="?language={{ $item->id }}">
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
                        <h6 class="card-title mb-0">{{ $webVariable->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:WebVariable:Update" :disabled="$edit" :action="route('web-sites.web-variables.edit', [
                                    'webSite' => $webSite->id,
                                    'webVariable' => $webVariable->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webVariableLanguage->id }}">
                            </x-link-to-update>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:WebVariable:Delete" :action="route('web-sites.web-variables.destroy', [
                                    'webSite' => $webSite->id,
                                    'webVariable' => $webVariable->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $webVariableLanguage->id }}">
                            </x-link-to-delete>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('web-sites.web-variables.update', [
                            'webSite' => $webSite->id,
                            'webVariable' => $webVariable->id
                        ])"
                    >
                        @method('PATCH')

                        <div class="row">
                            <input type="hidden" name="web_variable_language_id" value="{{ $webVariableLanguage->id }}">

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="name">Наименование *</x-label>
                                    <x-input id="name" name="name" :value="old('name', $webVariable->name)" :invalid="$errors->has('name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="key">Ключ *</x-label>
                                    <x-input id="key" name="key" :value="old('key', $webVariable->key)" :invalid="$errors->has('key')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('key')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="value">Значение *</x-label>
                                    <x-input id="value" name="value" :value="old('value', $webVariableLanguage->version->value)" :invalid="$errors->has('value')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('value')"></x-invalid-feedback>
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
