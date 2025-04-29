<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommonModel;
use App\Models\ModelSearch;
use App\Models\PortfolioModel;

class Search extends BaseController
{
    protected $commonModel;
    protected $searchModel;
    protected $portfolioModel;

    public function __construct()
    {
        $this->commonModel    = new CommonModel();
        $this->searchModel    = new ModelSearch();
        $this->portfolioModel = new PortfolioModel();
    }

    public function index()
    {
        $request = service('request');

        // Không có dữ liệu POST => redirect về trang chủ
        if (!$request->getPost('search_string')) {
            return redirect()->to(base_url());
        }

        $searchString = $request->getPost('search_string');
        $page_home = $this->commonModel->all_page_home();
        $data = [
            'meta_title' => $page_home['title'],
            'meta_description' => $page_home['meta_description'],
            'meta_keywords' => $page_home['meta_keyword'],           
        ];

        $data = array_merge($data,[
            
            'page_home'         => $this->commonModel->all_page_home(),
            'page_search'       => $this->commonModel->all_page_search(),
            'comment'           => $this->commonModel->all_comment(),
            'search_string'     => $searchString,
            'result'            => $this->searchModel->search($searchString),
            'total'             => $this->searchModel->search_total($searchString)
        ]);
        //echo '$searchString'; die();
        return $this->render('pages/search',$data);
    }
}
