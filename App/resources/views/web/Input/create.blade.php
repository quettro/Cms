<x-app-layout>
    @section('title', __('Поля форм'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Поля форм',
                'href' => route('inputs.index')
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
                                class="nav-link" :action="route('inputs.index')"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('inputs.store')">
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
                                                    <x-input id="input.key" name="input[key]" :value="old('input.key')" :invalid="$errors->has('input.key')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('input.key')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>

                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="input.name">Наименование *</x-label>
                                                    <x-input id="input.name" name="input[name]" :value="old('input.name')" :invalid="$errors->has('input.name')"></x-input>
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
                                                    <x-input id="input.v_regex" name="input[v_regex]" :value="old('input.v_regex')" :invalid="$errors->has('input.v_regex')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_regex')"></x-invalid-feedback>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-1">
                                                    <x-label for="input.v_not_regex">Проверяемое поле не должно соответствовать переданному регулярному выражению</x-label>
                                                    <x-input id="input.v_not_regex" name="input[v_not_regex]" :value="old('input.v_not_regex')" :invalid="$errors->has('input.v_not_regex')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_not_regex')"></x-invalid-feedback>
                                                </div>
                                            </div>

                                            <div class="col-12 mt-3">
                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_required" name="input[v_required]" :invalid="$errors->has('input.v_required')">Проверяемое поле должно присутствовать во входных данных и не быть пустым</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_required')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_alpha" name="input[v_alpha]" :invalid="$errors->has('input.v_alpha')">Проверяемое поле должно состоять полностью из букв</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_alpha')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_alpha_dash" name="input[v_alpha_dash]" :invalid="$errors->has('input.v_alpha_dash')">Проверяемое поле может содержать буквенно-цифровые символы, а также дефисы и подчеркивания</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_alpha_dash')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_alpha_num" name="input[v_alpha_num]" :invalid="$errors->has('input.v_alpha_num')">Проверяемое поле должно состоять полностью из буквенно-цифровых символов</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_alpha_num')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_string" name="input[v_string]" :invalid="$errors->has('input.v_string')">Проверяемое поле должно быть строкой</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_string')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_numeric" name="input[v_numeric]" :invalid="$errors->has('input.v_numeric')">Проверяемое поле должно быть числовым</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_numeric')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_email" name="input[v_email]" :invalid="$errors->has('input.v_email')">Проверяемое поле должно быть отформатировано как адрес электронной почты</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_email')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_boolean" name="input[v_boolean]" :invalid="$errors->has('input.v_boolean')">Проверяемое поле должно иметь возможность преобразования в логическое значение. Допустимые значения: true, false, 1, 0, '1', и '0'.</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_boolean')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_accepted" name="input[v_accepted]" :invalid="$errors->has('input.v_accepted')">Проверяемое поле должно иметь значение 'yes', 'on', 1, или true. Применяется для валидации принятия «Условий использования» или аналогичных полей.</x-checkbox>
                                                    <x-invalid-feedback :messages="$errors->get('input.v_accepted')"></x-invalid-feedback>
                                                </div>

                                                <div class="mb-1">
                                                    <x-checkbox id="input.v_ip" name="input[v_ip]" :invalid="$errors->has('input.v_ip')">Проверяемое поле должно быть IP-адресом</x-checkbox>
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
                                            <h6 class="card-title mb-0">Мультиязычность</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="inputLanguage.blade">Blade ( По желанию )</x-label>
                                                    <x-codemirror id="inputLanguage.blade" name="inputLanguage[blade]" :value="old('inputLanguage.blade')" :invalid="$errors->has('inputLanguage.blade')"></x-codemirror>
                                                    <x-invalid-feedback :messages="$errors->get('inputLanguage.blade')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
