<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="description" content="{{ $description ?? config('panelix.meta.description') }}">
<meta name="author" content="{{ $author ?? config('panelix.meta.author') }}">
<meta name="developer" content="{{ $developer ?? config('panelix.meta.developer') }}">
<meta name="contact" content="{{ $contact ?? config('panelix.meta.contact') }}">
<meta name="copyright" content="Copyright (c) {{ now()->year }}. All Rights &reg; Reserved by {{ $copyright ?? config('panelix.meta.copyright') }}.">

<meta name="robots" content="{{ $robots ?? config('panelix.meta.robots') }}">
<meta name="googlebot" content="{{ $googlebot ?? config('panelix.meta.googlebot') }}">
<meta name="googlebot-news" content="{{ $googlebotNews ?? config('panelix.meta.googlebot_news') }}">
<meta name="msnbot" content="{{ $msnbot ?? config('panelix.meta.msnbot') }}">
