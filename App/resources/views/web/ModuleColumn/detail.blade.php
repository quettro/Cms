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
                'name' => $moduleColumn->key,
                'href' => ''
            ],
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $moduleColumn->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:Module:Update" :disabled="$edit" :action="route('modules.module-columns.edit', [
                                    'module' => $module->id,
                                    'moduleColumn' => $moduleColumn->id
                                ])"
                            />

                            <x-link-to-delete
                                class="nav-link" permission="Cms:Module:Delete" :action="route('modules.module-columns.destroy', [
                                    'module' => $module->id,
                                    'moduleColumn' => $moduleColumn->id
                                ])"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('modules.module-columns.update', ['module' => $module->id, 'moduleColumn' => $moduleColumn->id ])">
                        @method('PATCH')

                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="key">Ключ *</x-label>
                                    <x-input id="key" name="key" :value="old('key', $moduleColumn->key)" :invalid="$errors->has('key')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('key')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="name">Наименование *</x-label>
                                    <x-input id="name" name="name" :value="old('name', $moduleColumn->name)" :invalid="$errors->has('name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="type">Тип *</x-label>
                                    <x-select id="type" name="type" :option="\App\Enums\ModuleColumnType::asSelectArray()" :o_selected="[old('type', $moduleColumn->type->value)]" :invalid="$errors->has('type')" :disabled="!$edit"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('type')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <div class="mb-1">
                                    <x-checkbox id="table" name="table" :invalid="$errors->has('table')" :checked="$moduleColumn->table" :disabled="!$edit">Показывать колонку в таблице?</x-checkbox>
                                    <x-invalid-feedback :messages="$errors->get('table')"></x-invalid-feedback>
                                </div>

                                <div class="mb-4">
                                    <x-checkbox id="required" name="required" :invalid="$errors->has('required')" :checked="$moduleColumn->required" :disabled="!$edit">Обязательно для заполнения</x-checkbox>
                                    <x-invalid-feedback :messages="$errors->get('required')"></x-invalid-feedback>
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
