<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCommon;
use App\Models\PortfolioModel;
use App\Models\ModelHome;
class Home extends BaseController
{
    protected $helpers = ['slider'];
	public function index(): string
    {
        
        $modelCommon = new ModelCommon();
        $modelHome = new ModelHome();
        $modelPortfolio = new PortfolioModel();
        $data = [];
		$page_home = $modelCommon->all_page_home();
		
        $data = [
            'meta_title' => $page_home['title'],
            'meta_description' => $page_home['meta_description'],
            'meta_keywords' => $page_home['meta_keyword'],           
        ];

        $data['page_home'] = $page_home;

		

		$data['page_home_lang_independent'] = $modelCommon->all_page_home_lang_independent();
		$data['comment'] = $modelCommon->all_comment();
		
		$data['all_news'] = $modelCommon->all_news();
		$data['all_news_category'] = $modelCommon->all_news_category();

		$data['home_sliders'] = $modelHome->all_slider();
        //var_dump($data['sliders']);die();
		$data['services'] = $modelHome->all_service();
		$data['features'] = $modelHome->all_feature();
		$data['why_choose'] = $modelHome->all_why_choose();
		$data['team_members'] = $modelHome->all_team_member();
		$data['testimonials'] = $modelHome->all_testimonial();		
		$data['clients'] = $modelHome->all_client();
		$data['pricing_table'] = $modelHome->all_pricing_table();
		$data['home_faq'] = $modelHome->all_faq_home();

		$data['portfolio_category'] = $modelPortfolio->get_portfolio_category();
		$data['portfolio'] = $modelPortfolio->get_portfolio_data();
		$data['portfolio_footer'] = $modelPortfolio->get_portfolio_data();
        return $this->render('pages/home',$data);

    }
}
