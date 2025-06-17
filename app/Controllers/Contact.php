<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CommonModel;
use App\Models\PortfolioModel;
use App\Models\ContactModel;
use CodeIgniter\API\ResponseTrait;
class Contact extends BaseController
{
    use ResponseTrait;
    protected $common;
    protected $portfolio;
    protected $_model;


    public function __construct()
    {
        $this->common    = new CommonModel();
        $this->portfolio = new PortfolioModel();
        $this->_model   = new ContactModel();
        $page = $this->common->all_page_contact();
        $data = $this->data ?? [];
        $data['setting'] = $this->common->all_setting();
        $data['page'] = $page;
        $this->data = array_merge($data,[
                                                'meta_title' => $page['mt'],
                                                'meta_description' => $page['md'],
                                                'meta_keywords' => $page['mk'],           
                                                ]);
    }
    public function index(): string
    {
        
        $modelCommon = new CommonModel();
        $modelContact = $this->_model;
        $modelPortfolio = new PortfolioModel();
        $data = [];
		
        $page_contact = $modelCommon->all_page_contact();
        

        $data = array_merge([],$this->data);
        $data['page_contact'] = $page_contact;
		
		
		//$data['all_news'] = $modelCommon->all_news();
		//$data['all_news_category'] = $modelCommon->all_news_category();

		
		//$data['testimonials'] = $modelContact->all_testimonial();		
		
		//$data['portfolio_category'] = $modelPortfolio->get_portfolio_category();
		//$data['portfolio'] = $modelPortfolio->get_portfolio_data();

		$data['portfolio_footer'] = $modelPortfolio->get_portfolio_data();
        $data['check_captcha'] = $modelContact->check_captcha();
		$data['total_captcha'] = $modelContact->total_captcha();
        $r_serial = mt_rand(1, $data['total_captcha']);
        $data['r_serial'] = $r_serial;             
        $data['captcha_one'] = $modelContact->get_particular_captcha($r_serial);
        return $this->render('pages/contact',$data);

    }

    

	public function send_email() 
	{
        $data['setting'] = $this->common->all_setting();
        $email = $this->request->getPost('email');
        $name = $this->request->getPost('name');
        $phone = $this->request->getPost('phone');
        $subject = $this->request->getPost('subject');
        $message = $this->request->getPost('message');
        
        $validation = \Config\Services::validation();

        $validation->setRules([
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required'     => 'Chưa nhập {field}.',
                        'valid_email'  => '{field} không đúng định dạng.',
                    ],
                ],
                'subject' => [
                    'label'  => 'Tieu de',
                    'rules'  => 'required',
                    'errors' => [
                        'required'     => 'Chưa nhập {field}.',
                    ],
                ],
                'message' => [
                    'label'  => 'Noi dung',
                    'rules'  => 'required',
                    'errors' => [
                        'required'     => 'Chưa nhập {field}.',
                    ],
                ],
            ]);

        if (!$validation->withRequest($this->request)->run()) {
            $errors = $validation->getErrors();
            $message = '';
            foreach($errors as $error)
            {
                $message = $message.'<br>'.$error;
            }
            return $this->respond(['message' => $message]);
        }

        // Thêm dữ liệu
        

        // Gửi email xác nhận
       
        $msg = $message;

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

        $emailService->setFrom($data['setting']['send_email_from'], 'Contact');
        $emailService->setTo($email);
        $emailService->setSubject($subject);
        $emailService->setMessage($msg);
        $message = '';
        if($emailService->send())
        {
            $message = 'Cảm ơn bạn đã gui email cho chung toi';
        } else {
            $message = 'Cảm ơn bạn đã đăng ký!';
        }

        // Lưu vào cơ sở dữ liệu hoặc gửi email, v.v.
        // Ví dụ: $this->newsletterModel->save(['email' => $email]);
		return $this->respond(['message' => $message]);
	}
}
