<x-app-layout>
    @section('title', __('Шаблоны модулей'))

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
                'name' => 'Шаблоны',
                'href' => route('modules.module-templates.index', $module->id)
            ],
            [
                'name' => $moduleTemplate->name,
                'href' => ''
            ],
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $moduleTemplate->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:Module:Update" :disabled="$edit" :action="route('modules.module-templates.edit', [
                                    'module' => $module->id,
                                    'moduleTemplate' => $moduleTemplate->id
                                ])"
                            />

                            <x-link-to-delete
                                class="nav-link" permission="Cms:Module:Delete" :action="route('modules.module-templates.destroy', [
                                    'module' => $module->id,
                                    'moduleTemplate' => $moduleTemplate->id
                                ])"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('modules.module-templates.update', [
                            'module' => $module->id,
                            'moduleTemplate' => $moduleTemplate->id
                        ])"
                    >
                        @method('PATCH')

                        <div class="row">
                            <div class="col-lg-4">
                                <x-form-group>
                                    <x-label for="name">Наименование *</x-label>
                                    <x-input id="name" name="name" :value="old('name', $moduleTemplate->name)" :invalid="$errors->has('name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-4">
                                <x-form-group>
                                    <x-label for="key">Ключ *</x-label>
                                    <x-input id="key" name="key" :value="old('key', $moduleTemplate->key)" :invalid="$errors->has('key')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('key')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-4">
                                <x-form-group>
                                    <x-label for="count">Сколько записей отображать? *</x-label>
                                    <x-input id="count" type="number" name="count" :value="old('count', $moduleTemplate->count)" :invalid="$errors->has('count')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('count')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="order_by_column">Сортировать по колонке</x-label>
                                    <x-select id="order_by_column" name="order_by_column" :option="$module->moduleColumns()->get()->dropdown()" :o_selected="[old('order_by_column', $moduleTemplate->order_by_column)]" :invalid="$errors->has('order_by_column')" :disabled="!$edit"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('order_by_column')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="order_by">Тип сортировки</x-label>
                                    <x-select id="order_by" name="order_by" :option="\App\Enums\ModuleTemplateOrderBy::asSelectArray()" :o_selected="[old('order_by', $moduleTemplate->order_by?->value)]" :invalid="$errors->has('order_by')" :disabled="!$edit"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('order_by')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="blade">Blade</x-label>
                                    <x-codemirror id="blade" name="blade" :value="old('blade', $moduleTemplate->blade)" :invalid="$errors->has('blade')" :disabled="!$edit"></x-codemirror>
                                    <x-invalid-feedback :messages="$errors->get('blade')"></x-invalid-feedback>
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
