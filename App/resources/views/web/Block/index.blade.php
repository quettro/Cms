<x-app-layout>
    @section('title', __('Блоки'))

    <x-breadcrumb
        :navigation="[
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
                                class="nav-link" permission="Cms:Block:Create" :action="route('blocks.create')"
                            />
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $blocks->links() }}
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
                            @if($blocks->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с шаблонами блоков пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($blocks as $block)
                                    <tr>
                                        <th class="text-center">{{ $block->id }}</th>
                                        <td class="text-center">{{ $block->key }}</td>
                                        <td class="text-center">{{ $block->name }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view permission="Cms:Block:View" :action="route('blocks.show', $block->id)"></x-link-to-view>
                                                <x-link-to-delete permission="Cms:Block:Delete" :action="route('blocks.destroy', $block->id)"></x-link-to-delete>
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
