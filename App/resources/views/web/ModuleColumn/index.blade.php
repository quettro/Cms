<x-app-layout>
    @section('title', __('Колонки модулей'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Модули',
                'href' => route('modules.index')
            ],
            [
                'name' => $module->name,
                'href' => route('modules.show', $module->id)
            ],
            [
                'name' => 'Колонки',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Колонки модуля `{{ $module->name }}`</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-back
                                class="nav-link" :action="route('modules.show', $module->id)"
                            />

                            <x-link-to-create
                                class="nav-link" permission="Cms:Module:Create" :action="route('modules.module-columns.create', $module->id)"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $moduleColumns->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Ключ</th>
                                <th scope="col" class="fw-semibold text-center">Наименование</th>
                                <th scope="col" class="fw-semibold text-center">Тип</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($moduleColumns->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с колонками модуля пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($moduleColumns as $moduleColumn)
                                    <tr>
                                        <th class="text-center">{{ $moduleColumn->id }}</th>
                                        <td class="text-center">{{ $moduleColumn->key }}</td>
                                        <td class="text-center">{{ $moduleColumn->name }}</td>
                                        <td class="text-center">{{ $moduleColumn->type->value }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view
                                                    permission="Cms:Module:View" :action="route('modules.module-columns.show', [
                                                        'module' => $module->id,
                                                        'moduleColumn' => $moduleColumn->id
                                                    ])"
                                                />

                                                <x-link-to-delete
                                                    permission="Cms:Module:Delete" :action="route('modules.module-columns.destroy', [
                                                        'module' => $module->id,
                                                        'moduleColumn' => $moduleColumn->id
                                                    ])"
                                                />
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
