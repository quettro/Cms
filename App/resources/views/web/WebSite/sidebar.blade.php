<x-slot:sidebar>
    <aside class="sidebar">
        <div class="p-3">
            <ul class="sidebar-menu">
                <li class="sidebar-menu__item">
                    <div class="sidebar-menu__title">
                        <div class="mb-1">{{ $webSite->name }}</div>
                        <div class="mb-0">{{ $webSite->domain }}</div>
                    </div>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.show', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.show', $webSite->id) or request()->routeIs('web-sites.edit', $webSite->id)])>
                        Настройки
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.copy.index', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.copy.*', $webSite->id)])>
                        Копировать сайт
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.web-pages.index', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.web-pages.*', $webSite->id)])>
                        Страницы
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.web-variables.index', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.web-variables.*', $webSite->id)])>
                        Переменные
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.web-robber.index', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.web-robber.*', $webSite->id)])>
                        Парсинг
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <div class="sidebar-menu__title">
                        Дополнительно
                    </div>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.code.index', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.code.*', $webSite->id)])>
                        Код
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.web-resources.index', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.web-resources.*', $webSite->id)])>
                        Ресурсы
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <div class="sidebar-menu__title">
                        Шаблоны
                    </div>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.web-blocks.index', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.web-blocks.*', $webSite->id)])>
                        Блоки
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.web-page-templates.index', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.web-page-templates.*', $webSite->id)])>
                        Шаблоны страниц
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.web-breadcrumbs.index', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.web-breadcrumbs.*', $webSite->id)])>
                        Хлебные крошки
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.web-menu.index', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.web-menu.*', $webSite->id)])>
                        Меню
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('web-sites.web-paginations.index', $webSite->id)" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.web-paginations.*', $webSite->id)])>
                        Пагинации
                    </x-a>
                </li>

                <li class="sidebar-menu__item">
                    <div class="sidebar-menu__title">
                        Вернуться
                    </div>
                </li>

                <li class="sidebar-menu__item">
                    <x-a :href="route('dashboard')" @class(['sidebar-menu__link', '--active' => request()->routeIs('dashboard')])>
                        Панель управления
                    </x-a>
                </li>
            </ul>
        </div>
    </aside>
</x-slot:sidebar>
