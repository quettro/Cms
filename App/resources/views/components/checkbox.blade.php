@props(['invalid' => false, 'value' => 1, 'checked' => 0])

@php $checked = filter_var($checked, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE); @endphp

<div class="form-check">
    <input {{ $attributes->class(['form-check-input', 'is-invalid' => $invalid])->merge(['type' => 'checkbox', 'value' => $value, 'checked' => $checked]) }}>
    <label class="form-check-label" for="{{ $attributes->get('id') }}">{{ $slot }}</label>
</div>
