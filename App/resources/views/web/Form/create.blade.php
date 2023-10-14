<x-app-layout>
    @section('title', __('Формы'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Формы',
                'href' => route('forms.index')
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
                                class="nav-link" :action="route('forms.index')"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('forms.store')" data-iug="true">
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
                                                    <x-label for="form.key">Ключ *</x-label>
                                                    <x-input id="form.key" name="form[key]" :value="old('form.key')" :invalid="$errors->has('form.key')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('form.key')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="form.redirect">Куда перенаправить пользователя?</x-label>
                                                    <x-input id="form.redirect" name="form[redirect]"  :value="old('form.redirect')" :invalid="$errors->has('form.redirect')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('form.redirect')"></x-invalid-feedback>
                                                    <x-text-feedback>Если оставить данное поле пустым, то пользователя перенаправит на предыдущую страницу.</x-text-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="form.addresses">Адреса электронных почт</x-label>
                                                    <x-input id="form.addresses" name="form[addresses]"  :value="old('form.addresses')" :invalid="$errors->has('form.addresses')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('form.addresses')"></x-invalid-feedback>
                                                    <x-text-feedback>На какие адреса электронных почт рассылать полученные данные? Указывать через запятые.</x-text-feedback>
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
                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="formLanguage.blade">Blade</x-label>
                                                    <x-codemirror id="formLanguage.blade" name="formLanguage[blade]" :value="old('formLanguage.blade')" :invalid="$errors->has('formLanguage.blade')"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('formLanguage.blade')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="p-3 bg-light rounded">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <x-button class="btn-primary js--btn-submit-form-iug">
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
