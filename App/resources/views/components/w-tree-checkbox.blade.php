@props(['webPage'])

<div
    class="w-tree__item-content__checkbox"
>
    <div
        class="form-check"
    >
        <input
            type="checkbox"
            class="form-check-input"
            id="w-tree--checked-{{ $webPage->id }}"
            name="checked[]"
            value="{{ $webPage->id }}">

        <label class="form-check-label" for="w-tree--checked-{{ $webPage->id }}"></label>
    </div>
</div>
