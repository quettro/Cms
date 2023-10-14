@foreach($constructor->resources as $resource)
    @if(!$resource->isPositionHead())
        @continue
    @endif

    @if($resource->isExtensionCss())
        <link rel="stylesheet" href="{{ $resource->file?->link() }}">
    @else
        @if($resource->isExtensionJavascript())
            <script type="text/javascript" src="{{ $resource->file?->link() }}"></script>
        @endif
    @endif
@endforeach
