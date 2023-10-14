<x-app-layout>
    @section('title', __('Пользователи'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Пользователи',
                'href' => route('users.index')
            ],
            [
                'name' => $user->name,
                'href' => ''
            ]
        ]"
    />

    <div class="row gap-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">{{ $user->name }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:User:Update" :action="route('users.edit', $user->id)" :disabled="$edit"
                            />

                            <x-link-to-delete
                                class="nav-link" permission="Cms:User:Delete" :action="route('users.destroy', $user->id)"
                            />
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('users.update', $user->id)">
                        @method('PATCH')

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
                                                    <x-input id="email" type="email" name="email" :value="old('email', $user->email)" :invalid="$errors->has('email')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('email')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="password">Новый пароль</x-label>
                                                    <x-input id="password" type="password" name="password" :value="old('password')" :invalid="$errors->has('password')" :disabled="!$edit" autocomplete="new-password"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('password')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="name">Имя пользователя *</x-label>
                                                    <x-input id="name" name="name" :value="old('name', $user->name)" :invalid="$errors->has('name')" :disabled="!$edit"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('name')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                            <div class="col-lg-6">
                                                <x-form-group>
                                                    <x-label for="phone">Номер телефона</x-label>
                                                    <x-input id="phone" name="phone" :value="old('phone', $user->phone->value)" :invalid="$errors->has('phone')" :disabled="!$edit"  data-mask="70000000000"></x-input>
                                                    <x-invalid-feedback :messages="$errors->get('phone')"></x-invalid-feedback>
                                                </x-form-group>
                                            </div>
                                            <div class="col-12">
                                                <x-form-group>
                                                    <x-label for="description">Примечание</x-label>
                                                    <x-input id="description" name="description" :value="old('description', $user->description)" :invalid="$errors->has('description')" :disabled="!$edit"></x-input>
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
                                                    <x-checkbox id="check-all-the-boxes--0" :disabled="!$edit">Все</x-checkbox>
                                                </div>

                                                @foreach(\Spatie\Permission\Models\Permission::query()->get() as $permission)
                                                    <div class="mb-2">
                                                        <x-checkbox
                                                            :id="$permission->name" name="permissions[]" :value="$permission->name" :invalid="$errors->has('permissions.*')" :checked="$user->can($permission->name)" :disabled="!$edit">{{ $permission->description }}</x-checkbox>
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
                                                    <x-checkbox id="check-all-the-boxes--2" :disabled="!$edit">Все</x-checkbox>
                                                </div>

                                                @if($webSiteCollection->isEmpty())
                                                    <div class="text-danger">
                                                        Список на данный момент пуст.</div>
                                                @else
                                                    @foreach($webSiteCollection as $webSite)
                                                        <div class="mb-2">
                                                            <x-checkbox
                                                                :id="$webSite->domain" name="websites[]" :value="$webSite->id" :invalid="$errors->has('websites.*')" :checked="$user->websites->where('id', $webSite->id)->count()" :disabled="!$edit">{{ $webSite->domain }}</x-checkbox>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <h6 class="card-title mb-2">История пользователя</h6>
                    <p class="text-muted mb-0">История пользователя: {{ $user->email }}. Показано последние 30ть записей.</p>
                </div>

                <div class="card-body">
                    @php $collection = $user->history()->limit(30)->get(); @endphp

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Сообщение</th>
                                <th scope="col" class="fw-semibold text-center">Дата создания</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($collection->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с историей пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($collection as $userHistory)
                                    <tr>
                                        <th class="text-center">{{ $userHistory->id }}</th>
                                        <td class="text-center">{{ str($userHistory->message)->limit(64) }}</td>
                                        <td class="text-center">{{ $userHistory->created_at }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view permission="Cms:UserHistory:View" :action="route('user-history.show', $userHistory->id)"></x-link-to-view>
                                                <x-link-to-delete permission="Cms:UserHistory:Delete" :action="route('user-history.destroy', $userHistory->id)"></x-link-to-delete>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
