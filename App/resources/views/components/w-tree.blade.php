@props(['root', 'webSite', 'webPages'])

<ul @class(['w-tree', 'w-tree--root' => $root])>
    @if($webPages->isEmpty())
        @if($root)
            <li class="w-tree__item">
                <div class="w-tree__item-content">
                    На данный момент не найдено ни одной созданной страницы.
                </div>
            </li>
        @endif
    @else
        @foreach($webPages as $webPage)
            <li class="w-tree__item">
                <div class="d-flex flex-column-reverse">
                    @if($webPage->children->count())
                        <x-w-tree :root="false" :webSite="$webSite" :webPages="$webPage->children"></x-w-tree>
                    @endif

                    <div class="w-tree__item-content">
                        <div class="w-tree__item-content__st">
                            <x-w-tree-checkbox :webPage="$webPage"></x-w-tree-checkbox>
                            <x-w-tree-meta :webSite="$webSite" :webPage="$webPage"></x-w-tree-meta>
                        </div>

                        <div class="w-tree__item-content__en">
                            <x-w-tree-action :webSite="$webSite" :webPage="$webPage"></x-w-tree-action>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    @endif
</ul>
