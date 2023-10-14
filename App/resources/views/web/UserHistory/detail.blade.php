<x-app-layout>
    @section('title', __('История пользователей'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'История пользователей',
                'href' => route('user-history.index')
            ],
            [
                'name' => $userHistory->id,
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $userHistory->id }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:UserHistory:Update" :action="route('user-history.edit', $userHistory->id)" :disabled="$edit"
                            />

                            <x-link-to-delete
                                class="nav-link" permission="Cms:UserHistory:Delete" :action="route('user-history.destroy', $userHistory->id)"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('user-history.update', $userHistory->id)">
                        @method('PATCH')

                        <div class="row">
                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="message">Сообщение *</x-label>
                                    <x-textarea id="message" name="message" :value="old('message', $userHistory->message)" :invalid="$errors->has('message')" :disabled="!$edit"></x-textarea>
                                    <x-invalid-feedback :messages="$errors->get('message')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <x-form-group>
                                    <x-label for="user_id">Пользователь *</x-label>
                                    <x-select id="user_id" name="user_id" :option="\App\Models\User::get()->dropdown()" :o_selected="[old('user_id', $userHistory->user_id)]" :invalid="$errors->has('user_id')" :disabled="!$edit"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('user_id')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="updated_at">Дата и время последнего обновления</x-label>
                                    <x-input id="updated_at" name="updated_at" :value="old('updated_at', $userHistory->updated_at)" :invalid="$errors->has('updated_at')" :disabled="true"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('updated_at')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="created_at">Дата и время создания</x-label>
                                    <x-input id="created_at" name="created_at" :value="old('created_at', $userHistory->created_at)" :invalid="$errors->has('created_at')" :disabled="true"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('created_at')"></x-invalid-feedback>
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
