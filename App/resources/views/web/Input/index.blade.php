<x-app-layout>
    @section('title', __('Поля форм'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Поля форм',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Поля форм</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:Input:Create" :action="route('inputs.create')"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $inputs->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Ключ</th>
                                <th scope="col" class="fw-semibold text-center">Наименование</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($inputs->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с полями форм пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($inputs as $input)
                                    <tr>
                                        <th class="text-center">{{ $input->id }}</th>
                                        <td class="text-center">{{ $input->key }}</td>
                                        <td class="text-center">{{ $input->name }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view permission="Cms:Input:View" :action="route('inputs.show', $input->id)"></x-link-to-view>
                                                <x-link-to-delete permission="Cms:Input:Delete" :action="route('inputs.destroy', $input->id)"></x-link-to-delete>
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
