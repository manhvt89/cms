<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\PhotoModel;

class Photo extends AdminBaseController
{
    protected $photoModel;
    protected $commonModel;

	protected $index_url;
	protected $add_url;
	protected $edit_url;
    public function __construct()
    {
        $this->photoModel = new PhotoModel();
        $this->commonModel = new CommonModel();
		$this->index_url = "admin/photo";
		$this->add_url = "admin/photo/add";
		$this->edit_url = "admin/photo/edit";
        helper(['form', 'url']);
		
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->commonModel->get_setting_data();
		$data['photo'] = $this->photoModel->show();
        return view($this->index_url, $data); //admin/photo
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
                'photo_name'         => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			
		    
			
			$form_data = [
				'photo_name'         => $this->request->getPost('photo_name'),	
			];
			$this->photoModel->add($form_data);

			$success = 'Photo is added successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
		    
            
        } else { 
			return view($this->add_url,$data); //admin/photo/add
        }
	}


	public function edit($id)
	{
		
    	// If there is no event in this id, then redirect
    	$tot = $this->photoModel->event_check($id);
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
                'photo_name'         => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
		    
			$form_data = [
				'photo_name' => $this->request->getPost('photo_name')
			];
			$this->photoModel->_update($id,$form_data);

			$success = 'Photo is updated successfully';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
		   
		} else {
			$data['photo'] = $this->photoModel->getData($id);
			return view($this->edit_url,$data); //'admin/photo/edit'
		}

	}


	public function delete($id) 
	{
    	$tot = $this->photoModel->event_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url($this->index_url));
    	}
		if(PROJECT_MODE == 0) {
			session()->setFlashdata('error',PROJECT_NOTIFICATION);
			return redirect()->to($_SERVER['HTTP_REFERER']);
		}
        $this->photoModel->_delete($id);
        $success = 'Photo is deleted successfully';
		session()->setFlashdata('success',$success);
		return redirect()->to(base_url($this->index_url));
    }

}
