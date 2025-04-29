<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCommon;
use App\Models\ModelPortfolio;
use App\Models\ModelPage;
class Page extends BaseController
{
    protected $modelCommon;
    protected $modelPortfolio;
    protected $modelPage;

    public function __construct()
    {
        $this->modelCommon = new ModelCommon();
        $this->modelPortfolio = new ModelPortfolio();
        $this->modelPage = new ModelPage();
    }
    public function index($slug='')
    {
    	$data['setting'] = $this->modelCommon->all_setting();
		$data['page_about'] = $this->modelCommon->all_page_about();
		$data['comment'] = $this->modelCommon->all_comment();		
		$data['all_news'] = $this->modelCommon->all_news();
		$data['portfolio_footer'] = $this->modelPortfolio->get_portfolio_data();
		$data['page_dynamic_detail'] = $this->modelPage->dynamic_page_by_slug($slug);
		return $this->render('pages/page_dynamic',$data);
    }
}