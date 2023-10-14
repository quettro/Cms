<aside class="sidebar">
    <div class="p-3">
        <ul class="sidebar-menu">
            <li class="sidebar-menu__item">
                <div class="sidebar-menu__title">
                    Общее
                </div>
            </li>

            <li class="sidebar-menu__item">
                <x-a :href="route('languages.index')" @class(['sidebar-menu__link', '--active' => request()->routeIs('languages.*')])>
                    Языки
                </x-a>
            </li>

            <li class="sidebar-menu__item">
                <x-a :href="route('users.index')" @class(['sidebar-menu__link', '--active' => request()->routeIs('users.*')])>
                    Пользователи
                </x-a>
            </li>

            <li class="sidebar-menu__item">
                <x-a :href="route('user-history.index')" @class(['sidebar-menu__link', '--active' => request()->routeIs('user-history.*')])>
                    История пользователей
                </x-a>
            </li>

            <li class="sidebar-menu__item">
                <x-a :href="route('file-management.index')" @class(['sidebar-menu__link', '--active' => request()->routeIs('file-management.*')])>
                    Файловый менеджер
                </x-a>
            </li>

            <li class="sidebar-menu__item">
                <x-a :href="route('modules.index')" @class(['sidebar-menu__link', '--active' => request()->routeIs('modules.*')])>
                    Модули
                </x-a>
            </li>

            <li class="sidebar-menu__item">
                <x-a :href="route('blocks.index')" @class(['sidebar-menu__link', '--active' => request()->routeIs('blocks.*')])>
                    Блоки
                </x-a>
            </li>

            <li class="sidebar-menu__item">
                <div class="sidebar-menu__title">
                    Формы
                </div>
            </li>

            <li class="sidebar-menu__item">
                <x-a :href="route('forms.index')" @class(['sidebar-menu__link', '--active' => request()->routeIs('forms.*')])>
                    Формы
                </x-a>
            </li>

            <li class="sidebar-menu__item">
                <x-a :href="route('inputs.index')" @class(['sidebar-menu__link', '--active' => request()->routeIs('inputs.*')])>
                    Поля форм
                </x-a>
            </li>

            <li class="sidebar-menu__item">
                <div class="sidebar-menu__title">
                    Веб
                </div>
            </li>

            <li class="sidebar-menu__item">
                <x-a :href="route('web-sites.index')" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-sites.*')])>
                    Сайты
                </x-a>
            </li>

            <li class="sidebar-menu__item">
                <x-a :href="route('resources.index')" @class(['sidebar-menu__link', '--active' => request()->routeIs('resources.*')])>
                    Ресурсы
                </x-a>
            </li>

            <li class="sidebar-menu__item">
                <x-a :href="route('web-data.index')" @class(['sidebar-menu__link', '--active' => request()->routeIs('web-data.*')])>
                    Веб-данные
                </x-a>
            </li>
        </ul>
    </div>
</aside>
