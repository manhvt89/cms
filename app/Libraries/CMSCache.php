<?php

namespace App\Libraries;

use Config\Services;

class CMSCache
{
    public static function get(string $key, int $ttl, callable $callback)
    {
        $cache = Services::cache();

        if (!$data = $cache->get($key)) {
            $data = $callback();
            $cache->save($key, $data, $ttl);
        }

        return $data;
    }
}
