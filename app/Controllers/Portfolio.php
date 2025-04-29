<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommonModel;
use App\Models\PortfolioModel;
use CodeIgniter\Email\Email;

class Portfolio extends BaseController
{
    protected $commonModel;
    protected $_Model;

    public function __construct()
    {
        $this->commonModel     = new CommonModel();
        $this->_Model  = new PortfolioModel();
        $page = $this->commonModel->all_page_portfolio();
        $data = $this->data ?? [];
        $data['setting'] = $this->commonModel->all_setting();
        $data['page'] = $page;
        $this->data = array_merge($data,[
                                                'meta_title' => $page['mt'],
                                                'meta_description' => $page['md'],
                                                'meta_keywords' => $page['mk'],           
                                                ]);
    }

    public function index()
    {
        

        $data = array_merge($this->data, [
           // 'setting'              => $this->commonModel->all_setting(),
            'page_portfolio'      => $this->commonModel->all_page_portfolio(),
            
            'portfolio_category'   => $this->_Model->get_portfolio_category(),
            'portfolio'            => $this->_Model->get_portfolio_data(),
            'portfolio_footer'     => $this->_Model->get_portfolio_data(),
            'check_captcha'        => $this->_Model->check_captcha(),
            'total_captcha'        => $this->_Model->total_captcha()
        ]);

        return $this->render('pages/portfolio', $data);
            
    }

    public function view($slug)
    {
        if (preg_match('/-(\d+)$/', $slug, $matches)) {
            $id = $matches[1];
            $total_captcha = $this->_Model->total_captcha();
            $r_serial = mt_rand(1, $total_captcha);
            $captcha_one = $this->_Model->get_particular_captcha($r_serial);
            $page_home = $this->commonModel->all_page_home();
            
            $data = [
                'meta_title' => $page_home['title'],
                'meta_description' => $page_home['meta_description'],
                'meta_keywords' => $page_home['meta_keyword'],           
            ];
            
            $data = array_merge($data, [
                'r_serial' => $r_serial,
                'captcha_one' => $captcha_one,
                'page_home'             => $this->commonModel->all_page_home(),
                'page_portfolio'        => $this->commonModel->all_page_portfolio(),
                
                'portfolio_order_by_name'=> $this->_Model->get_portfolio_data_order_by_name(),
                'portfolio'              => $this->_Model->get_portfolio_detail($id),
                'portfolio_photo'        => $this->_Model->get_portfolio_photo($id),
                'portfolio_photo_total'  => $this->_Model->get_portfolio_photo_number($id),
                'portfolio_footer'       => $this->_Model->get_portfolio_data(),
                'check_captcha'          => $this->_Model->check_captcha(),
                'total_captcha'          => $this->_Model->total_captcha()
            ]);

            return $this->render('pages/portfolio_detail', $data);
        }
    }

    public function send_email()
    {
        $data['setting'] = $this->commonModel->all_setting();
        $checkCaptcha    = $this->_Model->check_captcha();

        $request = service('request');
        $session = session();

        if (!$this->request->getPost('form_portfolio')) {
            return redirect()->to()->back();
        }

        if (defined('PROJECT_MODE') && PROJECT_MODE == 0) {
            $session->setFlashdata('error', PROJECT_NOTIFICATION);
            return redirect()->to()->back();
        }

        $name    = $request->getPost('name', FILTER_SANITIZE_STRING);
        $phone   = $request->getPost('phone', FILTER_SANITIZE_STRING);
        $email   = $request->getPost('email', FILTER_SANITIZE_EMAIL);
        $message = $request->getPost('message', FILTER_SANITIZE_STRING);
        $portfolio = $request->getPost('portfolio', FILTER_SANITIZE_STRING);

        $errors = [];

        if (empty($name))    $errors[] = ERROR_EMPTY_NAME;
        if (empty($phone))   $errors[] = ERROR_EMPTY_PHONE;
        if (empty($email))   $errors[] = ERROR_EMPTY_EMAIL;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = ERROR_INVALID_EMAIL;
        if (empty($message)) $errors[] = ERROR_EMPTY_MESSAGE;

        // Kiểm tra CAPTCHA nếu bật
        if ($checkCaptcha['captcha_portfolio_detail'] === 'Show') {
            $r_serial = $request->getPost('r_serial');
            $captcha_input = $request->getPost('captcha_input');

            if (empty($captcha_input)) {
                $errors[] = ERROR_EMPTY_CAPTCHA;
            } else {
                $captcha = $this->_Model->get_particular_captcha($r_serial);
                if ($captcha_input !== $captcha['captcha_result']) {
                    $errors[] = ERROR_INCORRECT_CAPTCHA;
                }
            }
        }

        if (count($errors) === 0) {
            // Gửi email
            $msg = "
            <html><body>
                <h3>Thông tin gửi từ portfolio</h3>
                <b>Name:</b> {$name}<br>
                <b>Phone:</b> {$phone}<br>
                <b>Email:</b> {$email}<br>
                <b>Portfolio:</b> {$portfolio}<br>
                <b>Message:</b> {$message}
            </body></html>";

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

            $emailService->setFrom($data['setting']['send_email_from'], 'Portfolio Form');
            $emailService->setTo($data['setting']['receive_email_to']);
            $emailService->setReplyTo($email, $name);
            $emailService->setSubject('Portfolio Page Email');
            $emailService->setMessage($msg);
            $emailService->send();

            $session->setFlashdata('success', SUCCESS_PORTFOLIO_PAGE_FORM);
        } else {
            $session->setFlashdata('error', implode('<br>', $errors));
        }

        return redirect()->to()->back();
    }
}
