<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCommon;
use App\Models\PortfolioModel;
class Privacy extends BaseController
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
		$page_about = $this->modelCommon->all_page_privacy();
		//var_dump($this->modelCommon->all_footer_setting(5));die();
        $data = [
            'meta_title' => $page_about['mt'],
            'meta_description' => $page_about['md'],
            'meta_keywords' => $page_about['mk'],
            'page_about' => $page_about,
            // Thêm các biến khác cần thiết
        ];
        
        $data['privacy'] = $page_about;
        $data['comment'] = $this->modelCommon->all_comment();
        $data['social'] = $this->modelCommon->all_social();
        $data['all_news'] = $this->modelCommon->all_news();
        $data['portfolio_footer'] = $this->modelPortfolio->get_portfolio_data();
		return $this->render('pages/privacy', $data);
		
    }
}