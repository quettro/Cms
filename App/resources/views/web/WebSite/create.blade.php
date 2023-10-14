@section('title', __('Сайты'))

<x-app-layout>
    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Сайты',
                'href' => route('web-sites.index')
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
                                class="nav-link" :action="route('web-sites.index')"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('web-sites.store')">
                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="name">Наименование *</x-label>
                                    <x-input id="name" name="name" :value="old('name')" :invalid="$errors->has('name')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="description">Краткое описание *</x-label>
                                    <x-input id="description" name="description" :value="old('description')" :invalid="$errors->has('description')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('description')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="domain">Домен *</x-label>
                                    <x-input id="domain" name="domain" :value="old('domain')" :invalid="$errors->has('domain')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('domain')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="dateformat">Формат даты *</x-label>
                                    <x-input id="dateformat" name="dateformat" :value="old('dateformat', 'd.m.Y')" :invalid="$errors->has('dateformat')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('dateformat')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="timeformat">Формат времени *</x-label>
                                    <x-input id="timeformat" name="timeformat" :value="old('timeformat', 'H:i:s')" :invalid="$errors->has('timeformat')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('timeformat')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="charset">Кодировка *</x-label>
                                    <x-input id="charset" name="charset" :value="old('charset', 'utf-8')" :invalid="$errors->has('charset')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('charset')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="language_id">Приоритетный язык *</x-label>
                                    <x-select id="language_id" name="language_id" :option="\App\Models\Language::get()->dropdown()" :o_selected="[old('language_id')]" :invalid="$errors->has('language_id')"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('language_id')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-checkbox id="enabled" name="enabled" :invalid="$errors->has('enabled')">Включить сайт</x-checkbox>
                                    <x-invalid-feedback :messages="$errors->get('enabled')"></x-invalid-feedback>
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
