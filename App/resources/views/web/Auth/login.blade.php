<x-guest-layout>
    <div class="py-4">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-3">
                    <div class="mx-4 px-4">
                        <div class="card">
                            <div class="card-body">
                                <x-form :action="route('login')">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <x-label for="email">Адрес электронной почты</x-label>
                                                <x-input id="email" type="email" name="email" :value="old('email')" :invalid="$errors->has('email')"></x-input>
                                                <x-invalid-feedback :messages="$errors->get('email')"></x-invalid-feedback>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-3">
                                                <x-label for="password">Пароль</x-label>
                                                <x-input id="password" type="password" name="password" :value="old('password')" :invalid="$errors->has('password')"></x-input>
                                                <x-invalid-feedback :messages="$errors->get('password')"></x-invalid-feedback>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-flex justify-content-end align-items-center pt-3">
                                                <x-button class="btn-outline-primary">
                                                    Продолжить
                                                </x-button>
                                            </div>
                                        </div>
                                    </div>
                                </x-form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
