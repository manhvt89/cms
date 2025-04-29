<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\WhyChooseModel;


class WhyChoose extends AdminBaseController
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
        $this->_Model = new WhyChooseModel();
        $this->commonModel = new CommonModel();
		
		$this->index_url = "admin/whychoose";
		$this->add_url = "admin/whychoose/add";
		$this->edit_url = "admin/whychoose/edit";
		$this->list_url = "admin/whychoose/list";
        helper(['form', 'url']);
		$this->data['title'] = "";
		
    }

    public function index()
	{
		$data = $this->data;
        $data['why_choose'] = $this->_Model->show();
		//var_dump($data['client']);die();
		$data['title'] = "View Why Choose";								 
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
                'icon'         => 'required',
				'name'         => 'required',
				'content'         => 'required'
	            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			
		    
			$form_data = [
				'icon'             => $this->request->getPost('icon'),
				'name'      => $this->request->getPost('name'),
				'content'            => $this->request->getPost('content'),
				'photo'            => $this->request->getPost('photo'),
				'lang_id'            => $this->request->getPost('lang_id'),
				'id'				=>$id
			];
			$this->_Model->save($form_data);
			$success = 'Why choose is updated successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));

		} else {
			$data['why_choose'] = $this->_Model->getData($id);
           
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
        $success = 'Why choose is deleted successfully';
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
                'icon'         => 'required',
				'name'         => 'required',
				'content'         => 'required'
	            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			
		    
			$form_data = [
				'icon'             => $this->request->getPost('icon'),
				'name'      => $this->request->getPost('name'),
				'content'            => $this->request->getPost('content'),
				'photo'            => $this->request->getPost('photo'),
				'lang_id'            => $this->request->getPost('lang_id')
			];
			$this->_Model->save($form_data);
			$success = 'Why choose is added successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
  
        } else { 
			$data['title'] = "Add New Pricing Table";
			return view($this->add_url,$data); //admin/photo/add
        }
	}

}
