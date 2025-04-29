<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommonModel;
use App\Models\PortfolioModel;
use App\Models\NewsModel;
class News extends BaseController
{
    protected $common;
    protected $news;
    protected $sidebar_items = [];
    public function __construct()
    {
        $this->common    = new CommonModel();
        
        $this->news   = new NewsModel();
        $page = $this->common->all_page_news();
        $data = $this->data ?? [];
        $data['setting'] = $this->common->all_setting();
        $data['page_news'] = $page;
        $this->data = array_merge($data,[
                                                'meta_title' => $page['mt'],
                                                'meta_description' => $page['md'],
                                                'meta_keywords' => $page['mk'],           
                                                ]);
        $this->sidebar_items = [
            'search_form' => [
                'action_url' => base_url('search')
            ],
            'categories' => [
                'items' => []
            ],
            'recent_posts' => [
                'items' => [],
                'setting' => []
            ],
        ];
                                                
    }
    public function index($page = 1): string
    {
        
        
        $modelNews = $this->news;
        $data = [];
		$data = array_merge($data,$this->data);
        
		$data['news'] = $modelNews->all_news();

        $perPage = 10;
        $offset = ($page > 0) ? ($page - 1) * $perPage : 0;

        $total = $modelNews->get_total_news();
        $data['news_fetched'] = $modelNews->fetch_news($perPage, $offset);

        $pager = \Config\Services::pager();
        $data['links'] = $pager->makeLinks($page, $perPage, $total, 'default_full');                          
        
        $all_categories = $this->common->all_categories();
        $news = $data['news'];
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
        return $this->render('pages/news',$data);

    }

    

	public function view($slug=null)
	{
        if (preg_match('/-(\d+)$/', $slug, $matches)) {
            $id = $matches[1];
            $modelCommon = new CommonModel();
            $modelNews = new NewsModel();
            $modelPortfolio = new PortfolioModel();
            if( !isset($id) || !is_numeric($id) ) {
                redirect()->to(base_url());
            }

            $tot = $modelNews->news_check($id);
            if(!$tot) {
                redirect()->to(base_url());
            }
            $data = array_merge([],$this->data);
            $news_detail = $modelNews->news_detail_with_category($id);
            $meta_title = $news_detail['mt'] !="" ? $news_detail['mt'] : $news_detail['news_title'];
            $meta_description = $news_detail['md'] == ""? $news_detail['md'] : $news_detail['news_content_short'];
            $data['meta_title'] = $meta_title;
            $data['meta_description'] = $meta_description;
            $data['meta_keywords'] = $news_detail['mk'];
            //var_dump($news_detail);die();

            $data['news_detail'] = $news_detail;
            $data['comment'] = $modelCommon->all_comment();
            //$data['all_news'] = $modelCommon->all_news();
            $all_categories = $modelCommon->all_categories();
            $news = $modelNews->all_news();
            
            $data['category'] = $modelNews->get_category_name_by_id($news_detail['category_id']);
            $data['category_name'] = $data['category']['category_name'];
            $data['id'] = $id;

            //$data['categories'] = $modelNews->all_categories();
            $data['portfolio_footer'] = $modelPortfolio->get_portfolio_data();

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
            //var_dump($data['sidebar_items']);die();
            
            return $this->render('pages/news_detail',$data);
        }
        
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

	}
}
