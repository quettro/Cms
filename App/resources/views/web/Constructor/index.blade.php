<!DOCTYPE html>
<html lang="{{ $constructor->language->codename }}">
    <head>
        <meta charset="{{ $constructor->webSite->charset }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $constructor->seo()->title() }}</title>

        <meta name="description" content="{{ $constructor->seo()->description() }}">
        <meta name="keywords" content="{{ $constructor->seo()->keyword() }}">

        <meta property="og:title" content="{{ $constructor->seo()->ogTitle() }}">
        <meta property="og:description" content="{{ $constructor->seo()->ogDescription() }}">
        <meta property="og:image" content="{{ $constructor->seo()->ogImage() }}">

        {!! $constructor->webSite->head !!}

        @include('web.Constructor._resources_h')

        {!! $constructor->webPageLanguageVersion->additional_head !!}
    </head>
    <body>
        {!! $constructor->render() !!}

        @include('web.Constructor._resources_b')

        {!! $constructor->webSite->body !!}
        {!! $constructor->webPageLanguageVersion->additional_body !!}
    </body>
</html>
