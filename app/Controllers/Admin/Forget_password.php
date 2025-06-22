<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ModelForgetPassword;
use App\Models\Admin\ModelCommon;

class Forget_password extends BaseController
{
    protected $model;

    protected $commonModel;

    public function __construct()
    {
        $this->model = new ModelForgetPassword();
        
        $this->commonModel = new ModelCommon();
        helper(['form', 'cookie']);
    }

    public function index()
    {
        $error = '';
        $success = '';

        $data['setting'] = $this->model->get_setting_data();
        $data['setting_data'] = $this->commonModel->get_setting_data();

        if($this->request->is('post')) {

            if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

            $rules = [
                'email' => 'trim|required|valid_email'
            ];

            if (!$this->validate($rules)) {
                return redirect()->to(base_url('/admin/forget-password'))
                        ->withInput()->with('error', $this->validator->listErrors());
            }

            $email = $this->request->getPost('email');
            $tot = $this->model->check_email($email);
            if(!$tot) {
                $error = 'You email address is not found in our system.<br>';
                return redirect()->to(base_url('/admin/forget-password'))
                        ->withInput()->with('error', $error);  
            }    
            
            $token = md5(rand());

            // Update Database
            $form_data = [
                'token' => $token
            ];
            $this->model->_update($email,$form_data);
            
            // Send Email
            $msg = '<p>To reset your password, please <a href="'.base_url("admin/reset-password/{$token}").'">click here</a> and enter a new password';
            
          

            $emailService = \Config\Services::email();

        /*
        if ($data['setting']['smtp_active'] === 'Yes') {
            $config = [
                'protocol'    => 'smtp',
                'SMTPHost'    => $data['setting']['smtp_host'],
                'SMTPPort'    => $data['setting']['smtp_port'],
                'SMTPUser'    => $data['setting']['smtp_username'],
                'SMTPPass'    => $data['setting']['smtp_password'],
                'SMTPTimeout' => 5,
                'mailType'    => 'html',
                'charset'     => 'utf-8',
            ];
            if ($data['setting']['smtp_ssl'] === 'Yes') {
                $config['SMTPCrypto'] = 'ssl';
            }

            $emailService->initialize($config);
        }
        */
            $subject = 'Forget PassWord';
            $emailService->setFrom($data['setting']['send_email_from'], 'Forget PassWord');
            $emailService->setTo($email);
            $emailService->setSubject($subject);
            $emailService->setMessage($msg);
           if ($emailService->send()) {
                return redirect()
                    ->to(base_url('admin/forget-password'))
                    ->with('success', 'An email has been sent to your address. Please follow the instructions.');
            } else {
                return redirect()
                    ->to(base_url('admin/forget-password'))
                    ->with('error', 'Email could not be sent. Please try again.');
            }
        } else {
            return view('admin/view_forget_password',$data);   
        }
    }
}
