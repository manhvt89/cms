<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\ShopProductModel;
use Config\Services;

class ShopProduct extends AdminBaseController
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
        $this->_Model = new ShopProductModel();
        $this->session = session();
        helper(['form', 'url','transform']);
        $this->index_url = "admin/shop/manage/product";
		$this->add_url = "admin/shop/add/product";
		$this->edit_url = "admin/shop/edit/product";
		$this->theme = "admin/shopproduct";
        
        $data['setting'] = $this->commonModel->get_setting_data();
        $data['title'] = "";
        $this->data = array_merge($this->data??[],$data);
        //var_dump($this->data);die();
    }

    public function index()
    {
        // ít nên không phân trang
        $data = $this->data;
        $data['title'] =  "Danh sách sản phẩm";
        $data['category'] = transform_shop_product($this->_Model->show());
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
                'product_title'         => 'required', 
                'brand_id'         => 'required', 
                'shop_category_id'         => 'required', 
                'product_image'         => 'required', 
                'product_price'         => [
                    'label'=>'Price',
                    'rules' => 'required|numeric'
                ], 
                'product_short_description'         => 'required', 
                'product_long_description'         => 'required', 
                'product_quantity'         => [
                    'label'=>'Quantity',
                    'rules' => 'required|numeric'
                ], 

            ];

            $data = $this->request->getPost();
            $data['product_price'] = str_replace('.', '', $data['product_price']);

            $validation = Services::validation();
            $validation->setRules($rules);

            if (! $validation->run($data)) {
                return redirect()->to(base_url("{$this->edit_url}/{$id}"))
                                ->withInput()->with('errors', $validation->getErrors());
            }
            /*
            if (!$this->validate($rules)) {
                return redirect()->to(base_url("{$this->edit_url}/{$id}"))
                                ->withInput()->with("error", $this->validator->getErrors());
            }
                                */
            
            $form_data = [
                'product_title'    => $this->request->getPost('product_title'),
                'product_category'    => $this->request->getPost('shop_category_id'),
                'product_brand'    => $this->request->getPost('brand_id'),
                'product_slug'    => $this->request->getPost('product_slug')??slugify($this->request->getPost('product_title')),
                'product_keyword'    => $this->request->getPost('product_keyword'),
                'product_image'       => $this->request->getPost('product_image'),
                'product_price' => str_replace('.', '',$this->request->getPost('product_price')),
                'product_short_description' => $this->request->getPost('product_short_description'),
                'product_long_description' => $this->request->getPost('product_long_description'),
                'publication_status' => $this->request->getPost('publication_status')??0,
                'product_quantity'    => str_replace('.', '',$this->request->getPost('product_quantity')),
            ];

            $this->_Model->add($form_data);
            $success = 'Product is updated successfully';
            $this->session->setFlashdata('success',$success);
            return redirect()->to(base_url($this->index_url));
            
            
        } else {           
            $data['title'] =  "Thêm mới BRAND";
            $data['all_published_category'] = $this->_Model->get_all_published_category();
            $data['all_published_brand']    = $this->_Model->get_all_published_brand(); 
            return view("{$this->theme}/add",$data);
        }
		
	}


	public function edit($id)
	{
        $data = $this->data;
		$_aProducts = $this->_Model->getData($id);
        $data['all_published_category'] = $this->_Model->get_all_published_category();
        $data['all_published_brand']    = $this->_Model->get_all_published_brand();
        if(empty($_aProducts))
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
                    'product_title'         => 'required', 
                    'brand_id'         => 'required', 
                    'shop_category_id'         => 'required',
                    'product_image'         => 'required', 
                    'product_price'         => [
                        'label'=>'Price',
                        'rules' => 'required|numeric'
                    ], 
                    'product_short_description'         => 'required', 
                    'product_long_description'         => 'required', 
                    'product_quantity'         => [
                        'label'=>'Quantity',
                        'rules' => 'required|numeric'
                    ], 

                ];

                $data = $this->request->getPost();
                $data['product_price'] = str_replace('.', '', $data['product_price']);
    
                $validation = Services::validation();
                $validation->setRules($rules);

                if (! $validation->run($data)) {
                    return redirect()->to(base_url("{$this->edit_url}/{$id}"))
                                    ->withInput()->with('errors', $validation->getErrors());
                }
                /*
                if (!$this->validate($rules)) {
                    return redirect()->to(base_url("{$this->edit_url}/{$id}"))
                                    ->withInput()->with("error", $this->validator->getErrors());
                }
                                    */
                
                $form_data = [
                    'product_title'    => $this->request->getPost('product_title'),
                    'product_category'    => $this->request->getPost('shop_category_id'),
                    'product_brand'    => $this->request->getPost('brand_id'),
                    'product_slug'    => $this->request->getPost('product_slug')??slugify($this->request->getPost('product_title')),
                    'product_keyword'    => $this->request->getPost('product_keyword'),
               
                    'product_image'       => $this->request->getPost('product_image'),
                    'product_price' => str_replace('.', '',$this->request->getPost('product_price')),
                    'product_short_description' => $this->request->getPost('product_short_description'),
                    'product_long_description' => $this->request->getPost('product_long_description'),
                    'publication_status' => $this->request->getPost('publication_status')??0,
                    'product_quantity'    => str_replace('.', '',$this->request->getPost('product_quantity')),
                ];

                $this->_Model->_update($id,$form_data);
                $success = 'Product is updated successfully';
                $this->session->setFlashdata('success',$success);
                return redirect()->to(base_url($this->index_url));
                
            
            } else {
                $data['title'] =  "Sửa Sản phẩm";
                $data['item'] = $_aProducts;
                return view("{$this->theme}/edit",$data);
              
            }
        }

	}


	public function delete($id) 
	{
    	$_rCategory = $this->_Model->getData($id);
    	if(empty($_rCategory)) {
    		return redirect()->to(base_url('admin/shop/manage/product'));
    	}

		if(PROJECT_MODE == 0) {
			$this->session->setFlashdata('error',PROJECT_NOTIFICATION);
			return redirect()->to($_SERVER['HTTP_REFERER']);
		}

    	// Check if there is any product in this order. If found, product can not be deleted.
    	$status = $this->_Model->check_order($id);
    	if($status) 
    	{
    		$error = 'Product can not be deleted because there is news under this';
    		$this->session->setFlashdata('error',$error);
    		return redirect()->to(base_url('admin/shop/manage/product'));
    	}
    	else
    	{
			
	        if($this->_Model->_delete($id))
            {
                $success = 'Product is deleted successfully';
                $this->session->setFlashdata('success',$success);
            } else {
                $error = 'Product can not be deleted because there is news under this';
    		    $this->session->setFlashdata('error',$error);
            }
	        return redirect()->to(base_url('admin/shop/manage/product'));
    	}    	
    }
    
}
