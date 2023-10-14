<x-app-layout>
    @section('title', __('История пользователей'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'История пользователей',
                'href' => ''
            ]
        ]"
    />

    <div class="row gap-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    Поиск
                </div>

                <div class="card-body">
                    <x-form :action="route('user-history.index')" method="GET" :csrf="false">
                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="message">Сообщение</x-label>
                                    <x-input id="message" name="message" :value="old('message', $filter->query()->get('message'))" :invalid="$errors->has('message')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('message')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="user_id">Пользователь</x-label>
                                    <x-select id="user_id" name="user_id" :option="\App\Models\User::get()->dropdown()" :o_selected="[old('user_id', $filter->query()->get('user_id'))]" :invalid="$errors->has('user_id')"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('user_id')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-end align-items-center">
                                    <x-button class="btn-primary">
                                        Поиск
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">История пользователей</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:UserHistory:Create" :action="route('user-history.create')"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $collection->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Пользователь</th>
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
                                            На данный момент список с историями пользователей пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($collection as $userHistory)
                                    <tr>
                                        <th class="text-center">{{ $userHistory->id }}</th>
                                        <td class="text-center">{{ $userHistory->user?->email }}</td>
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
