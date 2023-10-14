@props(['navigation'])

<ul class="nav nav-pills">
    @foreach($navigation as $nav)
        <li class="nav-item">
            @if(!isset($nav['isActive']) || !$nav['isActive'])
                <a class="nav-link" href="#" data-bs-toggle="pill" data-bs-target="#{{ $nav['id'] }}">
                    {{ $nav['title'] }}
                </a>
            @else
                <a class="nav-link active" href="#" data-bs-toggle="pill" data-bs-target="#{{ $nav['id'] }}">
                    {{ $nav['title'] }}
                </a>
            @endif
        </li>
    @endforeach
</ul>
