<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\ShopBrandModel;

class ShopBrand extends AdminBaseController
{
    protected $commonModel;
    protected $_Model;
    protected $session;

    protected $index_url;
	protected $add_url;
	protected $edit_url;
	protected $theme;

    public function __construct()
    {
        $this->commonModel = new CommonModel();
        $this->_Model = new ShopBrandModel();
        $this->session = session();
        helper(['form', 'url','transform']);
        $this->index_url = "admin/shop/manage/brand";
		$this->add_url = "admin/shop/add/brand";
		$this->edit_url = "admin/shop/edit/brand";
		$this->theme = "admin/shopbrand";
        
        $data['setting'] = $this->commonModel->get_setting_data();
        $data['title'] = "";
        $this->data = array_merge($this->data??[],$data);
        //var_dump($this->data);die();
    }

    public function index()
    {
        // ít nên không phân trang
        $data = $this->data;
        $data['title'] =  "Danh sách BRAND";
        $data['category'] = transform_shop_brand($this->_Model->findAll());
		return view("{$this->theme}/list",$data);
    }
    public function add()
	{
		$data = $this->data;
		if($this->request->getPost('form1')) {

			if(PROJECT_MODE == 0) {
				$this->session->setFlashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}    
            $rules = [
                'brand_name'         => 'required', 
                'brand_logo'         => 'required', 
            ];

            if (!$this->validate($rules)) {
                //$this->session->setFlashdata('error',$this->validator->getErrors());
                return redirect()->to(base_url($this->add_url))
                                ->withInput()
                                ->with('error', $this->validator->getErrors());
            }
    
            $form_data = [
                'brand_name'    => $this->request->getPost('brand_name'),
                'brand_keyword'    => $this->request->getPost('brand_keyword'),
                'brand_logo'       => $this->request->getPost('brand_logo'),
                'brand_description' => $this->request->getPost('brand_description'),
                'brand_slug' => $this->request->getPost('brand_slug')??slugify($this->request->getPost('brand_name')),
                'publication_status' => $this->request->getPost('publication_status')??0
            ];
            $this->_Model->add($form_data);
            $success = 'Brand is added successfully';
            $this->session->setFlashdata('success',$success);
            return redirect()->to(base_url($this->index_url));
            
            
        } else {           
            $data['title'] =  "Thêm mới BRAND"; 
            return view("{$this->theme}/add",$data);
        }
		
	}


	public function edit($id)
	{
        $data = $this->data;
		$_aCategory = $this->_Model->getData($id);
        if(empty($_aCategory))
        {
    	    return redirect()->to(base_url($this->index_url));
        	
    	} else {
            $error = '';
            $success = '';

            if($this->request->getPost('form1')) 
            {

                if(PROJECT_MODE == 0) {
                    $this->session->setFlashdata('error',PROJECT_NOTIFICATION);
                    return redirect()->to($_SERVER['HTTP_REFERER']);
                }

                $rules = [
                    'brand_name'         => 'required', 
                    'brand_logo'         => 'required', 
                ];
    
                if (!$this->validate($rules)) {
                    return redirect()->to(base_url("{$this->edit_url}/{$id}"))
                                    ->withInput()->with("error", $this->validator->getErrors());
                }
                
                $form_data = [
                    'brand_name'    => $this->request->getPost('brand_name'),
                    'brand_logo'       => $this->request->getPost('brand_logo'),
                    'brand_description' => $this->request->getPost('brand_description'),
                    'brand_slug' => slugify($this->request->getPost('brand_slug')),
                    'brand_keyword' => $this->request->getPost('brand_keyword'),
                    'publication_status' => $this->request->getPost('publication_status')??0
                ];

                $this->_Model->_update($id,$form_data);
                $success = 'Brand is updated successfully';
                $this->session->setFlashdata('success',$success);
                return redirect()->to(base_url($this->index_url));
                
            
            } else {
                $data['title'] =  "Sửa Brand";
                $data['category'] = $_aCategory;
                return view("{$this->theme}/edit",$data);
              
            }
        }

	}


	public function delete($id) 
	{
    	$_rCategory = $this->_Model->getData($id);
    	if(empty($_rCategory)) {
    		return redirect()->to(base_url('admin/shop/manage/brand'));
    	}

		if(PROJECT_MODE == 0) {
			$this->session->setFlashdata('error',PROJECT_NOTIFICATION);
			return redirect()->to($_SERVER['HTTP_REFERER']);
		}

    	// Check if there is any news in this category. If found, category can not be deleted.
    	$status = $this->_Model->check_product($id);
    	if($status) 
    	{
    		$error = 'Brand can not be deleted because there is news under this';
    		$this->session->setFlashdata('error',$error);
    		return redirect()->to(base_url('admin/shop/manage/category'));
    	}
    	else
    	{
			
	        if($this->_Model->_delete($id))
            {
                $success = 'Brand is deleted successfully';
                $this->session->setFlashdata('success',$success);
            } else {
                $error = 'Brand can not be deleted because there is news under this';
    		    $this->session->setFlashdata('error',$error);
            }
	        return redirect()->to(base_url('admin/shop/manage/brand'));
    	}    	
    }
    
}
