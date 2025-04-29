<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCommon;
use App\Models\ModelPortfolio;
use App\Models\ModelLang;
class Lang extends BaseController
{
    protected $modelCommon;
    protected $modelPortfolio;

    public function __construct()
    {
        $this->modelCommon = new ModelCommon();
        $this->modelPortfolio = new ModelPortfolio();
    }
    public function index()
    {
    	return redirect()->to(base_url());
    }

    public function change()
    {
    	
        $lang_change_id = $this->request->getPost('lang_change_id', FILTER_SANITIZE_NUMBER_INT);

        if ($lang_change_id) {
            $langModel = new \App\Models\ModelLang();
            $lang = $langModel->get_direction_by_lang_id($lang_change_id);

            session()->set([
                'sess_lang_id'         => $lang_change_id,
                'sess_layout_direction'=> $lang['layout_direction'] ?? 'ltr',
            ]);
        }

        return redirect()->to()->back();
    }
}