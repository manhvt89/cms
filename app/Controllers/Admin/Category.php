<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ModelCommon;
use App\Models\Admin\ModelCategory;

class Category extends BaseController
{
    protected $modelCommon;
    protected $modelCategory;
    protected $session;

    public function __construct()
    {
        $this->modelCommon = new ModelCommon();
        $this->modelCategory = new ModelCategory();
        $this->session = session();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data['setting'] = $this->modelCommon->get_setting_data();
		$data['category'] = $this->modelCategory->show();

		return view('admin/category',$data);
    }
    public function add()
	{
		$data['setting'] = $this->modelCommon->get_setting_data();
		$data['all_lang'] = $this->modelCommon->all_lang();

		$error = '';
        
        $validation = \Config\Services::validation();
        //var_dump($this->request->getPost('form1'));die();
		if($this->request->getPost('form1')) {

			if(PROJECT_MODE == 0) {
				$this->session->setFlashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

            $valid = true;
            $error = '';
    
            // Validate input
            $rules = [
                'category_name' => 'required|trim'
            ];

            if (!$this->validate($rules)) {
                $valid = false;
                $error .= $validation->listErrors();
            }
    
            $file = $this->request->getFile('banner');

			if (!$file->isValid()) {
                $valid = false;
                $error .= 'You must have to select a photo for banner<br>';
            } else {
                $ext = $file->getExtension();
                
                if (!$this->modelCommon->extension_check_photo($ext)) {
                    $valid = false;
                    $error .= 'You must have to upload jpg, jpeg, gif or png file for banner<br>';
                }
            }
            
			if ($valid) {
                /*
                $ai_id = $this->modelCategory->get_auto_increment_id();
    
                $final_name = 'category-banner-' . $ai_id . '.' . $ext;
                $file->move(ROOTPATH . 'public/uploads/', $final_name);
                */

                $final_name = 'category-banner-' . uniqid() . '.' . $ext;
                $file->move(ROOTPATH . 'public/uploads/', $final_name);
    
                $form_data = [
                    'category_name'    => $this->request->getPost('category_name'),
                    'category_banner'  => $final_name,
                    'meta_title'       => $this->request->getPost('meta_title'),
                    'meta_keyword'     => $this->request->getPost('meta_keyword'),
                    'meta_description' => $this->request->getPost('meta_description'),
                    'lang_id'          => $this->request->getPost('lang_id')
                ];
    
                $this->modelCategory->add($form_data);
    
                $this->session->setFlashdata('success', 'Category is added successfully!');
                return redirect()->to(base_url('admin/category'));
            } else {
                $this->session->setFlashdata('error', $error);
                return redirect()->to(base_url('admin/category/add'))->withInput();
            }
            
        } else {            
            return view('admin/category_add',$data);
        }
		
	}


	public function edit($id)
	{
		$_aCategory = $this->modelCategory->get_category($id);
        if(empty($_aCategory))
        {
    	    return redirect()->to(base_url().'admin/category');
        	
    	} else {
       	
            $data['setting'] = $this->modelCommon->get_setting_data();
            $data['all_lang'] = $this->modelCommon->all_lang();

            $error = '';
            $success = '';

            $validation = \Config\Services::validation();
            if($this->request->getPost('form1')) 
            {

                if(PROJECT_MODE == 0) {
                    $this->session->setFlashdata('error',PROJECT_NOTIFICATION);
                    return redirect()->to($_SERVER['HTTP_REFERER']);
                }

                $valid = 1;
                // Validate input
                $rules = [
                    'category_name' => 'required|trim'
                ];

                if (!$this->validate($rules)) {
                    $valid = false;
                    $error .= $validation->listErrors();
                }

                

                $path = $_FILES['banner']['name'];
                $path_tmp = $_FILES['banner']['tmp_name'];

                if($path!='') {
                    $file = $this->request->getFile('banner');

                    if (!$file->isValid()) {
                        $valid = false;
                        $error .= 'You must have to select a photo for banner<br>';
                    } else {
                        $ext = $file->getExtension();
                        
                        if (!$this->modelCommon->extension_check_photo($ext)) {
                            $valid = false;
                            $error .= 'You must have to upload jpg, jpeg, gif or png file for banner<br>';
                        }
                    }
                }

                if($valid == 1) 
                {
                    
                    $form_data = [
                        'category_name'    => $this->request->getPost('category_name'),
                        'meta_title'       => $this->request->getPost('meta_title'),
                        'meta_keyword'     => $this->request->getPost('meta_keyword'),
                        'meta_description' => $this->request->getPost('meta_description'),
                        'lang_id'          => $this->request->getPost('lang_id')
                    ];

                    if($path != '') {

                        $data['category'] = $_aCategory;
                        @unlink(ROOTPATH.'public/uploads/'.$data['category']['category_banner']);

                        $final_name = 'category-banner-'.uniqid().'.'.$ext;
                        //move_uploaded_file( $path_tmp, ROOTPATH.'public/uploads/'.$final_name );
                        $file->move(ROOTPATH.'public/uploads/'.$final_name);
                        $form_data = array_merge($form_data, [
                                                                'category_banner'  => $final_name,
                                                           ]);
                    }
                    $this->modelCategory->_update($id,$form_data);
                    $success = 'Category is updated successfully';
                    $this->session->setflashdata('success',$success);
                    return redirect()->to(base_url().'admin/category');
                }
                else
                {
                    $this->session->setflashdata('error',$error);
                    return redirect()->to(base_url().'admin/category/edit'.$id);
                }
            
            } else {
                $data['category'] = $_aCategory;
                return view('admin/category_edit',$data);
              
            }
        }

	}


	public function delete($id) 
	{
    	$_rCategory = $this->modelCategory->get_category($id);
    	if(empty($_rCategory)) {
    		return redirect()->to(base_url().'admin/category');
    	}

		if(PROJECT_MODE == 0) {
			$this->session->setflashdata('error',PROJECT_NOTIFICATION);
			return redirect()->to($_SERVER['HTTP_REFERER']);
		}

    	// Check if there is any news in this category. If found, category can not be deleted.
    	$status = $this->modelCategory->check_news($id);
    	if($status) 
    	{
    		$error = 'Category can not be deleted because there is news under this';
    		$this->session->setflashdata('error',$error);
    		return redirect()->to(base_url().'admin/category');
    	}
    	else
    	{
			$category = $_rCategory;
			

	        if($this->modelCategory->_delete($id))
            {
                unlink(ROOTPATH."public/uploads/{$category['category_banner']}");
                $success = 'Category is deleted successfully';
                $this->session->setflashdata('success',$success);
            } else {
                $error = 'Category can not be deleted because there is news under this';
    		    $this->session->setflashdata('error',$error);
            }
	        return redirect()->to(base_url().'admin/category');
    	}    	
    }
    
}
