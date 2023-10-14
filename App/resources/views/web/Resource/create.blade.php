<x-app-layout>
    @section('title', __('Ресурсы'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Ресурсы',
                'href' => route('resources.index')
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

                        <div class="nav justify-content-end">
                            <x-link-to-back
                                class="nav-link" :action="route('resources.index')"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('resources.store')" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="position">Где подключать *</x-label>
                                    <x-select id="position" name="position" :option="\App\Enums\ResourcePosition::asSelectArray()" :o_selected="[old('position')]" :invalid="$errors->has('position')"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('position')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="file">Файл(ы) *</x-label>
                                    <x-input-file id="file" name="file[]" accept=".css, .js" multiple="" :invalid="$errors->has('file') || $errors->has('file.*')"></x-input-file>
                                    <x-invalid-feedback :messages="$errors->get('file')"></x-invalid-feedback>
                                    <x-invalid-feedback :messages="$errors->get('file.*')"></x-invalid-feedback>
                                    <x-text-feedback>Выберите файл(ы) с расширениями .css или .js</x-text-feedback>
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
