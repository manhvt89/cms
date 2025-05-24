<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\UserModel;


class User extends AdminBaseController
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
        $this->_Model = new UserModel();
        $this->commonModel = new CommonModel();
		
		$this->index_url = "admin/user";
		$this->add_url = "admin/user/add";
		$this->edit_url = "admin/user/edit";
		$this->list_url = "admin/user/list";
        helper(['form', 'url']);
		$this->data['title'] = "";
		$this->data['all_role'] = ['Admin','Editor','Manager'];
		
    }

    public function index()
	{
		$data = $this->data;
        $data['items'] = $this->_Model->show();
		//var_dump($data['client']);die();
		$data['title'] = "View Users";								 
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
		if ($this->request->getPost('form3')) {
			$this->check_project_mode();

			if($this->request->getPost('password') != '')
			{
            
				$rules = [
					'password' => 'required',
					're_password' => 'required|matches[password]',
				];

				if (!$this->validate($rules)) {
					return redirect()->to(base_url($this->index_url))->with('error', $this->validator->listErrors());
					
				}

				$form_data = [
					'password' => md5($this->request->getPost('password')),
					'photo' => $this->request->getPost('photo')?? '',
					'role' => $this->request->getPost('role')?? 'Editor',
				];
			} else {
				$form_data = [
					'photo' => $this->request->getPost('photo')?? '',
					'role' => $this->request->getPost('role')?? 'Editor',
				];
			}
			$user_id = $this->request->getPost('user_id');
            $this->_Model->_update($user_id, $form_data);
            $this->session->set($form_data);
            return redirect()->to(base_url($this->index_url))->with('success', 'Password is updated successfully!');
        } else {
			$data['item'] = $this->_Model->getData($id);
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

        $data['team_member'] = $this->_Model->getData($id);
        

        $this->_Model->_delete($id);
        $success = 'Team Member is deleted successfully';
        session()->setFlashdata('success',$success);
    	return redirect()->to(base_url($this->index_url));
    }
	
	public function add()
	{
		$data = $this->data;
		
		$error = '';
		$success = '';

		if($this->request->getPost('form3')) {

			$this->check_project_mode();
			$rules = [
   
					'email' => [
						'label'  => 'Địa chỉ Email',
						'rules'  => 'required|valid_email|is_unique[users.email]',
						'errors' => [
							'required'     => "{field} không được để trống.",
							'valid_email'  => "{field} không đúng định dạng.",
							'is_unique'    => "{field} đã được đăng ký."
						]
					],
					'password' => [
						'label'  => 'Mật khẩu',
						'rules'  => 'required|min_length[6]',
						'errors' => [
							'required'     => '{field} không được để trống.',
							'min_length'   => '{field} phải có ít nhất {param} ký tự.'
						]
					],
					're_password' => [
						'label' => "Mật khẩu 2",
						'rules' => 'required|matches[password]',
						'errors' => [
							'matches' => '{field} khác với mật khẩu 1.'
						]
					],
				];

            if (!$this->validate($rules)) {
				session()->setFlashdata('error',$this->validator->listErrors());
                return redirect()->to(base_url($this->add_url));
			}
			
		    
			$form_data = [
				'email'             => $this->request->getPost('email'),
				'password'      => md5($this->request->getPost('password')),
				'role'            => $this->request->getPost('role'),
				'photo'            => $this->request->getPost('photo')
			];
			$this->_Model->add($form_data);

			$success = 'User is added successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
  
        } else { 
			return view($this->add_url,$data); //admin/photo/add
        }
	}

/*
	public function edit($id)
	{
    	// If there is no event in this id, then redirect
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
*/
/*

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
		*/

}
