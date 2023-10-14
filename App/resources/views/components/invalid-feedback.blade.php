@props(['messages'])

@if ($messages)
    @if (is_string($messages))
        @php($messages = [$messages])
    @endif

    <div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>
        @foreach (\Illuminate\Support\Arr::flatten($messages) as $message)
            <div class="invalid-feedback__message">{{ $message }}</div>
        @endforeach
    </div>
@endif
