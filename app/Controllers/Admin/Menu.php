<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\MenuModel;
use App\Models\Admin\MenuGroupModel;

class Menu extends AdminBaseController
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
        $this->_Model = new MenuModel();
        $this->commonModel = new CommonModel();
		$this->menuGroupModel = new MenuGroupModel();
        $this->menuModel = new MenuModel();
		$this->index_url = "admin/menu";
		$this->add_url = "admin/menu/add";
		$this->edit_url = "admin/menu/edit";
		$this->list_url = "admin/menu/list";
        helper(['form', 'url']);
		
    }

    public function index($groupId)
	{
		$data['group'] = $this->menuGroupModel->find($groupId);
        $data['items'] = $this->menuModel->where('group_id', $groupId)
                                         ->orderBy('sort_order', 'ASC')
                                         ->findAll();
        return view($this->list_url, $data);
	}/*

	public function edit($id)
    {
        $data['item'] = $this->menuModel->find($id);
        return view($this->add_url, $data);
    }*/


	public function create($groupId)
    {
        $data['group'] = $this->menuGroupModel->find($groupId);
        $data['parents'] = $this->menuModel->where('group_id', $groupId)
                                           ->where('parent_id', 0)
                                           ->findAll();
		$data['item'] = [
			"group_id"=>$groupId,
		];
        return view('admin/menu/form', $data);
    }

    public function store($groupId)
    {
        
		$data = [
            'group_id' => $groupId,
            'parent_id' => $this->request->getPost('parent_id') ?? 0,
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'target' => $this->request->getPost('target') ?? '_self',
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'active' => $this->request->getPost('active') ?? 1,
        ];
		$menu_id = $this->request->getPost('menu_id');

		if (!empty($menu_id)) {
			$data['menu_id'] = $menu_id; // gán ID để update
			session()->setFlashdata('success','Đã cập nhật thành công');
		} else {
			session()->setFlashdata('success','Đã thêm thành công');
		}
		$this->menuModel->save($data);
        return redirect()->to('admin/menu/index/'.$groupId);
    }

    public function edit($id)
    {
        $menu = $this->menuModel->find($id);
        $data['item'] = $menu;
        $data['group'] = $this->menuGroupModel->find($menu['group_id']);
        $data['parents'] = $this->menuModel->where('group_id', $menu['group_id'])
                                           ->where('parent_id', 0)
                                           ->findAll();
        return view('admin/menu/form', $data);
    }

    public function update($id)
    {
        $menu = $this->menuModel->find($id);
        $this->menuModel->update($id, [
            'parent_id' => $this->request->getPost('parent_id') ?? 0,
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'target' => $this->request->getPost('target') ?? '_self',
            'sort_order' => $this->request->getPost('sort_order') ?? 0,
            'active' => $this->request->getPost('active') ?? 1,
        ]);

        return redirect()->to('/admin/menu/'.$menu['menu_group_id']);
    }
	
    public function delete($id)
    {
        $menu = $this->menuModel->find($id);
        $this->menuModel->delete($id);
		session()->setFlashdata('success','Đã xóa thành công');
		
        return redirect()->to('/admin/menu/index/'.$menu['group_id']);
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
