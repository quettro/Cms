@section('title', __('Редактирование дополнительного кода'))

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
                'name' => 'Редактирование дополнительного кода',
                'href' => ''
            ]
        ]"
    />

    <x-form :action="route('web-sites.code.update', $webSite->id)">
        @method('PATCH')

        <div class="row gap-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-4">
                        <h6 class="card-title mb-0">< /HEAD></h6>
                    </div>

                    <div class="card-body">
                        <x-codemirror id="head" name="head" :value="old('head', $webSite->head)" :invalid="$errors->has('head')"></x-codemirror>
                        <x-invalid-feedback :messages="$errors->get('head')"></x-invalid-feedback>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header py-4">
                        <h6 class="card-title mb-0">< /BODY></h6>
                    </div>

                    <div class="card-body">
                        <x-codemirror id="body" name="body" :value="old('body', $webSite->body)" :invalid="$errors->has('body')"></x-codemirror>
                        <x-invalid-feedback :messages="$errors->get('body')"></x-invalid-feedback>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-body">
                    <div class="d-flex justify-content-end">
                        <x-button class="btn-primary">
                            Применить изменения
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </x-form>
</x-app-layout>
