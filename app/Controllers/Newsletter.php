<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCommon;
use App\Models\ModelNewsletter;
use CodeIgniter\Email\Email;
use CodeIgniter\API\ResponseTrait;

class Newsletter extends BaseController
{
    use ResponseTrait;
    protected $commonModel;
    protected $newsletterModel;

    public function __construct()
    {
        $this->commonModel = new ModelCommon();
        $this->newsletterModel = new ModelNewsletter();
    }

    public function send()
    {
        $data['setting'] = $this->commonModel->all_setting();

        if (!$this->request->getPost('form_subscribe')) {
            return redirect()->to(base_url());
        }

        if (defined('PROJECT_MODE') && PROJECT_MODE == 0) {
            session()->setFlashdata('error', PROJECT_NOTIFICATION);
            return redirect()->back();
        }

        $email = $this->request->getPost('email_subscribe');
        $validation = \Config\Services::validation();

        $validation->setRules([
            'email_subscribe' => 'required|valid_email'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('error', $validation->getError('email_subscribe'));
            return redirect()->back()->withInput();
        }

        // Check trùng email
        if ($this->newsletterModel->total_subscriber_by_email($email)) {
            session()->setFlashdata('error', 'Email đã đăng ký trước đó!');
            return redirect()->back()->withInput();
        }

        // Thêm dữ liệu
        $key = md5(uniqid(rand(), true));
        $form_data = [
            'subs_email'     => $email,
            'subs_date'      => date('Y-m-d'),
            'subs_date_time' => date('Y-m-d H:i:s'),
            'subs_hash'      => $key,
            'subs_active'    => 0
        ];

        $this->newsletterModel->add($form_data);

        // Gửi email xác nhận
        $verification_url = base_url("newsletter/verify/$email/$key");
        $msg = 'Thanks for subscribing! Click to confirm:<br>' . $verification_url;

        $emailService = \Config\Services::email();

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

        $emailService->setFrom($data['setting']['send_email_from'], 'Newsletter');
        $emailService->setTo($email);
        $emailService->setSubject('Confirm Subscription');
        $emailService->setMessage($msg);
        $emailService->send();

        session()->setFlashdata('success', '✅ Gửi đăng ký thành công! Hãy kiểm tra email để xác nhận.');
        return redirect()->back();
    }

    public function subscribe()
    {
        $data['setting'] = $this->commonModel->all_setting();

        $email = $this->request->getPost('email');

        $validation = \Config\Services::validation();

        $validation->setRules([
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email|is_unique[tbl_subscriber.subs_email]',
                    'errors' => [
                        'required'     => 'Chưa nhập {field}.',
                        'valid_email'  => '{field} không đúng định dạng.',
                        'is_unique'    => '{field} đã được đăng ký trước đó.'
                    ],
                ],
            ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            return $this->fail(['message' => $errors['email']]);
        }

        // Thêm dữ liệu
        $key = md5(uniqid(rand(), true));
        $form_data = [
            'subs_email'     => $email,
            'subs_date'      => date('Y-m-d'),
            'subs_date_time' => date('Y-m-d H:i:s'),
            'subs_hash'      => $key,
            'subs_active'    => 0
        ];

        $this->newsletterModel->add($form_data);

        // Gửi email xác nhận
        $verification_url = base_url("newsletter/verify/{$key}");
        $msg = "Thanks for subscribing! Click to confirm:<br> {$verification_url}";

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

        $emailService->setFrom($data['setting']['send_email_from'], 'Newsletter');
        $emailService->setTo($email);
        $emailService->setSubject('Confirm Subscription');
        $emailService->setMessage($msg);
        $message = '';
        if($emailService->send())
        {
            $message = 'Cảm ơn bạn đã đăng ký! vui lòng kiểm tra email để kích hoạt';
        } else {
            $message = 'Cảm ơn bạn đã đăng ký!';
        }

        // Lưu vào cơ sở dữ liệu hoặc gửi email, v.v.
        // Ví dụ: $this->newsletterModel->save(['email' => $email]);

        return $this->respond(['message' => $message]);
    }

    public function verify( $hash = null)
    {
        if (!$hash) {
            return redirect()->to(base_url());
        }

        if (!$this->newsletterModel->check_url( $hash)) {
            return redirect()->to(base_url());
        }

        $this->newsletterModel->update_by_hash($hash, [
            'subs_hash' => '',
            'subs_active' => 1
        ]);

        $data = [
            'setting'         => $this->commonModel->all_setting(),
            'page_home'       => $this->commonModel->all_page_home(),
            'comment'         => $this->commonModel->all_comment(),
            'social'          => $this->commonModel->all_social(),
            'all_news'        => $this->commonModel->all_news()
        ];
        return $this->render('pages/view_thankyou_subscribe', $data);
    }
}
