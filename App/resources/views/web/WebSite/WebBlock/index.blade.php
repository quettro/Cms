@section('title', __('Блоки'))

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
                'name' => 'Блоки',
                'href' => ''
            ]
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Блоки</h6>

                        <div class="nav justify-content-end">
                            <x-link-to-create
                                class="nav-link" permission="Cms:WebBlock:Create" :action="route('web-sites.web-blocks.create', $webSite->id)"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $webBlocks->links() }}
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
                            @if($webBlocks->isNotEmpty())
                                @foreach($webBlocks as $webBlock)
                                    <tr>
                                        <th class="text-center">{{ $webBlock->id }}</th>
                                        <td class="text-center">{{ $webBlock->key }}</td>
                                        <td class="text-center">{{ $webBlock->name }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view
                                                    permission="Cms:WebBlock:View" :action="route('web-sites.web-blocks.show', [
                                                        'webSite' => $webSite->id,
                                                        'webBlock' => $webBlock->id
                                                    ])"
                                                />

                                                <x-link-to-delete
                                                    permission="Cms:WebBlock:Delete" :action="route('web-sites.web-blocks.destroy', [
                                                        'webSite' => $webSite->id,
                                                        'webBlock' => $webBlock->id
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
