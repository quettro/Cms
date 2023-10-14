<x-app-layout>
    @section('title', __('Блоки'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Блоки',
                'href' => route('blocks.index')
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
                                class="nav-link" :action="route('blocks.index')"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('blocks.store')">
                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="block.name">Наименование *</x-label>
                                    <x-input id="block.name" name="block[name]" :value="old('block.name')" :invalid="$errors->has('block.name')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('block.name')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="block.key">Ключ *</x-label>
                                    <x-input id="block.key" name="block[key]" :value="old('block.key')" :invalid="$errors->has('block.key')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('block.key')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="blocklanguageversion.blade">Blade</x-label>
                                    <x-codemirror id="blocklanguageversion.blade" name="blocklanguageversion[blade]" :value="old('blocklanguageversion.blade')" :invalid="$errors->has('blocklanguageversion.blade')"></x-codemirror>
                                    <x-invalid-feedback :messages="$errors->get('blocklanguageversion.blade')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <div class="p-3 bg-light rounded">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <x-button class="btn-primary js--btn-submit-form-iug">
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
