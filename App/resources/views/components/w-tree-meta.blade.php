@props(['webSite', 'webPage'])

<div class="w-tree__item-content__meta">
    <a href="{{ route('web-sites.web-pages.show', ['webSite' => $webSite->id, 'webPage' => $webPage->id ]) }}" class="btn text-dark p-0">
        {{ $webPage->name }}
    </a>

    <a href="#" class="btn text-primary p-0">
        {{ $webPage->route }}
    </a>
</div>
