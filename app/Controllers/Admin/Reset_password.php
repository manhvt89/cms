<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ModelForgetPassword;
use App\Models\Admin\ModelCommon;

class Reset_password extends BaseController
{
    protected $model;

    protected $commonModel;

    protected $index_url;
    public function __construct()
    {
        $this->model = new ModelForgetPassword();
        $this->index_url = 'admin/reset-password';
        $this->commonModel = new ModelCommon();
        helper(['form', 'cookie']);
    }

    public function index($token = 0)
    {
        $error = '';
        $success = '';

        $data['setting'] = $this->model->get_setting_data();
        $data['setting_data'] = $this->commonModel->get_setting_data();

        $tot = $this->model->check_url($token);
        if(!$tot) {
            return redirect()->to(base_url('admin'));
        }
        $email = $tot['email'];
        if($this->request->is('post')) {

            if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()
                        ->to($_SERVER['HTTP_REFERER']);
			}
            
            $rules = [
                        'new_password' => 'required',
                        're_password' => 'required|matches[new_password]',
                    ];

            if (!$this->validate($rules)) {
                return redirect()->to(base_url($this->index_url))->with('error', $this->validator->listErrors());
                
            }

           
            $form_data = [
                                'password' => md5($this->request->getPost('new_password')),
                                'token'    => ''
                        ];
            $this->model->_update($email,$form_data);
            $success = 'Password is updated successfully!';
            
            return redirect()->to(base_url('admin/reset_password/success'))
                            ->with('success',$success);
            
        } else {
            $data['var1'] = $email;
            $data['var2'] = $token;
            return view('admin/view_reset_password',$data);
        }   
    }

    public function success()
    {
        $data['setting'] = $this->model->get_setting_data();
        $data['setting_data'] = $this->commonModel->get_setting_data();

        return view('admin/view_reset_password_success',$data);
    }
}
