@section('title', __('Копирование'))

<x-app-layout>
    @include('web.WebSite.sidebar')

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Сайты',
                'href' => route('web-sites.index')
            ],
            [
                'name' => $webSite->domain,
                'href' => route('web-sites.show', $webSite->id)
            ],
            [
                'name' => 'Копирование',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Копирование</h6>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('web-sites.copy.store', $webSite->id)">
                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="name">[ Новое ] Наименование *</x-label>
                                    <x-input id="name" name="name" :value="old('name', $webSite->name)" :invalid="$errors->has('name')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="description">[ Новое ] Краткое описание *</x-label>
                                    <x-input id="description" name="description" :value="old('description', $webSite->description)" :invalid="$errors->has('description')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('description')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="domain">[ Новый ] Домен *</x-label>
                                    <x-input id="domain" name="domain" :value="old('domain', $webSite->domain)" :invalid="$errors->has('domain')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('domain')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-checkbox id="enabled" name="enabled" :invalid="$errors->has('enabled')">Включить сайт</x-checkbox>
                                    <x-invalid-feedback :messages="$errors->get('enabled')"></x-invalid-feedback>
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
