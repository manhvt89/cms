<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\NewsModel;
use App\Models\Admin\CategoryModel;
use App\Models\CommonModel;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\Admin\ModelCommon;
use App\Models\Admin\ModelCategory;
use App\Models\Admin\ModelNews;
use CodeIgniter\API\ResponseTrait;

class News extends AdminBaseController
{
    use ResponseTrait;
    protected $newsModel;
    protected $categoryModel;
    protected $commonModel;

    public function __construct()
    {
        $this->newsModel     = new ModelNews();
        $this->categoryModel = new ModelCategory();
        $this->commonModel   = new ModelCommon();
        helper(['form', 'url']);
    }

    public function index(): string
    {
        $data = $this->data;
        $data['news'] = $this->newsModel->show();
        $data['setting'] = $this->commonModel->get_setting_data();
        return view('admin/news', $data);
            
    }

    public function add()
    {
        $data = $this->data;
        $data['setting'] = $this->commonModel->get_setting_data();
        $data['all_lang'] = $this->commonModel->all_lang();
        $data['all_category'] = $this->newsModel->get_category();
        
        if ($this->request->is('post')) {
            
            $rules = [
                'news_title' => 'required',
                'news_content_short' => 'required',
                'news_content' => 'required',
                'category_id' => 'required|is_natural_no_zero',
                'featured-photo' => 'required',
                //'banner' => 'uploaded[banner]|is_image[banner]|ext_in[banner,jpg,jpeg,png,gif]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->to(base_url('/admin/news/add'))
                        ->withInput()->with('error', $this->validator->listErrors());
            }
            $meta_title = trim($this->request->getPost('meta_title'));
            $meta_keyword = trim($this->request->getPost('meta_keyword'));
            $meta_description = trim($this->request->getPost('meta_description'));

            $meta_title = $meta_title !== '' ? $meta_title : $this->request->getPost('news_title');
            $meta_keyword = $meta_keyword !== '' ? $meta_keyword : '';
            $meta_description = $meta_description !== '' ? $meta_description : $this->request->getPost('news_content_short');
            
            // Save to database
            $rs = $this->newsModel->add([
                'news_title' => $this->request->getPost('news_title'),
                'news_content' => $this->request->getPost('news_content'),
                'news_content_short' => $this->request->getPost('news_content_short'),
                'news_date' => $this->request->getPost('news_date'),
                'photo' => $this->request->getPost('featured-photo'),
                'banner' =>$this->request->getPost('banner-photo'),
                'category_id' => $this->request->getPost('category_id'),
                'comment' => $this->request->getPost('comment'),
                'meta_title' => $meta_title,
                'meta_keyword' => $meta_keyword,
                'meta_description' => $meta_description,
                'lang_id' => $this->request->getPost('lang_id'),
                'seo_score'   => $this->request->getPost('seo_score'),
                'readability_score' => $this->request->getPost('readability_score'),
                'slug' => $this->request->getPost('slug'),
            ]);
            if($rs > 0)
            {
                return redirect()->to(base_url('admin/news'))
                    ->with('success', 'News is added successfully!');
            } else {
                return redirect()->to(base_url('admin/news'))
                    ->with('error', 'News is not added successfully!');
            }
        }

        return view('admin/news_add', $data);
            
    }

    public function edit($id)
    {
        $data = $this->data;
        $_aNews = $this->newsModel->getData($id);
        if(!$_aNews)
        {
            return redirect()->to(base_url('admin/news'));
        }

        $data['setting'] = $this->commonModel->get_setting_data();
        $data['all_lang'] = $this->commonModel->all_lang();
        $data['news'] = $_aNews;
        $data['all_category'] = $this->newsModel->get_category();

        if ($this->request->getPost('form1')) {

            if (PROJECT_MODE == 0) {
                session()->setFlashdata('error', PROJECT_NOTIFICATION);
                return redirect()->back();
            }

            // Validation
            $rules = [
                'news_title'         => 'required',
                'news_content_short' => 'required',
                'news_content'       => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }

            // Handle file uploads
           

            $valid = true;
            $error = '';

            if (!$valid) {
                return redirect()->to(base_url("admin/news/edit/{$id}"))->withInput()->with('error', $error);
            }

            $meta_title = trim($this->request->getPost('meta_title'));
            $meta_keyword = trim($this->request->getPost('meta_keyword'));
            $meta_description = trim($this->request->getPost('meta_description'));

            $meta_title = $meta_title !== '' ? $meta_title : $this->request->getPost('news_title');
            $meta_keyword = $meta_keyword !== '' ? $meta_keyword : '';
            $meta_description = $meta_description !== '' ? $meta_description : $this->request->getPost('news_content_short');
            

            // Prepare form data
            $form_data = [
                'news_title'         => $this->request->getPost('news_title'),
                'news_content'       => $this->request->getPost('news_content'),
                'news_content_short' => $this->request->getPost('news_content_short'),
                'news_date'          => $this->request->getPost('news_date'),
                'category_id'        => $this->request->getPost('category_id'),
                'comment'            => $this->request->getPost('comment'),
                'meta_title'         => $meta_title,
                'meta_keyword'       => $meta_keyword,
                'meta_description'   => $meta_description,
                'lang_id'            => $this->request->getPost('lang_id'),
                'photo'              => $this->request->getPost('featured-photo'),
                'banner' => $this->request->getPost('banner-photo'),
                'seo_score'   => $this->request->getPost('seo_score'),
                'readability_score' => $this->request->getPost('readability_score'),
            ];

            $this->newsModel->_update($id, $form_data);

            session()->setFlashdata('success', 'News updated successfully');
            return redirect()->to(base_url('admin/news'));
        }

        return view('admin/news_edit', $data);
    }
    public function delete($id = null)
    {
        $news = $this->newsModel->find($id);
        if (!$news) {
            return redirect()->to(base_url('admin/news'))
                ->with('error', 'News not found');
        }
        $this->newsModel->_delete($id);
        return redirect()->to(base_url('admin/news'))
            ->with('success', 'News is deleted successfully');
    }

    public function checkSlug()
    {
        $slug = $this->request->getPost('slug');
        
        $model = new ModelNews();
        $existing = $model->where('slug', $slug);

        $exists = $existing->first() ? true : false;
        
        return $this->response->setJSON([
            'exists' => $exists,
            'message' => $exists ? 'Slug đã tồn tại!' : 'Slug có thể sử dụng.',
            'csrf_token' => csrf_token(),
	        'csrf_hash'  => csrf_hash()
        ]);
    }
    
}
