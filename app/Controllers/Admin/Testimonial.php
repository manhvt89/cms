<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\TestimonialModel;


class Testimonial extends AdminBaseController
{
    protected $_Model;
    protected $commonModel;
	

	protected $menuGroupModel;
	protected $menuModel;

	protected $index_url;
	protected $add_url;
	protected $edit_url;
	protected $list_url;
    public function __construct()
    {
        $this->_Model = new TestimonialModel();
        $this->commonModel = new CommonModel();
		
		$this->index_url = "admin/testimonial";
		$this->add_url = "admin/testimonial/add";
		$this->edit_url = "admin/testimonial/edit";
		$this->list_url = "admin/testimonial/list";
        helper(['form', 'url']);
		$this->data['title'] = "";
		
    }

    public function index()
	{
		$data = $this->data;
        $data['testimonial'] = $this->_Model->show();
		//var_dump($data['client']);die();
		$data['title'] = "View Testimonial";								 
        return view($this->list_url, $data);
	}
    public function edit($id)
    {
        $tot = $this->_Model->item_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url($this->index_url));
        	
    	}

		$data['setting'] = $this->commonModel->get_setting_data();
		$data['all_lang'] = $this->commonModel->all_lang();
		$error = '';
		$success = '';
		if($this->request->getPost('form1')) 
		{
			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$rules = [
                'name'         => 'required',
				'designation'         => 'required',
				'comment'         => 'required',
				
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			
		   
			$form_data = [
				'name'             => $this->request->getPost('name'),
				'designation'      => $this->request->getPost('designation'),
				'comment'            => $this->request->getPost('comment'),
				'photo'            => $this->request->getPost('photo'),
				'lang_id'            => $this->request->getPost('lang_id'),
				'id'				=>$id
			];
			//$this->_Model->_update($id,$form_data);
			$this->_Model->save($form_data);
			$success = 'Testimonial is updated successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));

		} else {
			$data['testimonial'] = $this->_Model->getData($id);
           
			return view($this->edit_url,$data);
			
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
        $success = 'Testimonial is deleted successfully';
        session()->setFlashdata('success',$success);
    	return redirect()->to(base_url($this->index_url));
    }
	
	public function add()
	{
		$data['setting'] = $this->commonModel->get_setting_data();
		$data['all_lang'] = $this->commonModel->all_lang();
		$error = '';
		$success = '';

		if($this->request->getPost('form1')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$rules = [
                'name'         => 'required',
				'designation'         => 'required',
				'comment'         => 'required',
				
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			
		    
			$form_data = [
				'name'             => $this->request->getPost('name'),
				'designation'      => $this->request->getPost('designation'),
				'comment'            => $this->request->getPost('comment'),
				'photo'            => $this->request->getPost('photo'),
				'lang_id'            => $this->request->getPost('lang_id'),
			];
			$this->_Model->save($form_data);

			$success = 'Testimonial is added successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
  
        } else { 
			
			return view($this->add_url,$data); //admin/photo/add
        }
	}


}
