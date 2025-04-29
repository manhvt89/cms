<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;

use App\Models\Admin\CommonModel;
use App\Models\Admin\SettingModel;

class Setting extends AdminBaseController
{
    protected $commonModel;
    protected $settingModel;

    public function __construct()
    {
        $this->commonModel = new CommonModel();
        $this->settingModel = new SettingModel();
        helper(['form', 'url']);
    }

    public function index()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->commonModel->get_setting_data();

        return view('admin/setting', $data);
	}
	public function update()
	{
		$error = '';
		$success = '';

		$data['setting'] = $this->commonModel->get_setting_data();

		if($this->request->getPost('form_logo')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    	// removing the existing photo	        
				$form_data = [
					'logo' => $this->request->getPost('logo')
                ];
	        	$this->settingModel->_update($form_data);

	        	$success = 'Logo is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url('admin/setting'));
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url('admin/setting'));
		    }
		}


		if($this->request->getPost('form_favicon')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
		    if($valid == 1) {
		    			        
				$form_data = [
					'favicon' => $this->request->getPost('favicon')
                ];
	        	$this->settingModel->_update($form_data);

	        	$success = 'Favicon is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url('admin/setting'));
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url('admin/setting'));
		    }
		}


		if($this->request->getPost('form_top_bar')) {
			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

        	$form_data = [
				'top_bar_email'    => $this->request->getPost('top_bar_email'),
				'top_bar_phone'    => $this->request->getPost('top_bar_phone')
            ];
        	$this->settingModel->_update($form_data);   	
        	$success = 'Top Bar Setting is updated successfully!';
        	session()->setFlashdata('success',$success);
		    return redirect()->to(base_url('admin/setting'));
		}


		if($this->request->getPost('form_email')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$send_email_from  = $this->request->getPost('send_email_from');
			$receive_email_to = $this->request->getPost('receive_email_to');
			$smtp_active      = $this->request->getPost('smtp_active');
			$smtp_ssl         = $this->request->getPost('smtp_ssl');
			$smtp_host        = $this->request->getPost('smtp_host');
			$smtp_port        = $this->request->getPost('smtp_port');
			$smtp_username    = $this->request->getPost('smtp_username');
			$smtp_password    = $this->request->getPost('smtp_password');

        	$form_data = [
				'send_email_from'  => $send_email_from,
				'receive_email_to' => $receive_email_to,
				'smtp_active'      => $smtp_active,
				'smtp_ssl'         => $smtp_ssl,
				'smtp_host'        => $smtp_host,
				'smtp_port'        => $smtp_port,
				'smtp_username'    => $smtp_username,
				'smtp_password'    => $smtp_password
            ];
        	$this->settingModel->_update($form_data);   	
        	$success = 'Email Setting is updated successfully!';
        	session()->setFlashdata('success',$success);
		    return redirect()->to(base_url('admin/setting'));
		}
       
		if($this->request->getPost('form_sidebar')) {

            //var_dump('123');die();
			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

        	$form_data = [
				'sidebar_total_recent_post'    => $this->request->getPost('sidebar_total_recent_post'),
				'sidebar_total_upcoming_event' => $this->request->getPost('sidebar_total_upcoming_event'),
				'sidebar_total_past_event'     => $this->request->getPost('sidebar_total_past_event')
            ];
            //var_dump($form_data);die();
        	$this->settingModel->_update($form_data);   	
        	$success = 'Sidebar Setting is updated successfully!';
        	session()->setFlashdata('success',$success);
		    return redirect()->to(base_url('admin/setting'));
		}

		if($this->request->getPost('form_color')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

        	$form_data = [
				'front_end_color' => $this->request->getPost('front_end_color')
            ];
        	$this->settingModel->_update($form_data);   	
        	$success = 'Front End Color Setting is updated successfully!';
        	session()->setFlashdata('success',$success);
		    return redirect()->to(base_url('admin/setting'));
		}


		if($this->request->getPost('form_language')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				redirect()->to($_SERVER['HTTP_REFERER']);
			}

        	$form_data = [
				'language_status' => $this->request->getPost('language_status')
            ];
        	$this->settingModel->_update($form_data);   	
        	$success = 'Language Status Setting is updated successfully!';
        	session()->setFlashdata('success',$success);
		    return redirect()->to(base_url('admin/setting'));
		}


		if($this->request->getPost('form_other')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

        	$form_data = [
				'website_name' => $this->request->getPost('website_name'),
				'preloader_status' => $this->request->getPost('preloader_status'),
				'tawk_live_chat_code' => $this->request->getPost('tawk_live_chat_code'),
				'tawk_live_chat_status' => $this->request->getPost('tawk_live_chat_status')
            ];
        	$this->settingModel->_update($form_data);   	
        	$success = 'Other Setting is updated successfully!';
        	session()->setFlashdata('success',$success);
		    return redirect()->to(base_url('admin/setting'));
		}

		if($this->request->getPost('form_banner_about')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    		    			        
				$form_data = [
					'banner_about' => $this->request->getPost('banner_about')
                ];
                //var_dump($form_data);die();
	        	$this->settingModel->_update($form_data);
	        	$success = 'About Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url('admin/setting'));
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}

		if($this->request->getPost('form_banner_faq')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    		    			        
				$form_data = array(
					'banner_faq' => $this->request->getPost('banner_faq')
	            );
	        	$this->settingModel->_update($form_data);
	        	$success = 'FAQ Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	redirect()->to(base_url().'admin/setting');
		    } else {
		    	session()->setFlashdata('error',$error);
		    	redirect()->to(base_url().'admin/setting');
		    }
		}


		if($this->request->getPost('form_banner_service')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    		    			        
				$form_data = array(
					'banner_service' => $this->request->getPost('banner_service')
	            );
	        	$this->settingModel->_update($form_data);
	        	$success = 'Service Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url().'admin/setting');
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}


		if($this->request->getPost('form_banner_testimonial')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    			    			        
				$form_data = array(
					'banner_testimonial' => $this->request->getPost('banner_testimonial')
	            );
	        	$this->settingModel->_update($form_data);
	        	$success = 'Testimonial Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url().'admin/setting');
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}


		if($this->request->getPost('form_banner_news')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    			    			        
				$form_data = array(
					'banner_news' => $this->request->getPost('banner_news')
	            );
	        	$this->settingModel->_update($form_data);
	        	$success = 'News Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url().'admin/setting');
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}


		if($this->request->getPost('form_banner_event')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    		    			        
				$form_data = array(
					'banner_event' => $this->request->getPost('banner_event')
	            );
	        	$this->settingModel->_update($form_data);
	        	$success = 'Event Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url().'admin/setting');
		    } else {
		    	session()->setFlashdata('error',$error);
		    	redirect()->to(base_url().'admin/setting');
		    }
		}


		if($this->request->getPost('form_banner_contact')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    		    			        
				$form_data = [
					'banner_contact' => $this->request->getPost('banner_contact')
                ];
	        	$this->settingModel->_update($form_data);
	        	$success = 'Contact Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url().'admin/setting');
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}


		if($this->request->getPost('form_banner_search')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    			    			        
				$form_data = array(
					'banner_search' => $this->request->getPost('banner_search')
	            );
	        	$this->settingModel->_update($form_data);
	        	$success = 'Search Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url().'admin/setting');
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}



		if($this->request->getPost('form_banner_terms')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    	    			        
				$form_data = [
					'banner_terms' => $this->request->getPost('banner_terms')
                ];
	        	$this->settingModel->_update($form_data);
	        	$success = 'Terms and Conditions Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url().'admin/setting');
		    } else {
		    	session()->setFlashdata('error',$error);
		    	redirect()->to(base_url().'admin/setting');
		    }
		}

		if($this->request->getPost('form_banner_privacy')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    		    			        
				$form_data = array(
					'banner_privacy' => $this->request->getPost('banner_privacy')
	            );
	        	$this->settingModel->_update($form_data);
	        	$success = 'Privacy Policy Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url('admin/setting'));
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}

		

		if($this->request->getPost('form_banner_team')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    		    			        
				$form_data = [
					'banner_team' => $this->request->getPost('banner_team')
                ];
	        	$this->settingModel->_update($form_data);
	        	$success = 'Team Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url().'admin/setting');
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}


		if($this->request->getPost('form_banner_portfolio')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    		    			        
				$form_data = [
					'banner_portfolio' => $this->request->getPost('banner_portfolio')
                ];
	        	$this->settingModel->_update($form_data);
	        	$success = 'Portfolio Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url('admin/setting'));
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}
		

		if($this->request->getPost('form_banner_verify_subscriber')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    		    			        
				$form_data = [
					'banner_verify_subscriber' => $this->request->getPost('banner_verify_subscriber')
                ];
	        	$this->settingModel->_update($form_data);
	        	$success = 'Verify Subscriber Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url().'admin/setting');
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}


		if($this->request->getPost('form_banner_pricing')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    		    			        
				$form_data = [
					'banner_pricing' => $this->request->getPost('banner_pricing')
                ];
	        	$this->settingModel->_update($form_data);
	        	$success = 'Pricing Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url('admin/setting'));
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}


		if($this->request->getPost('form_banner_photo_gallery')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			
		    if($valid == 1) {
		    		    			        
				$form_data = [
					'banner_photo_gallery' => $this->request->getPost('banner_photo_gallery')
                ];
	        	$this->settingModel->_update($form_data);
	        	$success = 'Photo Gallery Page Banner is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url().'admin/setting');
		    } else {
		    	session()->setFlashdata('error',$error);
		    	return redirect()->to(base_url().'admin/setting');
		    }
		}


		if($this->request->getPost('form_payment')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}
			
        	$form_data = [
				'paypal_email'      => $this->request->getPost('paypal_email'),
				'stripe_public_key' => $this->request->getPost('stripe_public_key'),
				'stripe_secret_key' => $this->request->getPost('stripe_secret_key'),
				'bank_detail'       => $this->request->getPost('bank_detail')
            ];
        	$this->settingModel->_update($form_data);   	
        	$success = 'Payment Setting is updated successfully!';
        	session()->setFlashdata('success',$success);
		    return redirect()->to(base_url('admin/setting'));
		}

		return view('admin/setting',$data);
		
	}
}
