<x-app-layout>
    @section('title', __('Модули'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Модули',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Модули</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:Module:Create" :action="route('modules.create')"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $modules->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Наименование</th>
                                <th scope="col" class="fw-semibold text-center">Ключ</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($modules->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с модулями пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($modules as $module)
                                    <tr>
                                        <th class="text-center">{{ $module->id }}</th>
                                        <td class="text-center">{{ $module->name }}</td>
                                        <td class="text-center">{{ $module->key }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view permission="Cms:Module:View" :action="route('modules.show', $module->id)"></x-link-to-view>
                                                <x-link-to-delete permission="Cms:Module:Delete" :action="route('modules.destroy', $module->id)"></x-link-to-delete>
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
