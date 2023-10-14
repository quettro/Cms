@props(['csrf' => true])

<form {{ $attributes->merge(['method' => 'POST']) }}>@if($csrf) @csrf @endif {{ $slot }}</form>
