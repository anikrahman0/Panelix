<?php

namespace App\Library;

class CacheHelper{
    public static function forget(string $key): void
    {
        cache()->forget($key);
    }

    public static function remember(string $key, $ttl, \Closure $callback)
    {
        return cache()->remember($key, $ttl, $callback);
    }

    public static function cacheForever(string $key, \Closure $callback)
    {
        return cache()->rememberForever($key, $callback);
    }
}