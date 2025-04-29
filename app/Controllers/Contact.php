<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommonModel;
use App\Models\PortfolioModel;
use App\Models\ContactModel;
class Contact extends BaseController
{
    protected $common;
    protected $portfolio;
    protected $_model;


    public function __construct()
    {
        $this->common    = new CommonModel();
        $this->portfolio = new PortfolioModel();
        $this->_model   = new ContactModel();
        $page = $this->common->all_page_contact();
        $data = $this->data ?? [];
        $data['setting'] = $this->common->all_setting();
        $data['page'] = $page;
        $this->data = array_merge($data,[
                                                'meta_title' => $page['mt'],
                                                'meta_description' => $page['md'],
                                                'meta_keywords' => $page['mk'],           
                                                ]);
    }
    public function index(): string
    {
        
        $modelCommon = new CommonModel();
        $modelContact = $this->_model;
        $modelPortfolio = new PortfolioModel();
        $data = [];
		
        $page_contact = $modelCommon->all_page_contact();
        

        $data = array_merge([],$this->data);
        $data['page_contact'] = $page_contact;
		
		
		//$data['all_news'] = $modelCommon->all_news();
		//$data['all_news_category'] = $modelCommon->all_news_category();

		
		//$data['testimonials'] = $modelContact->all_testimonial();		
		
		//$data['portfolio_category'] = $modelPortfolio->get_portfolio_category();
		//$data['portfolio'] = $modelPortfolio->get_portfolio_data();

		$data['portfolio_footer'] = $modelPortfolio->get_portfolio_data();
        $data['check_captcha'] = $modelContact->check_captcha();
		$data['total_captcha'] = $modelContact->total_captcha();
        $r_serial = mt_rand(1, $data['total_captcha']);
        $data['r_serial'] = $r_serial;             
        $data['captcha_one'] = $modelContact->get_particular_captcha($r_serial);
        return $this->render('pages/contact',$data);

    }

    

	public function send_email() 
	{
		
	}
}
