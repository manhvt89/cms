<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class PageCacheFilter implements FilterInterface
{
    protected array $excludedPaths = [
        'admin',
        'admin/*',
        'api',
        'api/*',
        'search',
        'search/*',
    ];

    protected function isExcluded(RequestInterface $request): bool
    {
        $path = trim($request->getPath(), '/');
        foreach ($this->excludedPaths as $pattern) {
            $pattern = str_replace('*', '.*', str_replace('/', '\/', trim($pattern, '/')));
            if (preg_match('/^' . $pattern . '$/i', $path)) {
                return true;
            }
        }
        return false;
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        if ($this->isExcluded($request)) {
            return null;
        }

        $cache = Services::cache();
        $key = 'page_cache_' . md5(current_url(true));

        if ($html = $cache->get($key)) {
            return Services::response()
                ->setStatusCode(200)
                ->setHeader('Content-Type', 'text/html; charset=UTF-8')
                ->setBody($html);
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if ($this->isExcluded($request)) {
            return;
        }

        $cache = Services::cache();
        $key = 'page_cache_' . md5(current_url(true));

        if ($response->getStatusCode() === 200 &&
            $response->getHeaderLine('Content-Type') === 'text/html; charset=UTF-8') {

            $html = $response->getBody();
            $html .= "\n<!-- cached at " . date('Y-m-d H:i:s') . " -->";
            $cache->save($key, $html, 300);
        }
    }
}
