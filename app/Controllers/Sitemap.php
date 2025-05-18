<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\PageModel;

class Sitemap extends BaseController
{
    protected $perPage = 10000;

    public function index()
    {
        
        $types = ['news', 'category', 'product'];
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($types as $type) {
            $total = $this->getModel($type)->countAllResults();
            $pages = ceil($total / $this->perPage);

            for ($i = 1; $i <= $pages; $i++) {
                $xml .= "  <sitemap>\n";
                $xml .= "    <loc>" . base_url("sitemap/{$type}/{$i}") . "</loc>\n";
                $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
                $xml .= "  </sitemap>\n";
            }
        }

        if(ENVIRONMENT != 'development')
        {
            $this->pingGoogleSitemap();
        }

        $xml .= '</sitemapindex>';

        return $this->response->setHeader('Content-Type', 'application/xml')->setBody($xml);
    }

    public function generate($type, $page = 1)
    {
        $model = $this->getModel($type);
        $offset = ($page - 1) * $this->perPage;
        $items = $model->orderBy('updated_at', 'DESC')->findAll($this->perPage, $offset);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        foreach ($items as $item) {
            $slug = $item['slug'] ?? '';
            $lastmod = $item['updated_at'] ?? $item['created_at'] ?? date('Y-m-d');
            $loc = $this->generateUrl($type, $slug);

            $xml .= "  <url>\n";
            $xml .= "    <loc>{$loc}</loc>\n";
            $xml .= "    <lastmod>" . date('Y-m-d', strtotime($lastmod)) . "</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.8</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return $this->response->setHeader('Content-Type', 'application/xml')->setBody($xml);
    }

    private function getModel($type)
    {
        return match ($type) {
            'news'     => new NewsModel(),
            'category' => new CategoryModel(),
            'product'  => new ProductModel(),
            'page'     => new PageModel(),
            default    => throw new \Exception('Invalid sitemap type'),
        };
    }

    private function generateUrl($type, $slug)
    {
        return match ($type) {
            'news'     => base_url($slug), // domain.com/slug
            'category' => base_url('category/' . $slug),
            'product'  => base_url('product/' . $slug),
            'page'     => base_url('page/' . $slug),
        };
    }



    // Hàm gửi ping tới Google
    private function pingGoogleSitemap()
    {
        $googlePingUrl = "https://www.google.com/ping?sitemap=" . base_url('sitemap.xml');

        // Gửi request HTTP tới Google để thông báo về sitemap
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $googlePingUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $response = curl_exec($ch);
        curl_close($ch);

        // Kiểm tra phản hồi từ Google (tùy chọn)
        if ($response === false) {
            log_message('error', 'Ping Google Sitemap failed!');
        } else {
            log_message('info', 'Google Sitemap ping successful!');
        }
    }
}
