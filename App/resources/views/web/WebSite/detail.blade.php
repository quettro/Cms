@section('title', __('Сайты'))

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
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        @if(session('website:error'))
            <div class="col-12">
                <div class="card card-outline card-danger">
                    <div class="card-body">
                        <div class="text-danger">
                            {{ session('website:error') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $webSite->domain }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:WebSite:Update" :action="route('web-sites.edit', $webSite->id)" :disabled="$edit"
                            />

                            <x-link-to-delete
                                class="nav-link" permission="Cms:WebSite:Delete" :action="route('web-sites.destroy', $webSite->id)"
                            />

                            <x-link-to
                                class="nav-link" permission="Cms:WebSite:Update" :action="route('web-sites.letsencrypt', $webSite->id)" :disabled="!$edit"
                            >
                                Letsencrypt</x-link-to>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('web-sites.update', $webSite->id)">
                        @method('PATCH')

                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="name">Наименование *</x-label>
                                    <x-input id="name" name="name" :value="old('name', $webSite->name)" :invalid="$errors->has('name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="description">Краткое описание *</x-label>
                                    <x-input id="description" name="description" :value="old('description', $webSite->description)" :invalid="$errors->has('description')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('description')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="domain">Домен</x-label>
                                    <x-input id="domain" name="domain" :value="old('domain', $webSite->domain)" :invalid="$errors->has('domain')" :disabled="true"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('domain')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="dateformat">Формат даты *</x-label>
                                    <x-input id="dateformat" name="dateformat" :value="old('dateformat', $webSite->dateformat)" :invalid="$errors->has('dateformat')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('dateformat')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="timeformat">Формат времени *</x-label>
                                    <x-input id="timeformat" name="timeformat" :value="old('timeformat', $webSite->timeformat)" :invalid="$errors->has('timeformat')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('timeformat')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="charset">Кодировка *</x-label>
                                    <x-input id="charset" name="charset" :value="old('charset', $webSite->charset)" :invalid="$errors->has('charset')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('charset')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-label for="language_id">Приоритетный язык *</x-label>
                                    <x-select id="language_id" name="language_id" :option="\App\Models\Language::get()->dropdown()" :o_selected="[old('language_id', $webSite->language_id)]" :invalid="$errors->has('language_id')" :disabled="!$edit"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('language_id')"></x-invalid-feedback>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="ssl_certificate">[ Другое ] ssl_certificate</x-label>
                                    <x-input id="ssl_certificate" name="ssl_certificate" :value="old('ssl_certificate', $webSite->ssl_certificate)" :invalid="$errors->has('ssl_certificate')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('ssl_certificate')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="ssl_certificate_key">[ Другое ] ssl_certificate_key</x-label>
                                    <x-input id="ssl_certificate_key" name="ssl_certificate_key" :value="old('ssl_certificate_key', $webSite->ssl_certificate_key)" :invalid="$errors->has('ssl_certificate_key')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('ssl_certificate_key')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <div class="my-3">
                                    <x-form-group>
                                        <x-checkbox id="enabled" name="enabled" :invalid="$errors->has('enabled')" :checked="$webSite->enabled" :disabled="!$edit">Включить сайт</x-checkbox>
                                        <x-invalid-feedback :messages="$errors->get('enabled')"></x-invalid-feedback>
                                    </x-form-group>
                                </div>
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
