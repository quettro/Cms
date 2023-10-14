<x-app-layout>
    @section('title', __('История пользователей'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'История пользователей',
                'href' => route('user-history.index')
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
                        <h6 class="card-title mb-0">История пользователей</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-back
                                class="nav-link" :action="route('user-history.index')"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('user-history.store')">
                        <div class="row">
                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="message">Сообщение *</x-label>
                                    <x-textarea id="message" name="message" :value="old('message')" :invalid="$errors->has('message')"></x-textarea>
                                    <x-invalid-feedback :messages="$errors->get('message')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="user_id">Пользователь *</x-label>
                                    <x-select id="user_id" name="user_id" :option="\App\Models\User::get()->dropdown()" :o_selected="[old('user_id')]" :invalid="$errors->has('user_id')"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('user_id')"></x-invalid-feedback>
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
