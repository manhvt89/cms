<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCommon;
use App\Models\ModelPhotoGallery;
use App\Models\PortfolioModel;

class PhotoGallery extends BaseController
{
    protected $commonModel;
    protected $photoModel;
    protected $portfolioModel;

    public function __construct()
    {
        $this->commonModel     = new ModelCommon();
        $this->photoModel      = new ModelPhotoGallery();
        $this->portfolioModel  = new PortfolioModel();
    }

    public function index()
    {
        $data = [
            'meta_title' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'page_about' => '',
            // Thêm các biến khác cần thiết
        ];

        $data = array_merge($data,[
            'page_photo_gallery' => $this->commonModel->all_page_photo_gallery(),
            'comment'             => $this->commonModel->all_comment(),
            'all_news'            => $this->commonModel->all_news(),
            'photo_gallery'       => $this->photoModel->all_photo(),
            'portfolio_footer'    => $this->portfolioModel->get_portfolio_data()
        ]);

        return $this->render('pages/photogalery',$data);
    }
}
