@section('title', __('Парсинг'))

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
                'name' => 'Парсинг',
                'href' => ''
            ]
        ]"
    />

    <div class="row gap-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Парсинг</h6>
                    </div>
                </div>

                <div class="card-body">
                    <x-form :action="route('web-sites.web-robber.store', $webSite->id)">
                        <div class="row">
                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="domain">[ Парсинг ] Сайт *</x-label>
                                    <x-input id="domain" name="domain" :value="old('domain')" :invalid="$errors->has('domain')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('domain')"></x-invalid-feedback>
                                    <x-text-feedback>Пример: https://prod-expo.ru</x-text-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="route">[ Парсинг ] Маршрут *</x-label>
                                    <x-input id="route" name="route" :value="old('route')" :invalid="$errors->has('route')"></x-input>
                                    <x-invalid-feedback :messages="$errors->get('route')"></x-invalid-feedback>
                                    <x-text-feedback>Кодовое название языка не должно входить в маршрут. Пример: /exhibition/about/</x-text-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-lg-6">
                                <x-form-group>
                                    <x-label for="web_page_template_id">[ Cms ] Шаблон страницы *</x-label>
                                    <x-select id="web_page_template_id" name="web_page_template_id" :option="$webSite->webPageTemplates()->get()->dropdown()" :o_selected="[old('web_page_template_id')]" :invalid="$errors->has('web_page_template_id')"></x-select>
                                    <x-invalid-feedback :messages="$errors->get('web_page_template_id')"></x-invalid-feedback>
                                </x-form-group>
                            </div>

                            <div class="col-12">
                                <div class="p-3 bg-light rounded">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <x-button class="btn-primary">
                                            Продолжить
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Очереди</h6>
                    </div>
                </div>

                <div class="card-body">
                    @php $webRobberCollection = $webSite->webRobbers()->limit(10)->get(); @endphp

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">Id</th>
                                <th scope="col" class="fw-semibold text-center">Сайт</th>
                                <th scope="col" class="fw-semibold text-center">Маршрут</th>
                                <th scope="col" class="fw-semibold text-center">Сообщение</th>
                                <th scope="col" class="fw-semibold text-center">Статус</th>
                                <th scope="col" class="fw-semibold text-center">Дата создания</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($webRobberCollection->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент таблица пуста.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($webRobberCollection as $webRobber)
                                    <tr>
                                        <th class="text-center">{{ $webRobber->id }}</th>
                                        <td class="text-center">{{ $webRobber->domain }}</td>
                                        <td class="text-center">{{ $webRobber->route }}</td>
                                        <td class="text-center">{{ $webRobber->message ?? '-' }}</td>
                                        <td class="text-center">{{ $webRobber->status->description }}</td>
                                        <td class="text-center">{{ $webRobber->created_at }}</td>
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
