<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCommon;
use App\Models\PortfolioModel;
use App\Models\EventModel;
class Event extends BaseController
{
    protected $common;
    protected $portfolio;
    protected $_model;


    public function __construct()
    {
        $this->common    = new ModelCommon();
        $this->portfolio = new PortfolioModel();
        $this->_model   = new EventModel();
        $page = $this->common->all_page_event();
        $data = $this->data ?? [];
        $data['setting'] = $this->common->all_setting();
        $data['page'] = $page;
        $this->data = array_merge($data,[
                                                'meta_title' => $page['mt'],
                                                'meta_description' => $page['md'],
                                                'meta_keywords' => $page['mk'],           
                                                ]);
    }
    public function index($page = 1): string
    {
        $common = new ModelCommon();
        $eventModel = new EventModel();
        $portfolio = new PortfolioModel();

        $data = [];
		
        $page_event  = $common->all_page_event();
       
        $perPage = 10;

        $data = array_merge($this->data,[  
            'page_event'       => $common->all_page_event(),
            'comment'          => $common->all_comment(),
            'all_event'        => $common->all_event(),
            'all_news'         => $common->all_news(),
            'event'            => $eventModel->all_event(),
            'portfolio_footer' => $portfolio->get_portfolio_data(),
        ]);

        $offset = ($page > 0) ? ($page - 1) * $perPage : 0;

        $total = $eventModel->get_total_event();
        $data['event_fetched'] = $eventModel->fetch_event($perPage, $offset);

        $pager = \Config\Services::pager();
        $data['links'] = $pager->makeLinks($page, $perPage, $total, 'default_full');

        return $this->render('pages/event',$data);

	}

	public function view($id=0)
	{
        if (!is_numeric($id)) {
            return redirect()->to(base_url());
        }

        $common = new ModelCommon();
        $eventModel = new EventModel();
        $portfolio = new PortfolioModel();

        if (!$eventModel->event_check($id)) {
            return redirect()->to(base_url());
        }

        $event_detail =  $eventModel->event_detail($id);
        $data = array_merge($this->data,[
        
            'comment'          => $common->all_comment(),
            'social'           => $common->all_social(),
            'all_event'        => $common->all_event(),
            'all_news'         => $common->all_news(),
            'event'            => $eventModel->all_event(),
            'event_detail'     => $eventModel->event_detail($id),
            'id'               => $id,
            'portfolio_footer' => $portfolio->get_portfolio_data(),
        ]);

        $data = array_merge( [
            'meta_title' => $event_detail['meta_title'],
            'meta_description' => $event_detail['meta_description'],
            'meta_keywords' => $event_detail['meta_keyword'],           
        ],$data);
        //var_dump($eventModel->event_detail($id));die();
        return $this->render('pages/event_detail',$data);
    }

}
