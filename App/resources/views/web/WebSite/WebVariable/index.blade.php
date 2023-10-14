@section('title', __('Переменные'))

<x-app-layout>
    @include('web.WebSite.sidebar')

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Сайты',
                'href' => route('web-sites.index')
            ],
            [
                'name' => $webSite->domain,
                'href' => route('web-sites.show', $webSite->id)
            ],
            [
                'name' => 'Переменные',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Переменные</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:WebVariable:Create" :action="route('web-sites.web-variables.create', $webSite->id)"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $webVariables->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Наименование</th>
                                <th scope="col" class="fw-semibold text-center">Ключ</th>
                                <th scope="col" class="fw-semibold text-center">Значения</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($webVariables->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с переменными пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($webVariables as $webVariable)
                                    <tr>
                                        <th class="text-center">{{ $webVariable->id }}</th>
                                        <td class="text-center">{{ $webVariable->name }}</td>
                                        <td class="text-center">{{ $webVariable->key }}</td>

                                        <td class="text-left">
                                            <div class="container">
                                                @foreach($webVariable->languages as $language)
                                                    <div class="row">
                                                        <div class="col text-left">
                                                            {{ $language->version->value }}
                                                        </div>
                                                    </div>
                                                    @if(!$loop->last)<hr class="m-1">@endif
                                                @endforeach
                                            </div>
                                        </td>

                                        <td class="text-left">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view
                                                    permission="Cms:WebVariable:View" :action="route('web-sites.web-variables.show', [
                                                        'webSite' => $webSite->id,
                                                        'webVariable' => $webVariable->id
                                                    ])"
                                                />

                                                <x-link-to-delete
                                                    permission="Cms:WebVariable:Delete" :action="route('web-sites.web-variables.destroy', [
                                                        'webSite' => $webSite->id,
                                                        'webVariable' => $webVariable->id
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
