<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class AdminBaseController extends Controller
{
    protected $session;

    protected $helpers = ['local','form','transform','admin_menu'];

    public $data = [];
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, 
                                    \CodeIgniter\HTTP\ResponseInterface $response, 
                                    \Psr\Log\LoggerInterface $logger)
    {
        // Gọi parent bắt buộc
        parent::initController($request, $response, $logger);

        // Load session
        $this->session = \Config\Services::session();

        // Kiểm tra nếu chưa đăng nhập
        if (!$this->session->get('logged_in')) {
            return redirect()->to(base_url('admin/login'))->send();
        }
        $this->data['shop_is_active'] = function_exists('shop_is_active');
        // Có thể load model, helper tại đây nếu dùng chung
    }

    public function check_project_mode()
	{
		if (PROJECT_MODE == 0) {
			session()->setFlashdata('error', PROJECT_NOTIFICATION);
			return redirect()->to($_SERVER['HTTP_REFERER']);
		}
		return null;
	}
}
