@props(['value', 'invalid' => false])

<div @class(['codeMirror', 'is-invalid' => $invalid])>
    <textarea {!! $attributes->class(['codeMirror-textarea', 'is-invalid' => $invalid]) !!}>{{ $value }}</textarea>

    <x-codemirror-nav></x-codemirror-nav>
</div>
