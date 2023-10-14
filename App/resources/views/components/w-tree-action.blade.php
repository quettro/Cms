@props(['webSite', 'webPage'])

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

    @can('Cms:WebPage:View')
        <a
            href="{{ route('web-sites.web-pages.show', ['webSite' => $webSite->id, 'webPage' => $webPage->id ]) }}"
            class="btn btn-link text-dark p-0"
            title="Перейти к просмотру"
        >
            <i
                class="fa fa-eye"
                aria-hidden="true"
            ></i>
        </a>
    @endcan

    @can('Cms:WebPage:Create')
        <a
            href="{{ route('web-sites.web-pages.create', ['webSite' => $webSite->id, 'parent_id' => $webPage->id ]) }}"
            class="btn btn-link text-dark p-0"
            title="Добавить дочернюю веб-страницу"
        >
            <i
                class="fa fa-plus"
                aria-hidden="true"
            ></i>
        </a>
    @endcan

    @can('Cms:WebPage:Update')
        <a
            href="{{ route('web-sites.web-pages.edit', ['webSite' => $webSite->id, 'webPage' => $webPage->id ]) }}"
            class="btn btn-link text-primary p-0"
            title="Редактировать веб-страницу"
        >
            <i
                class="fa fa-pencil"
                aria-hidden="true"
            ></i>
        </a>
    @endcan

    @can('Cms:WebPage:Delete')
        <x-form
            :action="route('web-sites.web-pages.destroy', ['webSite' => $webSite->id, 'webPage' => $webPage->id ])"

            class="js--form-delete"
        >
            @method('DELETE')

            <x-button
                class="btn-link text-danger p-0"
                title="Удалить веб-страницу"
            >
                <i
                    class="fa fa-trash"
                    aria-hidden="true"
                ></i>
            </x-button>
        </x-form>
    @endcan
</div>
