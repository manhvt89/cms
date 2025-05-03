<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\TeamModel;


class Team extends AdminBaseController
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
        $this->_Model = new TeamModel();
        $this->commonModel = new CommonModel();
		
		$this->index_url = "admin/team";
		$this->add_url = "admin/team/add";
		$this->edit_url = "admin/team/edit";
		$this->list_url = "admin/team/list";
        helper(['form', 'url']);
		$this->data['title'] = "";
		
    }

    public function index()
	{
		$data = $this->data;
        $data['team_member'] = $this->_Model->show();
		$data['title'] = "View Team";								 
        return view($this->list_url, $data);
	}/*

	public function edit($id)
    {
        $data['item'] = $this->menuModel->find($id);
        return view($this->add_url, $data);
    }*/


	public function create($groupId)
    {
		$data = $this->data;
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
				'designation'         => 'required',
				'photo'         => 'required',
				
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			
		    $meta_title = get_meta('meta_title',$this->request->getPost('name'));
			$meta_keyword = get_meta('meta_keyword',$this->request->getPost('name'));
			$meta_description = get_meta('meta_description',$this->request->getPost('designation'));
			
			$form_data = [
				'name'             => $this->request->getPost('name'),
				'designation'      => $this->request->getPost('designation'),
				'photo'            => $this->request->getPost('photo'),
				'detail'           => $this->request->getPost('detail'),
				'facebook'         => $this->request->getPost('facebook'),
				'twitter'          => $this->request->getPost('twitter'),
				'linkedin'         => $this->request->getPost('linkedin'),
				'youtube'          => $this->request->getPost('youtube'),
				'google_plus'      => $this->request->getPost('google_plus'),
				'instagram'        => $this->request->getPost('instagram'),
				'flickr'           => $this->request->getPost('flickr'),
				'phone'            => $this->request->getPost('phone'),
				'email'            => $this->request->getPost('email'),
				'website'          => $this->request->getPost('website'),
				'meta_title'       => $meta_title,
				'meta_keyword'     => $meta_keyword,
				'meta_description' => $meta_description,
				'lang_id'          => $this->request->getPost('lang_id')
			];
			$this->_Model->_update($id,$form_data);

			$success = 'Team is updated successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));

		} else {
			$data['team_member'] = $this->_Model->getData($id);
           
			return view($this->edit_url,$data);
			
		}
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
				'photo'         => 'required',
				
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			
		    $meta_title = get_meta('meta_title',$this->request->getPost('name'));
			$meta_keyword = get_meta('meta_keyword',$this->request->getPost('name'));
			$meta_description = get_meta('meta_description',$this->request->getPost('designation'));
			
			$form_data = [
				'name'             => $this->request->getPost('name'),
				'designation'      => $this->request->getPost('designation'),
				'photo'            => $this->request->getPost('photo'),
				'detail'           => $this->request->getPost('detail'),
				'facebook'         => $this->request->getPost('facebook'),
				'twitter'          => $this->request->getPost('twitter'),
				'linkedin'         => $this->request->getPost('linkedin'),
				'youtube'          => $this->request->getPost('youtube'),
				'google_plus'      => $this->request->getPost('google_plus'),
				'instagram'        => $this->request->getPost('instagram'),
				'flickr'           => $this->request->getPost('flickr'),
				'phone'            => $this->request->getPost('phone'),
				'email'            => $this->request->getPost('email'),
				'website'          => $this->request->getPost('website'),
				'meta_title'       => $meta_title,
				'meta_keyword'     => $meta_keyword,
				'meta_description' => $meta_description,
				'lang_id'          => $this->request->getPost('lang_id')
			];
			$this->_Model->add($form_data);

			$success = 'Team is added successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
  
        } else { 
			return view($this->add_url,$data); //admin/photo/add
        }
	}
}
