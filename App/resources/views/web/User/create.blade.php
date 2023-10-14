<x-app-layout>
    @section('title', __('Пользователи'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Пользователи',
                'href' => route('users.index')
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
                                class="nav-link" :action="route('users.index')"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('users.store')">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header py-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="card-title mb-0">Основная информация</h6>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="email">Электронная почта *</x-label>
                                                    <x-input id="email" type="email" name="email" :value="old('email')" :invalid="$errors->has('email')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('email')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="password">Пароль *</x-label>
                                                    <x-input id="password" type="password" name="password" :value="old('password')" :invalid="$errors->has('password')" autocomplete="new-password"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('password')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="name">Имя пользователя *</x-label>
                                                    <x-input id="name" name="name" :value="old('name')" :invalid="$errors->has('name')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="phone">Номер телефона</x-label>
                                                    <x-input id="phone" name="phone" :value="old('phone')" data-mask="70000000000" :invalid="$errors->has('phone')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('phone')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="description">Примечание</x-label>
                                                    <x-input id="description" name="description" :value="old('description')" :invalid="$errors->has('description')"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('description')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="card">
                                        <div class="card-header py-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="card-title mb-0">Доступы</h6>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="check-all-the-boxes">
                                                <div class="mb-2">
                                                    <x-checkbox id="check-all-the-boxes--0">Все</x-checkbox>
                                                </div>

                                                @foreach(\Spatie\Permission\Models\Permission::query()->get() as $permission)
                                                    <div class="mb-2">
                                                        <x-checkbox
                                                            :id="$permission->name" name="permissions[]" :value="$permission->name" :invalid="$errors->has('permissions.*')">{{ $permission->description }}</x-checkbox>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    @php $webSiteCollection = \App\Models\WebSite::query()->get(); @endphp

                                    <div class="card">
                                        <div class="card-header py-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="card-title mb-0">Доступные сайты</h6>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="check-all-the-boxes">
                                                <div class="mb-2">
                                                    <x-checkbox id="check-all-the-boxes--2">Все</x-checkbox>
                                                </div>

                                                @if($webSiteCollection->isEmpty())
                                                    <div class="text-danger">
                                                        Список на данный момент пуст.</div>
                                                @else
                                                    @foreach($webSiteCollection as $webSite)
                                                        <div class="mb-2">
                                                            <x-checkbox
                                                                :id="$webSite->domain" name="websites[]" :value="$webSite->id" :invalid="$errors->has('websites.*')">{{ $webSite->domain }}</x-checkbox>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
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
