@php $codeMirrorHelpM = uniqid(prefix: 'm-'); @endphp

<div class="codeMirror-nav">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center"></div>

        <div class="d-flex align-items-center gap-3">
            <a href="#" class="inline-block text-decoration-none text-light border-bottom" data-bs-toggle="modal" data-bs-target="#{{ $codeMirrorHelpM }}">Помощь</a>
            <a href="#" class="inline-block text-decoration-none text-light border-bottom codeMirror-nav__fullscreen">На весь экран</a>
        </div>
    </div>
</div>

<div class="modal fade" id="{{ $codeMirrorHelpM }}" tabindex="-1" aria-labelledby="{{ $codeMirrorHelpM }}-Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-6" id="{{ $codeMirrorHelpM }}-Label">
                    Помощь
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-0">
                @php $codeMirrorHelpAccordion = uniqid(prefix: 'a-'); @endphp

                <div class="accordion accordion-flush" id="{{ $codeMirrorHelpAccordion }}">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $codeMirrorHelpAccordion }}-0" aria-expanded="false" aria-controls="{{ $codeMirrorHelpAccordion }}-0">
                                Основные
                            </button>
                        </h2>

                        <div id="{{ $codeMirrorHelpAccordion }}-0" class="accordion-collapse collapse" data-bs-parent="#{{ $codeMirrorHelpAccordion }}">
                            <div class="accordion-body">
                                <div class="d-flex flex-column gap-4">
                                    <div class="">
                                        <div class="p-3 text-muted" style="background-color: #22272e;">
                                            <div class="text-white mb-1">Формы</div>
                                            <div>- Для подключения содержимого, необходимо заменить "name" на "Ключ" формы.</div>
                                        </div>
                                        <x-highlight>
                                            @php
                                                echo e(<<<'BLADE'

                                                {!! $constructor->render()->form('name') !!}

                                                BLADE);
                                            @endphp
                                        </x-highlight>
                                    </div>

                                    <div class="">
                                        <div class="p-3 text-muted" style="background-color: #22272e;">
                                            <div class="text-white mb-1">Поля форм</div>
                                            <div>- Для подключения содержимого, необходимо заменить "name" на "Ключ" поля.</div>
                                        </div>
                                        <x-highlight>
                                            @php
                                                echo e(<<<'BLADE'

                                                {!! $constructor->render()->input('name') !!}

                                                BLADE);
                                            @endphp
                                        </x-highlight>
                                    </div>

                                    <div class="">
                                        <div class="p-3 text-muted" style="background-color: #22272e;">
                                            <div class="text-white mb-1">Блоки</div>
                                            <div>- Для подключения содержимого, необходимо заменить "name" на "Ключ" блока.</div>
                                        </div>
                                        <x-highlight>
                                            @php
                                                echo e(<<<'BLADE'

                                                {!! $constructor->render()->block('name') !!}

                                                BLADE);
                                            @endphp
                                        </x-highlight>
                                    </div>

                                    <div class="">
                                        <div class="p-3 text-muted" style="background-color: #22272e;">
                                            <div class="text-white mb-1">Модули</div>
                                            <div>- Для отображения конкретного модуля необходимо заменить "name" на "Ключ" модуля, а для выбора соответствующего шаблона используйте "templateName", который является ключом шаблона. Каждый модуль может иметь несколько шаблонов и необходимо указать, какой именно нужно использовать.</div>
                                        </div>
                                        <x-highlight>
                                            @php
                                                echo e(<<<'BLADE'

                                                {!! $constructor->render()->module('name', 'templateName') !!}

                                                BLADE);
                                            @endphp
                                        </x-highlight>
                                    </div>

                                    <div class="">
                                        <div class="p-3 text-muted" style="background-color: #22272e;">
                                            <div class="text-white mb-1">[ Сайт(ы) ] Шаблоны страниц</div>
                                            <div>- Требуется вставить следующую конструкцию в места, где нужно подключить содержимое страниц.</div>
                                        </div>
                                        <x-highlight>
                                            @php
                                                echo e(<<<'BLADE'

                                                {!! $constructor->render()->webPage() !!}

                                                BLADE);
                                            @endphp
                                        </x-highlight>
                                    </div>

                                    <div class="">
                                        <div class="p-3 text-muted" style="background-color: #22272e;">
                                            <div class="text-white mb-1">[ Сайт(ы) ] Блоки</div>
                                            <div>- Для подключения содержимого, необходимо заменить "name" на "Ключ" блока.</div>
                                        </div>
                                        <x-highlight>
                                            @php
                                                echo e(<<<'BLADE'

                                                {!! $constructor->render()->webBlock('name') !!}

                                                BLADE);
                                            @endphp
                                        </x-highlight>
                                    </div>

                                    <div class="">
                                        <div class="p-3 text-muted" style="background-color: #22272e;">
                                            <div class="text-white mb-1">[ Сайт(ы) ] Переменные</div>
                                            <div>- Для подключения содержимого, необходимо заменить "name" на "Ключ" переменной.</div>
                                        </div>
                                        <x-highlight>
                                            @php
                                                echo e(<<<'BLADE'

                                                {!! $constructor->render()->webVariable('name') !!}

                                                BLADE);
                                            @endphp
                                        </x-highlight>
                                    </div>

                                    <div class="">
                                        <div class="p-3 text-muted" style="background-color: #22272e;">
                                            <div class="text-white mb-1">[ Сайт(ы) ] Хлебные крошки</div>
                                            <div>- Для подключения содержимого, необходимо заменить "name" на "Ключ" хлебной крошки.</div>
                                        </div>
                                        <x-highlight>
                                            @php
                                                echo e(<<<'BLADE'

                                                {!! $constructor->render()->webBreadcrumb('name') !!}

                                                BLADE);
                                            @endphp
                                        </x-highlight>
                                    </div>

                                    <div class="">
                                        <div class="p-3 text-muted" style="background-color: #22272e;">
                                            <div class="text-white mb-1">[ Сайт(ы) ] Пагинации</div>
                                            <div>- Для подключения содержимого, необходимо заменить "name" на "Ключ" пагинации. Вторым параметром необходимо передать переменную $collection ( База данных ), данную переменную генерирует модуль ( Переменная $collection доступна в разделе "Шаблоны" модулей ).</div>
                                        </div>
                                        <x-highlight>
                                            @php
                                                echo e(<<<'BLADE'

                                                {!! $constructor->render()->webPagination('name', $collection) !!}

                                                BLADE);
                                            @endphp
                                        </x-highlight>
                                    </div>

                                    <div class="">
                                        <div class="p-3 text-muted" style="background-color: #22272e;">
                                            <div class="text-white mb-1">[ Сайт(ы) ] Меню</div>
                                            <div>- Для подключения содержимого, необходимо заменить "name" на "Ключ" меню, а для выбора соответствующего шаблона используйте "templateName".</div>
                                        </div>
                                        <x-highlight>
                                            @php
                                                echo e(<<<'BLADE'

                                                {!! $constructor->render()->webMenu('name', 'templateName') !!}

                                                BLADE);
                                            @endphp
                                        </x-highlight>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
