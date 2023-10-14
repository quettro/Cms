<x-app-layout>
    @section('title', __('Языки'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Языки',
                'href' => route('languages.index')
            ],
            [
                'name' => $language->name,
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $language->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:Language:Update" :action="route('languages.edit', $language->id)" :disabled="$edit"
                            />

                            <x-link-to-delete
                                class="nav-link" permission="Cms:Language:Delete" :action="route('languages.destroy', $language->id)"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('languages.update', $language->id)">
                        @method('PATCH')

                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="name">Наименование *</x-label>
                                    <x-input id="name" name="name" :value="old('name', $language->name)" :invalid="$errors->has('name')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="codename">Кодовое название *</x-label>
                                    <x-input id="codename" name="codename" :value="old('codename', $language->codename)" :invalid="$errors->has('codename')" :disabled="!$edit"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('codename')"></x-invalid-feedback>
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
