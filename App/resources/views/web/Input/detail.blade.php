<x-app-layout>
    @section('title', __('Поля форм'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Поля форм',
                'href' => route('inputs.index')
            ],
            [
                'name' => $input->name,
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
                            @foreach($input->languages as $item)
                                <a @class(['small text-decoration-none', 'text-muted' => $inputLanguage->id !== $item->id]) href="?language={{ $item->id }}">
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
                        <h6 class="card-title mb-0">{{ $input->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:Input:Update" :action="route('inputs.edit', $input->id)" :disabled="$edit"
                            >
                                <input type="hidden" name="language" value="{{ $inputLanguage->id }}">
                            </x-link-to-update>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:Input:Delete" :action="route('inputs.destroy', $input->id)"
                            >
                                <input type="hidden" name="language" value="{{ $inputLanguage->id }}">
                            </x-link-to-delete>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('inputs.update', $input->id)">
                        @method('PATCH')

                        <input type="hidden" name="input_language_id" value="{{ $inputLanguage->id }}">

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
                                                    <x-label for="input.key">Ключ *</x-label>
                                                    <x-input id="input.key" name="input[key]" :value="old('input.key', $input->key)" :invalid="$errors->has('input.key')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('input.key')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="input.name">Наименование *</x-label>
                                                    <x-input id="input.name" name="input[name]" :value="old('input.name', $input->name)" :invalid="$errors->has('input.name')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('input.name')"></x-invalid-feedback>
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
                                            <h6 class="card-title mb-0">Валидация</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-1">
                                                    <x-label for="input.v_regex">Проверяемое поле должно соответствовать переданному регулярному выражению</x-label>
                                                    <x-input id="input.v_regex" name="input[v_regex]" :value="old('input.v_regex', $input->v_regex)" :invalid="$errors->has('input.v_regex')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_regex')"></x-invalid-feedback>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-1">
                                                    <x-label for="input.v_not_regex">Проверяемое поле не должно соответствовать переданному регулярному выражению</x-label>
                                                    <x-input id="input.v_not_regex" name="input[v_not_regex]" :value="old('input.v_not_regex', $input->v_not_regex)" :invalid="$errors->has('input.v_not_regex')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_not_regex')"></x-invalid-feedback>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_required" name="input[v_required]" :checked="$input->v_required" :invalid="$errors->has('input.v_required')" :disabled="!$edit">Проверяемое поле должно присутствовать во входных данных и не быть пустым</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_required')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_alpha" name="input[v_alpha]" :checked="$input->v_alpha" :invalid="$errors->has('input.v_alpha')" :disabled="!$edit">Проверяемое поле должно состоять полностью из букв</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_alpha')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_alpha_dash" name="input[v_alpha_dash]" :checked="$input->v_alpha_dash" :invalid="$errors->has('input.v_alpha_dash')" :disabled="!$edit">Проверяемое поле может содержать буквенно-цифровые символы, а также дефисы и подчеркивания</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_alpha_dash')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_alpha_num" name="input[v_alpha_num]" :checked="$input->v_alpha_num" :invalid="$errors->has('input.v_alpha_num')" :disabled="!$edit">Проверяемое поле должно состоять полностью из буквенно-цифровых символов</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_alpha_num')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_string" name="input[v_string]" :checked="$input->v_string" :invalid="$errors->has('input.v_string')" :disabled="!$edit">Проверяемое поле должно быть строкой</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_string')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_numeric" name="input[v_numeric]" :checked="$input->v_numeric" :invalid="$errors->has('input.v_numeric')" :disabled="!$edit">Проверяемое поле должно быть числовым</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_numeric')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_email" name="input[v_email]" :checked="$input->v_email" :invalid="$errors->has('input.v_email')" :disabled="!$edit">Проверяемое поле должно быть отформатировано как адрес электронной почты</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_email')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_boolean" name="input[v_boolean]" :checked="$input->v_boolean" :invalid="$errors->has('input.v_boolean')" :disabled="!$edit">Проверяемое поле должно иметь возможность преобразования в логическое значение. Допустимые значения: true, false, 1, 0, '1', и '0'.</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_boolean')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_accepted" name="input[v_accepted]" :checked="$input->v_accepted" :invalid="$errors->has('input.v_accepted')" :disabled="!$edit">Проверяемое поле должно иметь значение 'yes', 'on', 1, или true. Применяется для валидации принятия «Условий использования» или аналогичных полей.</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_accepted')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_ip" name="input[v_ip]" :checked="$input->v_ip" :invalid="$errors->has('input.v_ip')" :disabled="!$edit">Проверяемое поле должно быть IP-адресом</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_ip')"></x-invalid-feedback>
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
                                            <h6 class="card-title mb-0">Мультиязычность - {{ $inputLanguage->language->name }}</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="inputLanguage.blade">Blade ( По желанию )</x-label>
                                                    <x-codemirror id="inputLanguage.blade" name="inputLanguage[blade]" :value="old('inputLanguage.blade', $inputLanguage->blade)" :invalid="$errors->has('inputLanguage.blade')" :disabled="!$edit"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('inputLanguage.blade')"></x-invalid-feedback>
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
