<x-app-layout>
    @section('title', __('Веб-данные'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Веб-данные',
                'href' => route('web-data.index')
            ],
            [
                'name' => 'Просмотр данных `№'. $webData->id .'`',
                'href' => ''
            ]
        ]"
    />

    <div class="row gap-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Заявка №{{ $webData->id }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-delete
                                class="nav-link" permission="Cms:WebData:Delete" :action="route('web-data.destroy', $webData->id)"
                            ></x-link-to-delete>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Направлен с:</span>
                            <span><x-a :href="$webData->referer" target="_blank">{{ $webData->referer }}</x-a></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Ip-адрес:</span>
                            <span>{{ $webData->ip }}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Дата создания:</span>
                            <span>{{ $webData->created_at }}</span>
                        </li>

                        @if($webData->form)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Идентификатор формы:</span>
                                <span><x-a :href="route('forms.show', $webData->form->id)" target="_blank">{{ $webData->form->key }}</x-a></span>
                            </li>
                        @endif

                        @if($webData->webSite)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Веб-сайт:</span>
                                <span><x-a :href="route('web-sites.show', $webData->webSite->id)" target="_blank">{{ $webData->webSite->name }}</x-a></span>
                            </li>
                        @endif

                        @if($webData->language)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Язык:</span>
                                <span><x-a :href="route('languages.show', $webData->language->id)" target="_blank">{{ $webData->language->name }}</x-a></span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-body">
                <div class="row">
                    @foreach($webData->all as $input => $value)
                        @php $textarea = $value; @endphp

                        @if(is_array($value))
                            @php $textarea = ''; @endphp

                            @foreach($value as $v)
                                @if(!is_array($v))
                                    @php $textarea .= $v . PHP_EOL; @endphp
                                @else
                                    @php $textarea  = print_r($value, true); @endphp @break
                                @endif
                            @endforeach
                        @endif

                        <div class="col-lg-6">
                            <x-form-group>
                                <x-label
                                    :for="$input">{{ \App\Models\Input::where('key', $input)->first()?->name ?? ucwords($input) }}</x-label>

                                <x-textarea
                                    :id="$input"
                                    :name="$input"
                                    :value="$textarea"
                                    :rows="count(explode(PHP_EOL, $textarea))"
                                    :disabled="true"></x-textarea>
                            </x-form-group>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <div class="accordion" id="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-v" aria-expanded="false" aria-controls="accordion-v">
                                        Данные, которые были подвергнуты проверке
                                    </button>
                                </h2>

                                <div id="accordion-v" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="pre-wrap">{{ print_r($webData->validated, true) }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-a" aria-expanded="false" aria-controls="accordion-a">
                                        Все полученные данные
                                    </button>
                                </h2>

                                <div id="accordion-a" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <div class="pre-wrap">{{ print_r($webData->all, true) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
