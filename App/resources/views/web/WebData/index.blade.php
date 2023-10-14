<x-app-layout>
    @section('title', __('Веб-данные'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Веб-данные',
                'href' => ''
            ]
        ]"
    />

    <div class="row gap-3">
        <div class="col-12">
            <div class="card card-body">
                <x-form method="GET" :action="route('web-data.index')" :csrf="false">
                    <div class="row">
                        <div class="col-lg-3">
                            <x-form-group>
                                <x-label for="search">Поиск</x-label>
                                <x-input id="search" name="search" :value="old('search', request()->get('search'))" :invalid="$errors->has('search')"></x-input>
                                <x-invalid-feedback :messages="$errors->get('search')"></x-invalid-feedback>
                            </x-form-group>
                        </div>

                        <div class="col-lg-3">
                            <x-form-group>
                                <x-label for="form_id">Идентификатор формы</x-label>
                                <x-select id="form_id" name="form_id" :option="\App\Models\Form::get()->dropdown()" :o_selected="[old('form_id', request()->get('form_id'))]" :invalid="$errors->has('form_id')"></x-select>
                                <x-invalid-feedback :messages="$errors->get('form_id')"></x-invalid-feedback>
                            </x-form-group>
                        </div>

                        <div class="col-lg-3">
                            <x-form-group>
                                <x-label for="language_id">Язык</x-label>
                                <x-select id="language_id" name="language_id" :option="\App\Models\Language::get()->dropdown()" :o_selected="[old('language_id', request()->get('language_id'))]" :invalid="$errors->has('language_id')"></x-select>
                                <x-invalid-feedback :messages="$errors->get('language_id')"></x-invalid-feedback>
                            </x-form-group>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <x-label for="web_site_id">Сайт</x-label>
                                <x-select id="web_site_id" name="web_site_id" :option="\App\Models\WebSite::get()->dropdown()" :o_selected="[old('web_site_id', request()->get('web_site_id'))]" :invalid="$errors->has('web_site_id')"></x-select>
                                <x-invalid-feedback :messages="$errors->get('web_site_id')"></x-invalid-feedback>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-end align-items-center">
                                <button type="submit" class="btn btn-outline-primary">
                                    Продолжить
                                </button>
                            </div>
                        </div>
                    </div>
                </x-form>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Веб-данные</h6>

                        @can('Cms:WebData:Export')
                            <div class="d-flex justify-content-end align-items-center">
                                <span class="me-3 text-muted">Скачать данные используя фильтры выше:</span>

                                <div class="dropdown dropleft">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Скачать
                                    </button>

                                    <div class="dropdown-menu">
                                        <x-form :action="route('web-data.csv')">
                                            <input type="hidden" name="search" value="{{ request()->get('search') }}">
                                            <input type="hidden" name="form_id" value="{{ request()->get('form_id') }}">
                                            <input type="hidden" name="web_site_id" value="{{ request()->get('web_site_id') }}">

                                            <x-button class="dropdown-item text-center">CSV</x-button>
                                        </x-form>

                                        <x-form :action="route('web-data.xlsx')">
                                            <input type="hidden" name="search" value="{{ request()->get('search') }}">
                                            <input type="hidden" name="form_id" value="{{ request()->get('form_id') }}">
                                            <input type="hidden" name="web_site_id" value="{{ request()->get('web_site_id') }}">

                                            <x-button class="dropdown-item text-center">XLSX</x-button>
                                        </x-form>
                                    </div>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        {{ $webData->links() }}
                    </div>

                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold text-center">№</th>
                                <th scope="col" class="fw-semibold text-center">Имя</th>
                                <th scope="col" class="fw-semibold text-center">Телефон</th>
                                <th scope="col" class="fw-semibold text-center">Адрес электронной почты</th>
                                <th scope="col" class="fw-semibold text-center">Идентификатор формы</th>
                                <th scope="col" class="fw-semibold text-center">Язык</th>
                                <th scope="col" class="fw-semibold text-center">Сайт</th>
                                <th scope="col" class="fw-semibold text-center">Ip</th>
                                <th scope="col" class="fw-semibold text-center">Дата создания</th>
                                <th scope="col" class="fw-semibold text-center">Действия</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($webData->isEmpty())
                                <tr>
                                    <td class="text-center" colspan="999">
                                        <span class="text-muted">
                                            На данный момент список с данными пуст.
                                        </span>
                                    </td>
                                </tr>
                            @else
                                @foreach($webData as $d)
                                    <tr>
                                        <th class="text-center">{{ $d->id }}</th>
                                        <td class="text-center">{{ $d->name }}</td>
                                        <td class="text-center">{{ $d->phone }}</td>
                                        <td class="text-center">{{ $d->email }}</td>
                                        <td class="text-center">{{ $d->form?->key }}</td>
                                        <td class="text-center">{{ $d->language?->name }}</td>
                                        <td class="text-center">{{ $d->website?->name }}</td>
                                        <td class="text-center">{{ $d->ip }}</td>
                                        <td class="text-center">{{ $d->created_at }}</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <x-link-to-view permission="Cms:WebData:View" :action="route('web-data.show', $d->id)"></x-link-to-view>
                                                <x-link-to-delete permission="Cms:WebData:Delete" :action="route('web-data.destroy', $d->id)"></x-link-to-delete>
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
