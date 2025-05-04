<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelCommon;
use App\Models\PortfolioModel;
use App\Models\ModelHome;
class Home extends BaseController
{
    protected $helpers = ['slider'];
	public function index(): string
    {
        
        $modelCommon = new ModelCommon();
        $modelHome = new ModelHome();
        $modelPortfolio = new PortfolioModel();
        $data = [];
		$page_home = $modelCommon->all_page_home();
		
        $data = [
            'meta_title' => $page_home['title'],
            'meta_description' => $page_home['meta_description'],
            'meta_keywords' => $page_home['meta_keyword'],           
        ];

        $data['page_home'] = $page_home;

		

		$data['page_home_lang_independent'] = $modelCommon->all_page_home_lang_independent();
		$data['comment'] = $modelCommon->all_comment();
		
		$data['all_news'] = $modelCommon->all_news();
		$data['all_news_category'] = $modelCommon->all_news_category();

		$data['home_sliders'] = $modelHome->all_slider();
        //var_dump($data['sliders']);die();
		$data['services'] = $modelHome->all_service();
		$data['features'] = $modelHome->all_feature();
		$data['why_choose'] = $modelHome->all_why_choose();
		$data['team_members'] = $modelHome->all_team_member();
		$data['testimonials'] = $modelHome->all_testimonial();		
		$data['clients'] = $modelHome->all_client();
		$data['pricing_table'] = $modelHome->all_pricing_table();
		$data['home_faq'] = $modelHome->all_faq_home();

		$data['portfolio_category'] = $modelPortfolio->get_portfolio_category();
		$data['portfolio'] = $modelPortfolio->get_portfolio_data();
		$data['portfolio_footer'] = $modelPortfolio->get_portfolio_data();
        return $this->render('pages/home',$data);

    }

	public function send_email()
	{
		$commonModel = new ModelCommon();
		$email = \Config\Services::email();
		$emailConfig = config('Email');
		//var_dump($emailConfig); die();
		$email->initialize($emailConfig);


		$data['setting'] = $commonModel->all_setting();

		$error = '';

		if($this->request->getPost('form_quick_contact')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			$first_name = $this->request->getPost('first_name');
			$last_name = $this->request->getPost('last_name');
			$phone = $this->request->getPost('phone');
			$_semail = $this->request->getPost('email');
			$subject = $this->request->getPost('subject');
			$message = $this->request->getPost('message');

			if(empty($first_name))
		    {
		        $valid = 0;
		        $error .= 'Lỗi Tên để trống'.'<br>';
		    }

		    if(empty($last_name))
		    {
		        $valid = 0;
		        $error .= 'Họ để trống'.'<br>';
		    }

		    if(empty($phone))
		    {
		        $valid = 0;
		        $error .= 'Điện thoại để trống'.'<br>';
		    }

		    if(empty($_semail))
		    {
		        $valid = 0;
		        $error .= 'Email để trống'.'<br>';
		    }
		    else
		    {
		    	// Email validation check
		        if(!filter_var($_semail, FILTER_VALIDATE_EMAIL))
		        {
		            $valid = 0;
		            $error .= 'Định dạng email không đúng'.'<br>';
		        }
		    }

		    if(empty($subject))
		    {
		        $valid = 0;
		        $error .= 'Tiêu đề trống'.'<br>';
		    }

		    if(empty($message))
		    {
		        $valid = 0;
		        $error .= 'Nội dung trống'.'<br>';
		    }

		    if($valid == 1)
		    {
				$msg = '
				<html><head><title>Email Sending</title></head><body>
            		<h3>Sender Information</h3>
					<b>First Name: </b> '.$first_name.'<br><br>
					<b>Last Name: </b> '.$last_name.'<br><br>
					<b>Phone: </b> '.$phone.'<br><br>
					<b>Email: </b> '.$_semail.'<br><br>
					<b>Subject: </b> '.$subject.'<br><br>
					<b>Message: </b> '.$message.'</body></html>';

				
				$email->setFrom('manhvt89@gmail.com', 'Manh Vu Thanh');
				$email->setTo($_semail);
				$email->setSubject($subject);
				$email->setMessage($msg);
		
				if ($email->send()) {
					//echo 'Email sent successfully!';
					$success = 'Thank you for sending the email. We will contact you shortly.';
        			session()->setFlashdata('success',$success);
					return redirect()->to(base_url('/home'));
				} else {
					//echo 'Failed to send email';
					//print_r($email->printDebugger(['headers']));
					session()->setFlashdata('error',$error);
				}

				

		        

		    } 
		    else
		    {
        		session()->setFlashdata('error',$error);
		    }

			return redirect()->to(base_url());
            
        } else {
            
            return redirect()->to(base_url());
        }
	}
}
