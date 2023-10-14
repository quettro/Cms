@section('title', __('Шаблоны страниц'))

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
                'name' => 'Шаблоны страниц',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Шаблоны страниц</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:WebPageTemplate:Create" :action="route('web-sites.web-page-templates.create', $webSite->id)"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $webPageTemplates->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Наименование</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($webPageTemplates as $webPageTemplate)
                                <tr>
                                    <th class="text-center">{{ $webPageTemplate->id }}</th>
                                    <td class="text-center">{{ $webPageTemplate->name }}</td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <x-link-to-view
                                                permission="Cms:WebPageTemplate:View" :action="route('web-sites.web-page-templates.show', [
                                                    'webSite' => $webSite->id,
                                                    'webPageTemplate' => $webPageTemplate->id
                                                ])"
                                            />

                                            <x-link-to-delete
                                                permission="Cms:WebPageTemplate:Delete" :action="route('web-sites.web-page-templates.destroy', [
                                                    'webSite' => $webSite->id,
                                                    'webPageTemplate' => $webPageTemplate->id
                                                ])"
                                            />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
