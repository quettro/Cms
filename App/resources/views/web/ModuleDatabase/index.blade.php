<x-app-layout>
    @section('title', __('База данных модулей'))

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
                'name' => 'База данных',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">База данных модуля `{{ $module->name }}`</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-back
                                class="nav-link" :action="route('modules.show', $module->id)"
                            />

                            <x-link-to-create
                                class="nav-link" permission="Cms:Module:Create" :action="route('modules.module-database.create', $module->id)"
                            />

                            <x-form :action="route('modules.module-database.drop', $module->id)" class="js--form-delete">
                                @method('DELETE')

                                <button type="submit" class="btn btn-link text-danger py-0 text-decoration-none" @cannot('Cms:Module:Delete') disabled="" @endcannot>
                                    Очистить базу данных
                                </button>
                            </x-form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $moduleDatabase->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>

                                @foreach($moduleColumns as $moduleColumn)
                                    <th scope="col" class="fw-semibold text-center">{{ $moduleColumn->name }}</th>
                                @endforeach

                                <th scope="col" class="fw-semibold text-center">Дата создания</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($moduleDatabase->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с колонками модуля пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($moduleDatabase as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->id }}</td>

                                        @foreach($moduleColumns as $moduleColumn)
                                            <td class="text-center">
                                                @foreach($item->languages as $language)
                                                    @php $value = $language->moduleDatabaseLanguageColumns()->where('module_column_id', $moduleColumn->id)->first(); @endphp
                                                    <div class="text-bolder">{{ $language->language->codename }}: {{ $value?->value }}</div>
                                                @endforeach
                                            </td>
                                        @endforeach

                                        <td class="text-center">{{ $item->created_at }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view
                                                    permission="Cms:Module:View" :form="false" :action="route('modules.module-database.show', [
                                                        'module' => $module->id,
                                                        'moduleDatabase' => $item->id
                                                    ])"
                                                />

                                                <x-link-to-delete
                                                    permission="Cms:Module:Delete" :action="route('modules.module-database.destroy', [
                                                        'module' => $module->id,
                                                        'moduleDatabase' => $item->id
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
