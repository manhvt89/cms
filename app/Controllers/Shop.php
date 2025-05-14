<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommonModel;
use App\Models\ShopModel;
use App\Models\NewsModel;

use ci4shoppingcart\Libraries\Cart;
class Shop extends BaseController
{
    protected $commonModel;
    protected $newsModel;

    protected $shopModel;
    protected $sidebar_items = [];
    protected $cart;
    public function __construct()
    {
        helper('transform');
        $this->commonModel    = new CommonModel();
        
        $this->newsModel   = new NewsModel();

        $this->shopModel = new ShopModel();

        $this->cart = new Cart();

        $page = $this->commonModel->all_page_news();
        $data = $this->data ?? [];
        $data['setting'] = $this->commonModel->all_setting();
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

    public function cart()
    {
        $data                  = $this->data;
        $data['cart_contents'] = $this->cart->contents();
        return $this->render('pages/cart', $data);
    }
    public function index($page = 1): string
    {
        $page = $this->request->getGet('page')??0;
        $modelNews = $this->newsModel;
        $data = [];
		$data = array_merge($data,$this->data);
        
		$data['news'] = $modelNews->all_news();

        $perPage = 10;
        $offset = ($page > 0) ? ($page - 1) * $perPage : 0;

        $total = $this->shopModel->get_total_product();
        $data['get_all_product'] = $this->shopModel->get_all_product_pagi($perPage, $offset);

        $pager = \Config\Services::pager();
        //$data['links'] = $pager->makeLinks($page, $perPage, $total, 'default_full');                          
        $data['links'] = $pager->makeLinks($page, $perPage, $total, 'my_pager_template');
        $all_categories = $this->commonModel->all_categories();
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

        return $this->render('pages/product',$data);

    }

    

	public function view($slug=null)
	{
       
        if (preg_match('/-(\d+)$/', $slug, $matches)) {
            $id = $matches[1];
            
            
            

            $modelCommon = new CommonModel();
            $modelNews = new NewsModel();

            if( !isset($id) || !is_numeric($id) ) {
                redirect()->to(base_url());
            }

            $_aProduct = $this->shopModel->get_single_product($id);
            if(!$_aProduct) {
                redirect()->to(base_url());
            }

            //var_dump($_aProduct);die();
            $data = array_merge([],$this->data); // define $data
            $data['get_single_product'] = $_aProduct;
            $data['get_all_category']   = $this->shopModel->get_all_category();
            
            $news_detail = $modelNews->news_detail_with_category($id);
            $meta_title = $_aProduct['product_title'];
            $meta_description = $_aProduct['product_short_description'];
            $meta_keywords = $_aProduct['product_keyword'];
            $data['meta_title'] = $meta_title;
            $data['meta_description'] = $meta_description;
            $data['meta_keywords'] = $meta_keywords;
            
            //-------- Sidebar Data -------------

            $data['news_detail'] = transform_the_news($news_detail);
            $data['comment'] = $modelCommon->all_comment();
            //$data['all_news'] = $modelCommon->all_news();
            $all_categories = $modelCommon->all_categories();
            $news = $modelNews->all_news();
            
            $data['category'] = $modelNews->get_category_name_by_id($news_detail['category_id']);
            $data['category_name'] = $data['category']['category_name'];
            $data['id'] = $id;

            $data['categories'] = $modelNews->all_categories();
            //$data['portfolio_footer'] = $modelPortfolio->get_portfolio_data();

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
            
            //End sidebar Data

            $data['sidebar_items'] = $sidebar_items;
            //var_dump($data['sidebar_items']);die();
            //$this->load->view('web/pages/single', $data);
            return $this->render('pages/single',$data);
        }
        
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

	}
}
