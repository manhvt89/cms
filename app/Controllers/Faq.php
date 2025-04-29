<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCommon;
use App\Models\ModelPortfolio;
use App\Models\ModelFaq;
class Faq extends BaseController
{
    protected $modelCommon;
    protected $modelPortfolio;
    protected $modelFaq;

    public function __construct()
    {
        $this->modelCommon = new ModelCommon();
        $this->modelPortfolio = new ModelPortfolio();
        $this->modelFaq = new ModelFaq();
    }
    public function index()
    {
		
		$page_about = $this->modelCommon->all_page_about();
		//var_dump($this->modelCommon->all_footer_setting(5));die();
        $data = [
            'meta_title' => $page_about['mt_about'],
            'meta_description' => $page_about['md_about'],
            'meta_keywords' => $page_about['mk_about'],
            'page_about' => $page_about,
            // Thêm các biến khác cần thiết
        ];
        
        
        
        $data['setting'] = $this->modelCommon->all_setting();
		$data['page_faq'] = $this->modelCommon->all_page_faq();
		$data['comment'] = $this->modelCommon->all_comment();
		
		$data['all_news'] = $this->modelCommon->all_news();

		$data['faqs'] = $this->modelFaq->all_faq();
		$data['portfolio_footer'] = $this->modelPortfolio->get_portfolio_data(); 
		return $this->render('pages/faq', $data);
		/*
		$output  = view('view_header', $data);
		$output .= view('view_about', $data);
		$output .= view('view_footer', $data);
		return $output;
		*/
    }
}