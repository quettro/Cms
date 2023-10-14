<x-app-layout>
    @section('title', __('Формы'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Формы',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Формы</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:Form:Create" :action="route('forms.create')"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $forms->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Ключ</th>
                                <th scope="col" class="fw-semibold text-center">Редирект</th>
                                <th scope="col" class="fw-semibold text-center">Адреса электронных почт</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($forms->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с формами пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($forms as $form)
                                    <tr>
                                        <th class="text-center">{{ $form->id }}</th>
                                        <td class="text-center">{{ $form->key }}</td>
                                        <td class="text-center">{{ $form->redirect }}</td>
                                        <td class="text-center">{{ empty($form->addresses) ? '-' : implode(', ', $form->addresses) }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view permission="Cms:Form:View" :action="route('forms.show', $form->id)"></x-link-to-view>
                                                <x-link-to-delete permission="Cms:Form:Delete" :action="route('forms.destroy', $form->id)"></x-link-to-delete>
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
