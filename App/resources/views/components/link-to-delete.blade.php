@props(['action', 'permission', 'disabled' => false ])

@cannot($permission)
    @php
        $disabled = true;
    @endphp
@endcannot

<x-form :action="$action" class="js--form-delete"> @method('DELETE')
    {{ $slot }}

    <button type="submit" {{ $attributes->merge(['class' => 'btn btn-link text-danger py-0']) }} @if($disabled) disabled="" @endif>
        Удалить
    </button>
</x-form>
