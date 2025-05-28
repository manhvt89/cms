<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CommonModel;
use App\Models\NewsModel;
use CodeIgniter\I18n\Time;

class Category extends BaseController
{
    
    public function index($slug = null)
    {
        
        $categoryModel = new CategoryModel();
        $commonModel = new CommonModel();
        $newsModel = new NewsModel();
        
        
        if (!$categoryModel->category_check($slug)) {
            return redirect()->to(base_url());
        }
        $all_categories = $commonModel->all_categories();
        $news = $newsModel->all_news();
        $category          = $categoryModel->category_by_slug($slug);
        $id = $category['category_id'];
        $data = [
            'meta_title' => $category['meta_title'],
            'meta_description' => $category['meta_description'],
            'meta_keywords' => $category['meta_keyword'],
            'title'             => 'Danh mục',
            'category'          => $category,
            'news_by_category'  => $categoryModel->all_news_by_category_id($id),
        ];
        $data['setting'] = $commonModel->all_setting();

        $sidebar_items = [
            'search_form' => [
                'action_url' => base_url('search')
            ],
            'categories' => [
                'items' => $all_categories
            ],
            'recent_posts' => [
                'items' => $news,
                'count' => $data['setting']['sidebar_total_recent_post']
            ],
        ];

        $data['sidebar_items'] = $sidebar_items;

        return $this->render('pages/category', $data);
        
    }
}
