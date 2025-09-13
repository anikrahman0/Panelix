<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="description" content="{{ $description ?? config('admin.meta.description') }}">
<meta name="author" content="{{ $author ?? config('admin.meta.author') }}">
<meta name="developer" content="{{ $developer ?? config('admin.meta.developer') }}">
<meta name="contact" content="{{ $contact ?? config('admin.meta.contact') }}">
<meta name="copyright" content="Copyright (c) {{ now()->year }}. All Rights &reg; Reserved by {{ $copyright ?? config('admin.meta.copyright') }}.">

<meta name="robots" content="{{ $robots ?? config('admin.meta.robots') }}">
<meta name="googlebot" content="{{ $googlebot ?? config('admin.meta.googlebot') }}">
<meta name="googlebot-news" content="{{ $googlebotNews ?? config('admin.meta.googlebot_news') }}">
<meta name="msnbot" content="{{ $msnbot ?? config('admin.meta.msnbot') }}">
