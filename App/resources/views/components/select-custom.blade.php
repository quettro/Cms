@props(['invalid' => false])

<select {{ $attributes->class(['form-select', 'is-invalid' => $invalid]) }}>{{ $slot }}</select>
