<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\PricingModel;


class Pricing extends AdminBaseController
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
        $this->_Model = new PricingModel();
        $this->commonModel = new CommonModel();
		
		$this->index_url = "admin/pricing";
		$this->add_url = "admin/pricing/add";
		$this->edit_url = "admin/pricing/edit";
		$this->list_url = "admin/pricing/list";
        helper(['form', 'url']);
		$this->data['title'] = "";
		
    }

    public function index()
	{
		$data = $this->data;
        $data['pricing_table'] = $this->_Model->show();
		//var_dump($data['client']);die();
		$data['title'] = "View Pricing Table";								 
        return view($this->list_url, $data);
	}
    public function edit($id)
    {
        $tot = $this->_Model->item_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url($this->index_url));
        	
    	}
		$data = $this->data;
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
				'title'         => 'required',
				'price'         => 'required',
				'subtitle'         => 'required',
				'text'         => 'required',
				'button_text'         => 'required',
				'button_url'         => 'required',
	            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			
		    
			$form_data = [
				'icon'             => $this->request->getPost('icon'),
				'title'      => $this->request->getPost('title'),
				'price'            => $this->request->getPost('price'),
				'subtitle'            => $this->request->getPost('subtitle'),
				'text'            => $this->request->getPost('text'),
				'button_text'            => $this->request->getPost('button_text'),
				'button_url'            => $this->request->getPost('button_url'),
				'lang_id'            => $this->request->getPost('lang_id'),
				'id'				=>$id
			];
			$this->_Model->save($form_data);
			$success = 'Pricing table is updated successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));

		} else {
			$data['pricing_table'] = $this->_Model->getData($id);
           
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
        $success = 'Pricing table is deleted successfully';
        session()->setFlashdata('success',$success);
    	return redirect()->to(base_url($this->index_url));
    }
	
	public function add()
	{
		$data = $this->data;
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
				'title'         => 'required',
				'price'         => 'required',
				'subtitle'         => 'required',
				'text'         => 'required',
				'button_text'         => 'required',
				'button_url'         => 'required',
	            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			
		    
			$form_data = [
				'icon'             => $this->request->getPost('icon'),
				'title'      => $this->request->getPost('title'),
				'price'            => $this->request->getPost('price'),
				'subtitle'            => $this->request->getPost('subtitle'),
				'text'            => $this->request->getPost('text'),
				'button_text'            => $this->request->getPost('button_text'),
				'button_url'            => $this->request->getPost('button_url'),
				'lang_id'            => $this->request->getPost('lang_id'),
			];
			$this->_Model->save($form_data);
			$success = 'Pricing Table is added successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
  
        } else { 
			$data['title'] = "Add New Pricing Table";
			return view($this->add_url,$data); //admin/photo/add
        }
	}

}
