<meta name="description" content="{{ $product->meta_description ?? Str::limit(strip_tags($product->description), 300, '') }}">
<meta name="keywords" content="{{ $product->meta_keywords }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
<meta property="og:title" content="{{ $product->product_name }}">
<meta property="og:description" content="{{ $product->meta_description ?? Str::limit(strip_tags($product->description), 300, '') }}">
<meta property="og:url" content="{{ route('product-details', $product->slug) }}">
<meta property="og:type" content="article">

<meta property="og:image" content="{{ $product->images && $product->images->first()?->image_url ? asset($product->images->first()->image_url) : asset('web_assets/images/logo/footer-logo.png') }}">
<meta property="og:locale" content="en_US">

<meta name="twitter:domain" content="{{ url('/') }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="integmeds.com">
<meta name="twitter:title" content="{{ $product->product_name }}">
<meta name="twitter:description" content="{{ $product->meta_description ?? Str::limit(strip_tags($product->description), 300, '') }}">
<meta name="twitter:url" content="{{ route('product-details', $product->slug) }}">
<meta name="twitter:image" content="{{ $product->product_gallery && $product->product_gallery->first()?->img_path ? asset('media/uploads/products/' . $product->product_gallery->first()->img_path) : asset('web_assets/images/logo/footer-logo.png') }}">
<meta name="twitter:site" content="@integmeds">
<meta name="twitter:creator" content="@integmeds">
<link rel="image_src" href="{{ $product->images && $product->images->first()?->image_url ? asset($product->images->first()->image_url) : asset('web_assets/images/logo/footer-logo.png') }}">
<link rel="canonical" href="{{ route('product-details', $product->slug) }}">