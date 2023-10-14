@props(['root', 'webSite', 'webMenu', 'webMenuItems'])

<ul @class(['w-tree', 'w-tree--root' => $root]) data-toggle="sortable" data-type="ol" data-save-to="{{ route('web-sites.web-menu.web-menu-items.position', ['webSite' => $webSite->id, 'webMenu' => $webMenu->id]) }}">
    @if($webMenuItems->isEmpty())
        @if($root)
            <li class="w-tree__item">
                <div class="w-tree__item-content">
                    На данный момент не найдено ни одного элемента меню.
                </div>
            </li>
        @endif
    @else
        @foreach($webMenuItems as $webMenuItem)
            <li class="w-tree__item" data-id="{{ $webMenuItem->id }}">
                <div class="d-flex flex-column-reverse">
                    @if($webMenuItem->children->count())
                        <x-menu-tree
                            :root="false"
                            :webSite="$webSite"
                            :webMenu="$webMenu"
                            :webMenuItems="$webMenuItem->children"
                        />
                    @endif

                    <div class="w-tree__item-content">
                        <div class="w-tree__item-content__st">
                            <x-menu-tree-meta
                                :webSite="$webSite"
                                :webMenu="$webMenu"
                                :webMenuItem="$webMenuItem"
                            />
                        </div>

                        <div class="w-tree__item-content__en">
                            <x-menu-tree-action
                                :webSite="$webSite"
                                :webMenu="$webMenu"
                                :webMenuItem="$webMenuItem"
                            />
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    @endif
</ul>
