@props(['action', 'permission', 'disabled' => false ])

@cannot($permission)
    @php
        $disabled = true;
    @endphp
@endcannot

<x-form method="GET" :action="$action" :csrf="false">
    <button type="submit" {{ $attributes->merge(['class' => 'btn btn-link py-0']) }} @if($disabled) disabled="" @endif>
        {{ $slot }}
    </button>
</x-form>
