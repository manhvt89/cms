<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ModelLogin;
use App\Models\Admin\ModelCommon;

class Login extends BaseController
{
    protected $model;

    protected $commonModel;

    public function __construct()
    {
        $this->model = new ModelLogin();
        $this->commonModel = new ModelCommon();
    }

    public function index()
    {
        $session = session();
        $error   = '';

        $data['setting'] = $this->model->get_setting_data();


        $data['setting_data'] = $this->commonModel->get_setting_data();


        if ($session->get('logged_in')) {
            return redirect()->to(base_url('admin/dashboard'));
        }

        if ($this->request->getPost('form1')) {
            $email    = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);
            $password = $this->request->getPost('password', FILTER_SANITIZE_STRING);

            $user = $this->model->check_email($email);

            if (!$user) {
                $session->setFlashdata('error', 'Email address is wrong!');
                return redirect()->to(base_url('admin'));
            }

            if (!$this->model->check_password($email, $password)) {
                $session->setFlashdata('error', 'Password is wrong!');
                return redirect()->to(base_url('admin'));
            }

            // Đăng nhập thành công
            $session->set([
                'id'        => $user['id'],
                'email'     => $user['email'],
                'password'  => $user['password'],
                'photo'     => $user['photo'],
                'role'      => $user['role'],
                'status'    => $user['status'],
                'logged_in' => true,
            ]);
             // Lấy URL đã lưu và xóa nó sau khi sử dụng
             $redirect = session()->get('redirect_url') ?? base_url('admin/dashboard');
             return redirect()->to($redirect);
            //return redirect()->to(base_url('admin/dashboard'));
        }

        return view('admin/login', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('admin'));
    }
}
