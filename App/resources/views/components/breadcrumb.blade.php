@props(['navigation'])

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($navigation as $nav)
            @if($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $nav['name'] }}</li>
            @else
                <li class="breadcrumb-item"><x-a :href="$nav['href']">{{ $nav['name'] }}</x-a></li>
            @endif
        @endforeach
    </ol>
</nav>
