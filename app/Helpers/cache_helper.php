<?php

use Config\Services;

/**
 * Cache thông minh – giống Laravel's remember()
 */
if (!function_exists('cache_remember')) {
    function cache_remember(string $key, int $ttl, Closure $callback)
    {
        $cache = Services::cache();

        if (!$data = $cache->get($key)) {
            $data = $callback();
            $cache->save($key, $data, $ttl);
        }

        return $data;
    }
}
