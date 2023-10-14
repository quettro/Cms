@props(['invalid' => false, 'option' => [], 'o_selected' => [], 'o_disabled' => []])

@php
    use Illuminate\Support\Arr;

    $o_selected = !empty($o_selected) ? Arr::whereNotNull($o_selected) : $o_selected;
    $o_disabled = !empty($o_disabled) ? Arr::whereNotNull($o_disabled) : $o_disabled;
@endphp

<select {{ $attributes->class(['form-select', 'is-invalid' => $invalid]) }}>
    <x-option>{{ __('Не выбрано') }}</x-option>

    @if ($option)
        @foreach ($option as $value => $label)
            <x-option :value="$value" :selected="$o_selected && in_array($value, array_values($o_selected))" :disabled="$o_disabled && in_array($value, $o_disabled)">{{ $label }}</x-option>
        @endforeach
    @endif
</select>
