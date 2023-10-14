@props(['action', 'permission', 'disabled' => false, 'form' => true])

@cannot($permission)
    @php
        $disabled = true;
    @endphp
@endcannot

@if(!$form)
    <a href="{{ $disabled ? 'javascript:void(0)' : $action }}" class="">
        Просмотр
    </a>
@else
    <x-form method="GET" :action="$action" :csrf="false">
        {{ $slot }}

        <button type="submit" {{ $attributes->merge(['class' => 'btn btn-link py-0']) }} @if($disabled) disabled="" @endif>
            Просмотр
        </button>
    </x-form>
@endif
