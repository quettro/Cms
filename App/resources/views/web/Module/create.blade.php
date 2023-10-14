<x-app-layout>
    @section('title', __('Модули'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Модули',
                'href' => route('modules.index')
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
                                class="nav-link" :action="route('modules.index')"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('modules.store')">
                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="name">Название модуля *</x-label>
                                    <x-input id="name" name="name" :value="old('name')" :invalid="$errors->has('name')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="key">Ключ *</x-label>
                                    <x-input id="key" name="key" :value="old('key')" :invalid="$errors->has('key')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('key')"></x-invalid-feedback>
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
                                    <x-label for="type">Тип *</x-label>
                                    <x-select id="type" name="type" :option="\App\Enums\ModuleType::asSelectArray()" :o_selected="[old('type')]" :invalid="$errors->has('type')"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('type')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6 d-none">
                                <x-form-group>
                                    <x-label for="route">Маршрут до родительской страницы *</x-label>
                                    <x-input id="route" name="route" :value="old('route')" :invalid="$errors->has('route')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('route')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6 d-none">
                                <x-form-group>
                                    <x-label for="child_route">Маршрут дочерней страницы *</x-label>
                                    <x-input id="child_route" name="child_route" :value="old('child_route')" :invalid="$errors->has('child_route')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('child_route')"></x-invalid-feedback>
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

    @push('up')
        <script type="module">
            window.$('[id="type"]').change(
                function (event) {
                    if (event.target.value !== 'INDIVIDUAL') {
                        window.$('[id="route"]').parent().parent().addClass('d-none');
                        window.$('[id="child_route"]').parent().parent().addClass('d-none');
                    }
                    else {
                        window.$('[id="route"]').parent().parent().removeClass('d-none');
                        window.$('[id="child_route"]').parent().parent().removeClass('d-none');
                    }
                }
            ).change();
        </script>
    @endpush
</x-app-layout>
