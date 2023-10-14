@props(['invalid' => false])

<input {{ $attributes->class(['form-control', 'is-invalid' => $invalid])->merge(['type' => 'text']) }}>
