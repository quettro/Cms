<x-app-layout>
    @section('title', __('База данных модулей'))

    <x-breadcrumb
        :navigation="[
            [
                'name' => 'Модули',
                'href' => route('modules.index')
            ],
            [
                'name' => $module->name,
                'href' => route('modules.show', $module->id)
            ],
            [
                'name' => 'База данных',
                'href' => route('modules.module-database.index', $module->id)
            ],
            [
                'name' => 'Запись #' . $moduleDatabase->id,
                'href' => ''
            ],
        ]"
    />

    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3">
                            @foreach($moduleDatabase->languages as $item)
                                <a @class(['small text-decoration-none', 'text-muted' => $moduleDatabaseLanguage->id !== $item->id]) href="?language={{ $item->id }}">
                                    Язык: {{ $item->language->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Запись #{{ $moduleDatabase->id }}</h6>

                        <nav class="nav justify-content-end">
                            <x-link-to-update
                                class="nav-link" permission="Cms:Module:Update" :disabled="$edit" :action="route('modules.module-database.edit', [
                                    'module' => $module->id,
                                    'moduleDatabase' => $moduleDatabase->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $moduleDatabaseLanguage->id }}">
                            </x-link-to-update>

                            <x-link-to-delete
                                class="nav-link" permission="Cms:Module:Delete" :action="route('modules.module-database.destroy', [
                                    'module' => $module->id,
                                    'moduleDatabase' => $moduleDatabase->id
                                ])"
                            >
                                <input type="hidden" name="language" value="{{ $moduleDatabaseLanguage->id }}">
                            </x-link-to-delete>
                        </nav>
                    </div>
                </div>

                <div class="card-body">
                    <x-form
                        :action="route('modules.module-database.update', [
                            'module' => $module->id,
                            'moduleDatabase' => $moduleDatabase->id
                        ])"

                        enctype="multipart/form-data"
                    >
                        @method('PATCH')

                        <input type="hidden" name="module_database_language_id" value="{{ $moduleDatabaseLanguage->id }}">

                        <div class="row gap-3">
                            @if($module->type->is(\App\Enums\ModuleType::INDIVIDUAL))
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header py-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="card-title mb-0">SEO</h6>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <x-form-group>
                                                        <x-label for="default.seo_title">Заголовок *</x-label>
                                                        <x-input id="default.seo_title" name="default[seo_title]" :value="old('default.seo_title', $moduleDatabaseLanguage->seo_title)" :invalid="$errors->has('default.seo_title')" :disabled="!$edit"></x-input>
                                                        <x-invalid-feedback :messages="$errors->get('default.seo_title')"></x-invalid-feedback>
                                                    </x-form-group>
                                                </div>

                                                <div class="col-lg-6">
                                                    <x-form-group>
                                                        <x-label for="default.seo_description">Описание</x-label>
                                                        <x-input id="default.seo_description" name="default[seo_description]" :value="old('default.seo_description', $moduleDatabaseLanguage->seo_description)" :invalid="$errors->has('default.seo_description')" :disabled="!$edit"></x-input>
                                                        <x-invalid-feedback :messages="$errors->get('default.seo_description')"></x-invalid-feedback>
                                                    </x-form-group>
                                                </div>

                                                <div class="col-lg-6">
                                                    <x-form-group>
                                                        <x-label for="default.seo_keywords">Ключевые слова</x-label>
                                                        <x-input id="default.seo_keywords" name="default[seo_keywords]" :value="old('default.seo_keywords', $moduleDatabaseLanguage->seo_keywords)" :invalid="$errors->has('default.seo_keywords')" :disabled="!$edit"></x-input>
                                                        <x-invalid-feedback :messages="$errors->get('default.seo_keywords')"></x-invalid-feedback>
                                                    </x-form-group>
                                                </div>

                                                <div class="col-lg-6">
                                                    <x-form-group>
                                                        <x-label for="default.seo_route">Маршрут / Чпу / Слаг</x-label>
                                                        <x-input id="default.seo_route" name="default[seo_route]" :value="old('default.seo_route', $moduleDatabaseLanguage->seo_route)" :invalid="$errors->has('default.seo_route')" :disabled="!$edit"></x-input>
                                                        <x-invalid-feedback :messages="$errors->get('default.seo_route')"></x-invalid-feedback>
                                                        <x-text-feedback>Если оставить поле пустым, сработает автозаполнение на основе поля "Заголовок".</x-text-feedback>
                                                    </x-form-group>
                                                </div>

                                                <div class="col-lg-6">
                                                    <x-form-group>
                                                        <x-label for="default.og_title">[ Open Graph ] Заголовок</x-label>
                                                        <x-input id="default.og_title" name="default[og_title]" :value="old('default.og_title', $moduleDatabaseLanguage->og_title)" :invalid="$errors->has('default.og_title')" :disabled="!$edit"></x-input>
                                                        <x-invalid-feedback :messages="$errors->get('default.og_title')"></x-invalid-feedback>
                                                    </x-form-group>
                                                </div>

                                                <div class="col-lg-6">
                                                    <x-form-group>
                                                        <x-label for="default.og_description">[ Open Graph ] Описание</x-label>
                                                        <x-input id="default.og_description" name="default[og_description]" :value="old('default.og_description', $moduleDatabaseLanguage->og_description)" :invalid="$errors->has('default.og_description')" :disabled="!$edit"></x-input>
                                                        <x-invalid-feedback :messages="$errors->get('default.og_description')"></x-invalid-feedback>
                                                    </x-form-group>
                                                </div>

                                                <div class="col-lg-6">
                                                    <x-form-group>
                                                        <x-label for="default.og_image">[ Open Graph ] Изображение</x-label>
                                                        <x-input-file id="default.og_image" name="default[og_image]" accept=".jpg, .jpeg, .png" :invalid="$errors->has('default.og_image')" :disabled="!$edit"></x-input-file>
                                                        <x-invalid-feedback :messages="$errors->get('default.og_image')"></x-invalid-feedback>

                                                        @if($moduleDatabaseLanguage->ogImage)
                                                            <x-text-feedback>
                                                                <div class="mb-0">[ Open Graph ] Изображение: <x-a :href="$moduleDatabaseLanguage->ogImage->link()" target="_blank">{{ $moduleDatabaseLanguage->ogImage->filename }}</x-a></div>
                                                            </x-text-feedback>
                                                        @endif
                                                    </x-form-group>
                                                </div>

                                                <div class="col-lg-6">
                                                    <x-form-group>
                                                        <x-label for="default.name_of_the_crumb">[ Хлебные крошки ] Наименование</x-label>
                                                        <x-input id="default.name_of_the_crumb" name="default[name_of_the_crumb]" :value="old('default.name_of_the_crumb', $moduleDatabaseLanguage->name_of_the_crumb)" :invalid="$errors->has('default.name_of_the_crumb')" :disabled="!$edit"></x-input>
                                                        <x-invalid-feedback :messages="$errors->get('default.name_of_the_crumb')"></x-invalid-feedback>
                                                    </x-form-group>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($moduleColumns->count())
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header py-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="card-title mb-0">Основная информация</h6>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                @foreach($moduleColumns as $moduleColumn)
                                                    @php $value = $moduleDatabaseLanguage->moduleDatabaseLanguageColumns()->where('module_column_id', $moduleColumn->id)->first(); @endphp

                                                    @if($moduleColumn->isTypeString())
                                                        <div class="col-12">
                                                            <x-form-group>
                                                                <x-label for="columns.{{ $moduleColumn->key }}">{{ $moduleColumn->name }} @if($moduleColumn->required)*@endif</x-label>
                                                                <x-input id="columns.{{ $moduleColumn->key }}" name="columns[{{ $moduleColumn->key }}]" :value="old(('columns.' . $moduleColumn->key), $value?->value)" :invalid="$errors->has('columns.' . $moduleColumn->key)" :disabled="!$edit"></x-input>
                                                                <x-invalid-feedback :messages="$errors->get('columns.' . $moduleColumn->key)"></x-invalid-feedback>
                                                            </x-form-group>
                                                        </div>
                                                    @endif

                                                    @if($moduleColumn->isTypeText())
                                                        <div class="col-12">
                                                            <x-form-group>
                                                                <x-label for="columns.{{ $moduleColumn->key }}">{{ $moduleColumn->name }} @if($moduleColumn->required)*@endif</x-label>
                                                                <x-textarea id="columns.{{ $moduleColumn->key }}" name="columns[{{ $moduleColumn->key }}]" :value="old(('columns.' . $moduleColumn->key), $value?->value)" :invalid="$errors->has('columns.' . $moduleColumn->key)" :disabled="!$edit"></x-textarea>
                                                                <x-invalid-feedback :messages="$errors->get('columns.' . $moduleColumn->key)"></x-invalid-feedback>
                                                            </x-form-group>
                                                        </div>
                                                    @endif

                                                    @if($moduleColumn->isTypeInteger())
                                                        <div class="col-12">
                                                            <x-form-group>
                                                                <x-label for="columns.{{ $moduleColumn->key }}">{{ $moduleColumn->name }} @if($moduleColumn->required)*@endif</x-label>
                                                                <x-input id="columns.{{ $moduleColumn->key }}" type="number" name="columns[{{ $moduleColumn->key }}]" :value="old(('columns.' . $moduleColumn->key), $value?->value)" :invalid="$errors->has('columns.' . $moduleColumn->key)" :disabled="!$edit"></x-input>
                                                                <x-invalid-feedback :messages="$errors->get('columns.' . $moduleColumn->key)"></x-invalid-feedback>
                                                            </x-form-group>
                                                        </div>
                                                    @endif

                                                    @if($moduleColumn->isTypeDate())
                                                        <div class="col-12">
                                                            <x-form-group>
                                                                <x-label for="columns.{{ $moduleColumn->key }}">{{ $moduleColumn->name }} @if($moduleColumn->required)*@endif</x-label>
                                                                <x-input id="columns.{{ $moduleColumn->key }}" type="date" name="columns[{{ $moduleColumn->key }}]" :value="old(('columns.' . $moduleColumn->key), $value?->value)" :invalid="$errors->has('columns.' . $moduleColumn->key)" :disabled="!$edit"></x-input>
                                                                <x-invalid-feedback :messages="$errors->get('columns.' . $moduleColumn->key)"></x-invalid-feedback>
                                                            </x-form-group>
                                                        </div>
                                                    @endif

                                                    @if($moduleColumn->isTypeDateTime())
                                                        <div class="col-12">
                                                            <x-form-group>
                                                                <x-label for="columns.{{ $moduleColumn->key }}">{{ $moduleColumn->name }} @if($moduleColumn->required)*@endif</x-label>
                                                                <x-input id="columns.{{ $moduleColumn->key }}" type="datetime-local" name="columns[{{ $moduleColumn->key }}]" :value="old(('columns.' . $moduleColumn->key), $value?->value)" :invalid="$errors->has('columns.' . $moduleColumn->key)" :disabled="!$edit"></x-input>
                                                                <x-invalid-feedback :messages="$errors->get('columns.' . $moduleColumn->key)"></x-invalid-feedback>
                                                            </x-form-group>
                                                        </div>
                                                    @endif

                                                    @if($moduleColumn->isTypeTime())
                                                        <div class="col-12">
                                                            <x-form-group>
                                                                <x-label for="columns.{{ $moduleColumn->key }}">{{ $moduleColumn->name }} @if($moduleColumn->required)*@endif</x-label>
                                                                <x-input id="columns.{{ $moduleColumn->key }}" type="time" name="columns[{{ $moduleColumn->key }}]" :value="old(('columns.' . $moduleColumn->key), $value?->value)" :invalid="$errors->has('columns.' . $moduleColumn->key)" :disabled="!$edit"></x-input>
                                                                <x-invalid-feedback :messages="$errors->get('columns.' . $moduleColumn->key)"></x-invalid-feedback>
                                                            </x-form-group>
                                                        </div>
                                                    @endif

                                                    @if($moduleColumn->isTypeFile())
                                                        <div class="col-12">
                                                            <x-form-group>
                                                                <x-label for="columns.{{ $moduleColumn->key }}">{{ $moduleColumn->name }} @if($moduleColumn->required)*@endif</x-label>
                                                                <x-input-file id="columns.{{ $moduleColumn->key }}" name="columns[{{ $moduleColumn->key }}]" :invalid="$errors->has('columns.' . $moduleColumn->key)" :disabled="!$edit"></x-input-file>
                                                                <x-invalid-feedback :messages="$errors->get('columns.' . $moduleColumn->key)"></x-invalid-feedback>

                                                                @if($value?->file)
                                                                    <x-text-feedback>
                                                                        <div class="mb-0">{{ $moduleColumn->name }}: <x-a :href="$value->file->link()" target="_blank">{{ $value->file->filename }}</x-a></div>
                                                                    </x-text-feedback>
                                                                @endif
                                                            </x-form-group>
                                                        </div>
                                                    @endif

                                                    @if($moduleColumn->isTypeCodeMirror())
                                                        <div class="col-12">
                                                            <x-form-group>
                                                                <x-label for="columns.{{ $moduleColumn->key }}">{{ $moduleColumn->name }} @if($moduleColumn->required)*@endif</x-label>
                                                                <x-codemirror id="columns.{{ $moduleColumn->key }}" name="columns[{{ $moduleColumn->key }}]" :value="old(('columns.' . $moduleColumn->key), $value?->value)" :invalid="$errors->has('columns.' . $moduleColumn->key)" :disabled="!$edit"></x-codemirror>
                                                                <x-invalid-feedback :messages="$errors->get('columns.' . $moduleColumn->key)"></x-invalid-feedback>
                                                            </x-form-group>
                                                        </div>
                                                    @endif

                                                    @if($moduleColumn->isTypeYoutube())
                                                        <div class="col-12">
                                                            <x-form-group>
                                                                <x-label for="columns.{{ $moduleColumn->key }}">{{ $moduleColumn->name }} @if($moduleColumn->required)*@endif</x-label>
                                                                <x-input id="columns.{{ $moduleColumn->key }}" name="columns[{{ $moduleColumn->key }}]" :value="old(('columns.' . $moduleColumn->key), $value?->value)" :invalid="$errors->has('columns.' . $moduleColumn->key)" :disabled="!$edit"></x-input>
                                                                <x-invalid-feedback :messages="$errors->get('columns.' . $moduleColumn->key)"></x-invalid-feedback>
                                                            </x-form-group>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="col-12">
                                @php $webSiteCollection = \App\Models\WebSite::query()->get(); @endphp

                                <div class="card">
                                    <div class="card-header py-4">
                                        <h6 class="card-title mb-1">
                                            Веб-сайты
                                        </h6>
                                        <div class="text-muted">На каких сайтах будет доступна данная запись?</div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            @if($webSiteCollection->isEmpty())
                                                <div class="col-12">
                                                    <div class="mb-0">
                                                        <div class="text-danger">
                                                            На данный момент список сайтов пуст.
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-12">
                                                    <div class="check-all-the-boxes">
                                                        <div class="mb-2">
                                                            <x-checkbox id="check-all-the-boxes--0" :disabled="!$edit">Все</x-checkbox>
                                                        </div>

                                                        @foreach($webSiteCollection as $webSite)
                                                            <div class="mb-1">
                                                                <x-checkbox :id="$webSite->domain" name="default[websites][]" :value="$webSite->id" :invalid="$errors->has('default.websites.*')" :checked="$moduleDatabase->webSites->where('id', $webSite->id)->count()" :disabled="!$edit">{{ $webSite->domain }}</x-checkbox>
                                                            </div>
                                                        @endforeach

                                                        <x-invalid-feedback :messages="$errors->get('default.websites.*')"></x-invalid-feedback>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($edit)
                                <div class="col-12">
                                    <div class="p-3 bg-light rounded">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <x-button class="btn-primary">
                                                Применить изменения
                                            </x-button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
