@if(session()->has('form:submitted') && session()->get('form:submitted') === 'true'){{ $slot }}@endif
