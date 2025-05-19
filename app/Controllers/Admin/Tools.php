<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\LangModel;

class Tools extends AdminBaseController
{
    protected $_Model;
    protected $commonModel;

	protected $index_url;
	protected $add_url;
	protected $edit_url;
    public function __construct()
    {
    
    }
	public function clearCache()
    {
        // Xóa cache (file-based)
        cache()->clean();

        // Nếu dùng cache file (FileHandler) thì cũng nên xóa thư mục writable/cache/*
        helper('filesystem');
        delete_files(WRITEPATH . 'cache', false, true); // xóa bên trong thư mục cache

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Cache đã được xóa thành công!',
        ]);
    }
    


}
