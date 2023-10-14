<x-app-layout>
    @section('title', __('Колонки модулей'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Модули',
                'href' => route('modules.index')
            ],
            [
                'name' => $module->name,
                'href' => route('modules.show', $module->id)
            ],
            [
                'name' => 'Колонки',
                'href' => route('modules.module-columns.index', $module->id)
            ],
            [
                'name' => 'Новая запись',
                'href' => ''
            ],
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
                                class="nav-link" :action="route('modules.module-columns.index', $module->id)"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('modules.module-columns.store', $module->id)">
                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="key">Ключ *</x-label>
                                    <x-input id="key" name="key" :value="old('key')" :invalid="$errors->has('key')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('key')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="name">Наименование *</x-label>
                                    <x-input id="name" name="name" :value="old('name')" :invalid="$errors->has('name')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="type">Тип *</x-label>
                                    <x-select id="type" name="type" :option="\App\Enums\ModuleColumnType::asSelectArray()" :o_selected="[old('type')]" :invalid="$errors->has('type')"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('type')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <div class="mb-1">
                                    <x-checkbox id="table" name="table" :invalid="$errors->has('table')">Показывать колонку в таблице?</x-checkbox>
                                    <x-invalid-feedback :messages="$errors->get('table')"></x-invalid-feedback>
                                </div>

                                <div class="mb-4">
                                    <x-checkbox id="required" name="required" :invalid="$errors->has('required')">Обязательно для заполнения</x-checkbox>
                                    <x-invalid-feedback :messages="$errors->get('required')"></x-invalid-feedback>
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
