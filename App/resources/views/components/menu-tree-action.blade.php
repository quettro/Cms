@props(['webSite', 'webMenu', 'webMenuItem'])

<div
    class="w-tree__item-content__action"
>
    <a
        href="#"
        class="btn btn-link text-dark p-0 btn-open-or-hide-the-w-tree"
        title="Раскрыть/Скрыть дерево веб-страниц"
        data-is-active="true"
    >
        <i
            class="fa fa-level-down"
            aria-hidden="true"
        ></i>
    </a>

    <a
        href="#"
        class="btn btn-link text-dark p-0"
        title="Переместить"
        data-toggle="sortable-handle"
    >
        <i
            class="fa fa-arrows"
            aria-hidden="true"
        ></i>
    </a>

    @can('Cms:WebMenu:View')
        <a
            href="{{ route('web-sites.web-menu.web-menu-items.show', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id, 'webMenuItem' => $webMenuItem->id ]) }}"
            class="btn btn-link text-dark p-0"
            title="Перейти к просмотру"
        >
            <i
                class="fa fa-eye"
                aria-hidden="true"
            ></i>
        </a>
    @endcan

    @can('Cms:WebMenu:Create')
        <a
            href="{{ route('web-sites.web-menu.web-menu-items.create', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id, 'parent_id' => $webMenuItem->id ]) }}"
            class="btn btn-link text-dark p-0"
            title="Добавить дочерний элемент меню"
        >
            <i
                class="fa fa-plus"
                aria-hidden="true"
            ></i>
        </a>
    @endcan

    @can('Cms:WebMenu:Update')
        <a
            href="{{ route('web-sites.web-menu.web-menu-items.edit', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id, 'webMenuItem' => $webMenuItem->id ]) }}"
            class="btn btn-link text-primary p-0"
            title="Редактировать меню"
        >
            <i
                class="fa fa-pencil"
                aria-hidden="true"
            ></i>
        </a>
    @endcan

    @can('Cms:WebMenu:Delete')
        <x-form
            :action="route('web-sites.web-menu.web-menu-items.destroy', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id, 'webMenuItem' => $webMenuItem->id ])"

            class="js--form-delete"
        >
            @method('DELETE')

            <x-button
                class="btn-link text-danger p-0"
                title="Удалить меню"
            >
                <i
                    class="fa fa-trash"
                    aria-hidden="true"
                ></i>
            </x-button>
        </x-form>
    @endcan
</div>
