<x-app-layout>
    @section('title', __('Шаблоны модулей'))

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
                'name' => 'Шаблоны',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Шаблоны модуля `{{ $module->name }}`</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-back
                                class="nav-link" :action="route('modules.show', $module->id)"
                            />

                            <x-link-to-create
                                class="nav-link" permission="Cms:Module:Create" :action="route('modules.module-templates.create', $module->id)"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $moduleTemplates->links() }}
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
                            @if($moduleTemplates->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с шаблонами модуля пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($moduleTemplates as $moduleTemplate)
                                    <tr>
                                        <th class="text-center">{{ $moduleTemplate->id }}</th>
                                        <td class="text-center">{{ $moduleTemplate->name }}</td>
                                        <td class="text-center">{{ $moduleTemplate->key }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view
                                                    permission="Cms:Module:View" :action="route('modules.module-templates.show', [
                                                        'module' => $module->id,
                                                        'moduleTemplate' => $moduleTemplate->id
                                                    ])"
                                                />

                                                <x-link-to-delete
                                                    permission="Cms:Module:Delete" :action="route('modules.module-templates.destroy', [
                                                        'module' => $module->id,
                                                        'moduleTemplate' => $moduleTemplate->id
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
