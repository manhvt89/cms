<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCommon;
use App\Models\PortfolioModel;
class Term extends BaseController
{
    protected $modelCommon;
    protected $modelPortfolio;

    public function __construct()
    {
        $this->modelCommon = new ModelCommon();
        $this->modelPortfolio = new PortfolioModel();
    }
    public function index()
    {
		
		$page_term = $this->modelCommon->all_page_term();
		//var_dump($this->modelCommon->all_footer_setting(5));die();
        $data = [
            'meta_title' => $page_term['mt'],
            'meta_description' => $page_term['md'],
            'meta_keywords' => $page_term['mk'],
            'page_about' => $page_term,
            // Thêm các biến khác cần thiết
        ];
        
        $data['term'] = $page_term;
        $data['comment'] = $this->modelCommon->all_comment();
        $data['social'] = $this->modelCommon->all_social();
        $data['all_news'] = $this->modelCommon->all_news();
		
        $data['portfolio_footer'] = $this->modelPortfolio->get_portfolio_data();
		return $this->render('pages/term', $data);
		
    }
}