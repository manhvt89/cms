<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommonModel;

use App\Models\ModelTeamMember;

class TeamMember extends BaseController
{
    protected $common;
    protected $portfolio;
    protected $member;

    public function __construct()
    {
        $this->common    = new CommonModel();
        $this->member    = new ModelTeamMember();
    }

    public function index()
    {
        return redirect()->to(base_url());
    }

    public function view($id = null)
    {
        if (!is_numeric($id) || !$this->member->exists($id)) {
            return redirect()->to(base_url());
        }
        $page_home = $this->common->all_page_home();
		
        $data = [
            'meta_title' => $page_home['title'],
            'meta_description' => $page_home['meta_description'],
            'meta_keywords' => $page_home['meta_keyword'],           
        ];

        $data = array_merge($data,[
            'comment'          => $this->common->all_comment(),
            'social'           => $this->common->all_social(),
            'all_news'         => $this->common->all_news(),
            'team_members'     => $this->member->getAll(),
            'member'           => $this->member->getDetail($id),
            //'portfolio_footer' => $this->portfolio->get_portfolio_data(),
            'id'               => $id,
        ]);

        return $this->render('pages/teammember',$data);
    }
}
