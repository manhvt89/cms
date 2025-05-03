<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\PageAboutModel;

class PageAbout extends AdminBaseController
{
    protected $_Model;
    protected $commonModel;

	protected $index_url;
	protected $add_url;
	protected $edit_url;
    public function __construct()
    {
        $this->_Model = new PageAboutModel();
        $this->commonModel = new CommonModel();
		$this->index_url = "admin/pageabout";
		$this->add_url = "admin/pageabout/add";
		$this->edit_url = "admin/pageabout/edit";
        helper(['form', 'url']);
		
    }

    public function index()
	{
		$data = $this->data;
		$data['setting'] = $this->commonModel->get_setting_data();
		$_items = $this->_Model->show();
		$data['page_about'] = $_items;
        return view($this->index_url, $data); //admin/slider
	}

	public function edit($id)
	{
		$data = $this->data;
    	// If there is no event in this id, then redirect
    	$tot = $this->_Model->item_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url($this->index_url));     	
    	}
		$data['setting'] = $this->commonModel->get_setting_data();
		
		$error = '';
		$success = '';

		if($this->request->getPost('form1') ==1) 
		{
			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$about_heading = $this->request->getPost('about_heading');
			$about_content = $this->request->getPost('about_content');
			$mt_about = $this->request->getPost('mt_about');
			$mk_about = $this->request->getPost('mk_about');
			$md_about = $this->request->getPost('md_about');

	
			$rules = [
                'about_heading'         => 'required',
				'about_content'         => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->to()->back()->withInput()->with('error', $this->validator->getErrors());
            }

			
			$form_data = array(
				'about_heading' => $about_heading,
				'about_content' => $about_content,
				'mt_about' => $mt_about,
				'mk_about' => $mk_about,
				'md_about' => $md_about
			);
			//var_dump();die();
			$this->_Model->_update($id,$form_data);

			$success = 'Slide is updated successfully';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
		   
		} else {
			$data['setting'] = $this->commonModel->get_setting_data();
			//$data['all_lang'] = $this->commonModel->all_lang();
			$data['page_about'] = $this->_Model->getData($id);
			
			return view($this->edit_url,$data); //'admin/photo/edit'
		}

	}


	public function delete($id) 
	{
    	$tot = $this->_Model->item_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url($this->index_url));
    	}
		if(PROJECT_MODE == 0) {
			session()->setFlashdata('error',PROJECT_NOTIFICATION);
			return redirect()->to($_SERVER['HTTP_REFERER']);
		}

		
		$this->_Model->_delete($id);

		

		$success = 'The item is deleted successfully';
		session()->setFlashdata('success',$success);
		return redirect()->to(base_url($this->index_url));
		
    }

	public function detail($id)
    {
		$data = $this->data;
    	$tot = $this->_Model->item_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url($this->index_url));
    	}
       	
       	$data['setting'] = $this->commonModel->get_setting_data();

       	$error = '';
		$success = '';

		if(isset($_POST['form1'])) 
		{
			foreach ($_POST['new_arr'] as $val) {
				$new_arr2[] = $val;
			}

			foreach ($_POST['new_arr1'] as $val) {
				$new_arr3[] = $val;
			}

			for($i=0;$i<count($new_arr2);$i++) {
							
				$form_data = array(
					'lang_string_value' => $new_arr2[$i]
	            );
	            $this->_Model->update_detail($new_arr3[$i],$form_data);
			}

	    	$data['lang_detail'] = $this->_Model->detail($id);
			
			$success = 'Language detail is updated successfully';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url("admin/lang/detail/{$id}"));
		}
		else
		{
			$data['lang_detail'] = $this->_Model->detail($id);
			$data['id'] = $id;
			$i = 0;
			$arr1 = [];
			$arr2 = [];
			$arr3 = [];
			foreach ($data['lang_detail'] as $row) {
				$arr1[$i] = $row['lang_detail_id'];
				$arr2[$i] = $row['lang_string'];
				$arr3[$i] = $row['lang_string_value'];
				$i++;
			}
			
			$data['arr1'] = $arr1;
			$data['arr2'] = $arr2;
			$data['arr3'] = $arr3;
			
			return view('admin/lang/detail',$data);
				
		}
		
    }


    public function change($short_name)
    {

		if(PROJECT_MODE == 0) {
			$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
			redirect($_SERVER['HTTP_REFERER']);
		}

    	if($short_name == 'EN')
    	{
			$_SESSION['admin_sess_lang'] = 'EN';
    	}
    	elseif($short_name == 'AR')
    	{
    		$_SESSION['admin_sess_lang'] = 'AR';	
    	}
    	else
    	{
    		$_SESSION['admin_sess_lang'] = 'EN';
    	}

    	redirect($this->agent->referrer());
    }


}
