@props(['invalid' => false, 'value' => $slot])

<textarea {{ $attributes->class(['form-control', 'is-invalid' => $invalid]) }}>{{ $value }}</textarea>
