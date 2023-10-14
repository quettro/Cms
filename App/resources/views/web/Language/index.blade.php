<x-app-layout>
    @section('title', __('Языки'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Языки',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Языки</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:Language:Create" :action="route('languages.create')"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $languages->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Наименование</th>
                                <th scope="col" class="fw-semibold text-center">Кодовое название</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($languages->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с языками пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($languages as $language)
                                    <tr>
                                        <th class="text-center">{{ $language->id }}</th>
                                        <td class="text-center">{{ $language->name }}</td>
                                        <td class="text-center">{{ $language->codename }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view permission="Cms:Language:View" :action="route('languages.show', $language->id)"></x-link-to-view>
                                                <x-link-to-delete permission="Cms:Language:Delete" :action="route('languages.destroy', $language->id)"></x-link-to-delete>
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
