<x-app-layout>
    @section('title', __('Формы'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Формы',
                'href' => route('forms.index')
            ],
            [
                'name' => $form->key,
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
                            @foreach($form->languages as $item)
                                <a @class(['small text-decoration-none', 'text-muted' => $formLanguage->id !== $item->id]) href="?language={{ $item->id }}">
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
                        <h6 class="card-title mb-0">{{ $form->key }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:Form:Update" :action="route('forms.edit', $form->id)" :disabled="$edit"
                            >
                                <input type="hidden" name="language" value="{{ $formLanguage->id }}">
                            </x-link-to-update>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:Form:Delete" :action="route('forms.destroy', $form->id)"
                            >
                                <input type="hidden" name="language" value="{{ $formLanguage->id }}">
                            </x-link-to-delete>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('forms.update', $form->id)" data-iug="true">
                        @method('PATCH')

                        <input type="hidden" name="form_language_id" value="{{ $formLanguage->id }}">

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
                                                    <x-input id="form.key" name="form[key]" :value="old('form.key', $form->key)" :invalid="$errors->has('form.key')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('form.key')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="form.redirect">Куда перенаправить пользователя?</x-label>
                                                    <x-input id="form.redirect" name="form[redirect]"  :value="old('form.redirect', $form->redirect)" :invalid="$errors->has('form.redirect')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('form.redirect')"></x-invalid-feedback>
                                                    <x-text-feedback>Если оставить данное поле пустым, то пользователя перенаправит на предыдущую страницу.</x-text-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="form.addresses">Адреса электронных почт</x-label>
                                                    <x-input id="form.addresses" name="form[addresses]"  :value="old('form.addresses', implode(', ', $form->addresses))" :invalid="$errors->has('form.addresses')" :disabled="!$edit"></x-input>
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
                                            <h6 class="card-title mb-0">Мультиязычность - {{ $formLanguage->language->name }}</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="formLanguage.blade">Blade</x-label>
                                                    <x-codemirror id="formLanguage.blade" name="formLanguage[blade]" :value="old('formLanguage.blade', $formLanguage->blade)" :invalid="$errors->has('formLanguage.blade')" :disabled="!$edit"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('formLanguage.blade')"></x-invalid-feedback>
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
