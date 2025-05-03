<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\PortfolioModel;

class Portfolio extends AdminBaseController
{
    protected $_Model;
    protected $commonModel;

	protected $index_url;
	protected $add_url;
	protected $edit_url;
    public function __construct()
    {
        $this->_Model = new PortfolioModel();
        $this->commonModel = new CommonModel();
		$this->index_url = "admin/portfolio";
		$this->add_url = "admin/portfolio/add";
		$this->edit_url = "admin/portfolio/edit";
        helper(['form', 'url']);
		
    }

    public function index()
	{
		$data = $this->data;

		$data['setting'] = $this->commonModel->get_setting_data();
		
		$_portfolio = $this->_Model->show();
		$data['portfolio'] = $_portfolio;
		foreach($_portfolio as $row)
		{
			$data['all_photos'][$row['id']] = $this->_Model->get_all_photos_by_category_id($row['id']);
		}
        return view($this->index_url, $data); //admin/photo
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
                'name'         => 'required',
				'short_content'         => 'required',
				'content'         => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			
		    $meta_title = get_meta('meta_title',$this->request->getPost('name'));
			$meta_keyword = get_meta('meta_keyword',$this->request->getPost('name'));
			$meta_description = get_meta('meta_description',$this->request->getPost('short_content'));
			
			$form_data = [
				'name'             => $this->request->getPost('name'),
				'short_content'    => $this->request->getPost('short_content'),
				'content'          => $this->request->getPost('content'),
				'client_name'      => $this->request->getPost('client_name'),
				'client_company'   => $this->request->getPost('client_company'),
				'start_date'       => $this->request->getPost('start_date'),
				'end_date'         => $this->request->getPost('end_date'),
				'website'          => $this->request->getPost('website'),
				'cost'             => $this->request->getPost('cost'),
				'client_comment'   => $this->request->getPost('client_comment'),
				'category_id'      => $this->request->getPost('category_id'),
				'photo'            => $this->request->getPost('photo'),
				'meta_title'       => $meta_title,
				'meta_keyword'     => $meta_keyword,
				'meta_description' => $meta_description,
				'lang_id'          => $this->request->getPost('lang_id')
			];
			$this->_Model->add($form_data);

			$success = 'Portfolio is added successfully!';
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
				'short_content'         => 'required',
				'content'         => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->to()->back()->withInput()->with('error', $this->validator->getErrors());
            }

			$meta_title = get_meta('meta_title',$this->request->getPost('name'));
			$meta_keyword = get_meta('meta_keyword',$this->request->getPost('name'));
			$meta_description = get_meta('meta_description',$this->request->getPost('short_content'));
			
		    
			$form_data = [
				'name'             => $this->request->getPost('name'),
				'short_content'    => $this->request->getPost('short_content'),
				'content'          => $this->request->getPost('content'),
				'client_name'      => $this->request->getPost('client_name'),
				'client_company'   => $this->request->getPost('client_company'),
				'start_date'       => $this->request->getPost('start_date'),
				'end_date'         => $this->request->getPost('end_date'),
				'website'          => $this->request->getPost('website'),
				'cost'             => $this->request->getPost('cost'),
				'client_comment'   => $this->request->getPost('client_comment'),
				'category_id'      => $this->request->getPost('category_id'),
				'photo'            => $this->request->getPost('photo'),
				'meta_title'       => $meta_title,
				'meta_keyword'     => $meta_keyword,
				'meta_description' => $meta_description,
				'lang_id'          => $this->request->getPost('lang_id')
			];
			//var_dump();die();
			$this->_Model->_update($id,$form_data);

			$success = 'Portfolio is updated successfully';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
		   
		} else {
			$data['portfolio'] = $this->_Model->getData($id);
			$data['all_photo_category'] = $this->_Model->get_all_photo_category();
			$data['all_photos_by_id'] = $this->_Model->get_all_photos_by_category_id($id);
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
        $success = 'Item is deleted successfully';
		session()->setFlashdata('success',$success);
		return redirect()->to(base_url($this->index_url));
    }

}
