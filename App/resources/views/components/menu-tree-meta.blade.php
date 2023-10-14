@props(['webSite', 'webMenu', 'webMenuItem'])

<div
    class="w-tree__item-content__meta"
>
    <a
        href="{{ route('web-sites.web-menu.web-menu-items.show', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id, 'webMenuItem' => $webMenuItem->id ]) }}"
        class="btn btn-link text-dark p-0"
    >
        <div class="container">
            @foreach($webMenuItem->languages as $language)
                <div class="">
                    <div class="text-start">
                        {{ $language->name }}
                    </div>
                </div>
            @endforeach
        </div>
    </a>

    <a
        href="#"
        class="btn btn-link text-primary p-0"
    >
        <div class="container">
            @foreach($webMenuItem->languages as $language)
                <div class="">
                    <div class="text-start">
                        {{ $language->route }}
                    </div>
                </div>
            @endforeach
        </div>
    </a>
</div>
