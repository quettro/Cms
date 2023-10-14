<x-app-layout>
    @section('title', __('Пользователи'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Пользователи',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Пользователи</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:User:Create" :action="route('users.create')"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $users->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Электронная почта</th>
                                <th scope="col" class="fw-semibold text-center">Имя пользователя</th>
                                <th scope="col" class="fw-semibold text-center">Номер телефона</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($users->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с пользователями пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($users as $user)
                                    <tr>
                                        <th class="text-center">{{ $user->id }}</th>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->phone->formatted }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view
                                                    permission="Cms:User:View" :action="route('users.show', $user->id)"></x-link-to-view>

                                                <x-link-to-delete
                                                    permission="Cms:User:Delete" :action="route('users.destroy', $user->id)"></x-link-to-delete>
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
