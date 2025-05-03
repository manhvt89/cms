<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\MenuModel;
use App\Models\Admin\MenuGroupModel;

class MenuGroup extends AdminBaseController
{
    protected $_Model;
    protected $commonModel;
	protected $menuGroupModel;
	protected $menuModel;

	protected $index_url;
	protected $add_url;
	protected $edit_url;
	protected $store_url;
	protected $home_url;
    public function __construct()
    {
        $this->_Model = new MenuModel();
        $this->commonModel = new CommonModel();
		$this->menuGroupModel = new MenuGroupModel();
        $this->menuModel = new MenuModel();
		$this->index_url = "admin/menugroup/index";
		$this->add_url = "admin/menugroup/add";
		$this->store_url = "admin/menugroup/store";
		$this->edit_url = "admin/menugroup/edit";
		$this->home_url = "admin/menugroup";
        helper(['form', 'url']);
		
    }

    public function index()
	{
		$data = $this->data;
		$data['menuGroups'] = $this->menuGroupModel->findAll();
		return view($this->index_url, $data); //admin/menu
		
	}

	public function create()
    {
		$data = $this->data;
        return view($this->add_url);
    }

    public function store()
    {
        $id = $this->request->getPost('id'); // lấy id từ form (nếu có)

		$data = [
			'name' => $this->request->getPost('name'),
			'slug' => $this->request->getPost('slug')
		];

		if (!empty($id)) {
			$data['id'] = $id; // gán ID để update
			session()->setFlashdata('success','Đã cập nhật thành công');
		} else {
			session()->setFlashdata('success','Đã thêm thành công');
		}

		$this->menuGroupModel->save($data);
		
		return redirect()->to(base_url('admin/menugroup'));
		
    }

    public function edit($id)
    {
		$data = $this->data;
        $data['group'] = $this->menuGroupModel->find($id);
        return view($this->edit_url, $data);
    }

    public function delete($id)
    {
		session()->setFlashdata('success','Đã xóa thành công');
        $this->menuGroupModel->delete($id);
        return redirect()->to(base_url($this->home_url));
    }

	

}
