@props(['messages' => (string) $slot])

@if ($messages)
    @if (is_string($messages))
        @php($messages = [$messages])
    @endif

    <div {{ $attributes->merge(['class' => 'mt-1 text-muted']) }}>
        @foreach (\Illuminate\Support\Arr::flatten($messages) as $message)
            <div class="small text-muted">{!! $message !!}</div>
        @endforeach
    </div>
@endif
