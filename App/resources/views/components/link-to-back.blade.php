@props(['action' => NULL, 'disabled' => false ])

<x-form method="GET" :action="$action" :csrf="false">
    {{ $slot }}

    <button type="submit" {{ $attributes->merge(['class' => 'btn btn-link py-0']) }} @if($disabled) disabled="" @endif>
        Назад
    </button>
</x-form>
