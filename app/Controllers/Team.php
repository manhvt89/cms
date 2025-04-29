<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommonModel;
use App\Models\TeamModel;


class Team extends BaseController
{
    protected $common;
    protected $_Model;
    protected $portfolio;

    public function __construct()
    {
        $this->common    = new CommonModel();
        $this->_Model      = new TeamModel();
        $page = $this->common->all_page_team();
        $data = $this->data ?? [];
        $data['setting'] = $this->common->all_setting();
        $data['page'] = $page;
        $this->data = array_merge($data,[
                                                'meta_title' => $page['mt'],
                                                'meta_description' => $page['md'],
                                                'meta_keywords' => $page['mk'],           
                                                ]);
    }

    public function index()
    {
        $langId = session('sess_lang_id');

        
        $data = array_merge($this->data,[
            'setting'            => $this->common->all_setting(),
            'page_team'          => $this->common->all_page_team(),
            'comment'            => $this->common->all_comment(),
            'social'             => $this->common->all_social(),
            'all_news'           => $this->common->all_news(),
            'team_members'       => $this->_Model->allTeamMember($langId),
        ]);

        return $this->render('pages/team',$data);
    }
}
