<x-app-layout>
    @section('title', __('Модули'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Модули',
                'href' => route('modules.index')
            ],
            [
                'name' => $module->name,
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $module->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:Module:Update" :action="route('modules.edit', $module->id)" :disabled="$edit"
                            ></x-link-to-update>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:Module:Delete" :action="route('modules.destroy', $module->id)"
                            ></x-link-to-delete>

                            <x-link-to
                                class="nav-link" permission="Cms:Module:Index" :action="route('modules.module-columns.index', $module->id)"
                            >Колонки</x-link-to>

                            <x-link-to
                                class="nav-link" permission="Cms:Module:Index" :action="route('modules.module-templates.index', $module->id)"
                            >Шаблоны</x-link-to>

                            <x-link-to
                                class="nav-link" permission="Cms:Module:Index" :action="route('modules.module-database.index', $module->id)"
                            >База данных</x-link-to>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('modules.update', $module->id)">
                        @method('PATCH')

                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="name">Название модуля *</x-label>
                                    <x-input id="name" name="name" :value="old('name', $module->name)" :invalid="$errors->has('name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="key">Ключ *</x-label>
                                    <x-input id="key" name="key" :value="old('key', $module->key)" :invalid="$errors->has('key')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('key')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="dateformat">Формат даты *</x-label>
                                    <x-input id="dateformat" name="dateformat" :value="old('dateformat', $module->dateformat)" :invalid="$errors->has('dateformat')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('dateformat')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="timeformat">Формат времени *</x-label>
                                    <x-input id="timeformat" name="timeformat" :value="old('timeformat', $module->timeformat)" :invalid="$errors->has('timeformat')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('timeformat')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="type">Тип *</x-label>
                                    <x-select id="type" name="type" :option="\App\Enums\ModuleType::asSelectArray()" :o_selected="[old('type', $module->type->value)]" :invalid="$errors->has('type')" :disabled="!$edit"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('type')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6 d-none">
                                <x-form-group>
                                    <x-label for="route">Маршрут до родительской страницы *</x-label>
                                    <x-input id="route" name="route" :value="old('route', $module->route)" :invalid="$errors->has('route')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('route')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6 d-none">
                                <x-form-group>
                                    <x-label for="child_route">Маршрут дочерней страницы *</x-label>
                                    <x-input id="child_route" name="child_route" :value="old('child_route', $module->child_route)" :invalid="$errors->has('child_route')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('child_route')"></x-invalid-feedback>
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
