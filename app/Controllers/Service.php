<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommonModel;
use App\Models\PortfolioModel;
use App\Models\ModelService;

class Service extends BaseController
{
    protected $common;
    protected $portfolio;
    protected $service;


    public function __construct()
    {
        $this->common    = new CommonModel();
        $this->portfolio = new PortfolioModel();
        $this->service   = new ModelService();
        $page = $this->common->all_page_service();
        $this->data = array_merge($this->data?$this->data:[],[
                                                'meta_title' => $page['mt'],
                                                'meta_description' => $page['md'],
                                                'meta_keywords' => $page['mk'], 
                                                'page_service'=>   $page       
        ]);
    }

    public function index()
    {
        $langId = session('sess_lang_id');
        
        $data = array_merge($this->data,[
            'comment'          => $this->common->all_comment(),
            'services'         => $this->service->all_service($langId),
            'portfolio_footer' => $this->portfolio->get_portfolio_data(),
            'check_captcha'    => $this->service->check_captcha(),
            'total_captcha'    => $this->service->total_captcha(),
        ]);

        return $this->render('pages/service',$data);
    }

    public function view($id = null)
    {
        if (!is_numeric($id) || !$this->service->service_exists($id)) {
            return redirect()->to(base_url());
        }

        $langId = session('sess_lang_id');

        
        $total_captcha = $this->service->total_captcha();
        $r_serial = mt_rand(1, $total_captcha);
        $captcha_one = $this->service->get_particular_captcha($r_serial);
        

        $data = array_merge($this->data, [
            'comment'          => $this->common->all_comment(),
            'social'           => $this->common->all_social(),
            'all_news'         => $this->common->all_news(),
            'services'         => $this->service->all_service($langId),
            'service'          => $this->service->get_service_detail($id),
            'portfolio_footer' => $this->portfolio->get_portfolio_data(),
            'check_captcha'    => $this->service->check_captcha(),
            'total_captcha'    => $total_captcha,
            'id'               => $id,
            'captcha_one'=>$captcha_one,
            'r_serial'=>$r_serial 
        ]);

        return $this->render('pages/service_detail', $data);
        
    }
}
