<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\SliderModel;

class Slider extends AdminBaseController
{
    protected $_Model;
    protected $commonModel;

	protected $index_url;
	protected $add_url;
	protected $edit_url;
    public function __construct()
    {
        $this->_Model = new SliderModel();
        $this->commonModel = new CommonModel();
		$this->index_url = "admin/slider";
		$this->add_url = "admin/slider/add";
		$this->edit_url = "admin/slider/edit";
        helper(['form', 'url']);
		
    }

    public function index()
	{
		$data = $this->data;
		$data['setting'] = $this->commonModel->get_setting_data();
		$_items = $this->_Model->show();
		$data['slider'] = $_items;
        return view($this->index_url, $data); //admin/slider
	}

	public function add()
	{
		$data = $this->data;
		$data['setting'] = $this->commonModel->get_setting_data();
		$data['all_lang'] = $this->commonModel->all_lang();

		if($this->request->getPost('form1')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$rules = [
                'photo'         => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			$form_data = [
					'photo'        => $this->request->getPost('photo'),
					'heading'      => $this->request->getPost('heading'),
					'content'      => $this->request->getPost('content'),
					'button1_text' => $this->request->getPost('button1_text'),
					'button1_url'  => $this->request->getPost('button1_url'),
					'button2_text' => $this->request->getPost('button2_text'),
					'button2_url'  => $this->request->getPost('button2_url'),
					'position'     => $this->request->getPost('position'),
					'lang_id'      => $this->request->getPost('lang_id')
			];
			$this->_Model->add($form_data);
			
			$success = 'Slide is added successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
  
        } else { 
			return view($this->add_url,$data); //admin/photo/add
        }
	}


	public function edit($id)
	{
    	// If there is no event in this id, then redirect
    	$tot = $this->_Model->item_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url($this->index_url));     	
    	}
		$data = $this->data;
		$data['setting'] = $this->commonModel->get_setting_data();
		
		$error = '';
		$success = '';

		

		if($this->request->getPost('form1')) 
		{
			

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}
			$rules = [
                'photo'         => 'required',
				
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }

			
			$form_data = [
				'photo'        => $this->request->getPost('photo'),
				'heading'      => $this->request->getPost('heading'),
				'content'      => $this->request->getPost('content'),
				'button1_text' => $this->request->getPost('button1_text'),
				'button1_url'  => $this->request->getPost('button1_url'),
				'button2_text' => $this->request->getPost('button2_text'),
				'button2_url'  => $this->request->getPost('button2_url'),
				'position'     => $this->request->getPost('position'),
				'lang_id'      => $this->request->getPost('lang_id')
			];
			//var_dump();die();
			$this->_Model->_update($id,$form_data);

			$success = 'Slide is updated successfully';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
		   
		} else {
			$data['setting'] = $this->commonModel->get_setting_data();
			$data['all_lang'] = $this->commonModel->all_lang();
			$data['slider'] = $this->_Model->getData($id);
			
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


    function change($short_name)
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
