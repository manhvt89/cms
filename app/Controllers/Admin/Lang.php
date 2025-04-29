<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\LangModel;

class Lang extends AdminBaseController
{
    protected $_Model;
    protected $commonModel;

	protected $index_url;
	protected $add_url;
	protected $edit_url;
    public function __construct()
    {
        $this->_Model = new LangModel();
        $this->commonModel = new CommonModel();
		$this->index_url = "admin/lang";
		$this->add_url = "admin/lang/add";
		$this->edit_url = "admin/lang/edit";
        helper(['form', 'url']);
		
    }

    public function index()
	{
		$error = '';
		$success = '';
		$data['setting'] = $this->commonModel->get_setting_data();
		$_items = $this->_Model->show();
		$data['lang'] = $_items;
        return view($this->index_url, $data); //admin/lang
	}

	public function add()
	{
		$data['setting'] = $this->commonModel->get_setting_data();
		
		$next_id = $this->_Model->get_auto_increment_id();
		foreach ($next_id as $row) {
            $ai_id = $row['Auto_increment'];
        }

		$lang_name = $this->request->getPost('lang_name');
		$lang_short_name = $this->request->getPost('lang_short_name');
		$layout_direction = $this->request->getPost('layout_direction');
		$lang_default = $this->request->getPost('lang_default');
		if(PROJECT_MODE == 1) {
			if($lang_default == 1)
			{
				// Update others as empty
				$arr = [
					'lang_default' => ''
				];
				$this->_Model->make_all_empty($arr);

				// Make this one 'Yes'
				$lang_default = 'Yes';
			}
			else
			{
				$lang_default = '';	
			}
		}

		$error = '';
		$success = '';


		if($this->request->getPost('form1')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$rules = [
                'lang_name'         => 'required',
				'lang_short_name'         => 'required',
				'layout_direction'         => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->to()->back()->withInput()->with('error', $this->validator->getErrors());
            }

			$form_data = [
				'lang_name' => $lang_name,
				'lang_short_name' => $lang_short_name,
				'layout_direction' => $layout_direction,
				'lang_default' => $lang_default
			];
			$this->_Model->add($form_data);
			
			$temp_arr = [
				'HOME',
				'ABOUT',
				'TEAM',
				'PAGE',
				'EVENT',
				'PHOTO_GALLERY',
				'TESTIMONIAL',
				'FAQ',
				'PRICING_TABLE',
				'SERVICE',
				'PORTFOLIO',
				'NEWS',
				'CONTACT',
				'SEARCH_FOR',
				'READ_MORE',
				'SUBMIT',
				'FIRST_NAME',
				'LAST_NAME',
				'PHONE_NUMBER',
				'EMAIL_ADDRESS',
				'ADDRESS',
				'MESSAGE',
				'START_DATE',
				'END_DATE',
				'EVENT_START_DATE',
				'EVENT_END_DATE',
				'EVENT_LOCATION_MAP',
				'SHARE_THIS_EVENT',
				'SHARE_THIS_NEWS',
				'COMMENT',
				'NAME',
				'ALL',
				'PROJECT_OVERVIEW',
				'CATEGORY',
				'CLIENT_NAME',
				'CLIENT_COMPANY_NAME',
				'PROJECT_START_DATE',
				'PROJECT_END_DATE',
				'CLIENT_COMMENT',
				'NEWS_DATE',
				'RECENT_PORTFOLIO',
				'RECENT_PORTFOLIO_SUBTITLE',
				'CONTACT_FORM',
				'SEND_MESSAGE',
				'SUBJECT',
				'NO_RESULT_FOUND',
				'TERMS_AND_CONDITIONS',
				'PRIVACY_POLICY',
				'SUCCESS_SUBSCRIPTION',
				'FOOTER_1_HEADING',
				'FOOTER_2_HEADING',
				'FOOTER_3_HEADING',
				'FOOTER_4_HEADING',
				'SIDEBAR_NEWS_HEADING_1',
				'SIDEBAR_NEWS_HEADING_2',
				'SIDEBAR_EVENT_HEADING_1',
				'SIDEBAR_EVENT_HEADING_2',
				'SIDEBAR_SERVICE_HEADING_1',
				'SIDEBAR_SERVICE_HEADING_2',
				'SIDEBAR_PORTFOLIO_HEADING_1',
				'SIDEBAR_PORTFOLIO_HEADING_2',
				'ERROR_EMPTY_NAME',
				'ERROR_EMPTY_FIRST_NAME',
				'ERROR_EMPTY_LAST_NAME',
				'ERROR_EMPTY_PHONE',
				'ERROR_EMPTY_EMAIL',
				'ERROR_INVALID_EMAIL',
				'ERROR_EXIST_EMAIL',
				'ERROR_EMPTY_SUBJECT',
				'ERROR_EMPTY_MESSAGE',
				'ERROR_EMPTY_CAPTCHA',
				'ERROR_INCORRECT_CAPTCHA',
				'SUCCESS_CONTACT_FORM',
				'SUCCESS_SUBSCRIPTION_FORM',
				'SUCCESS_SERVICE_PAGE_FORM',
				'SUCCESS_PORTFOLIO_PAGE_FORM'
			];

			for($i=0;$i<count($temp_arr);$i++)
			{
				$form_data = [
					'lang_string' => $temp_arr[$i],
					'lang_string_value' => '',
					'lang_id' => $ai_id
				];
				$this->_Model->add_detail($form_data);
			}

			// Adding Item in tbl_page_home
			$form_data = [
				'title' => 'Home Page',
				'meta_keyword' => '',
				'meta_description' => '',
				'home_welcome_title' => '',
				'home_welcome_subtitle' => '',
				'home_welcome_text' => '',
				'home_welcome_pbar1_text' => '',
				'home_welcome_pbar1_value' => '',
				'home_welcome_pbar2_text' => '',
				'home_welcome_pbar2_value' => '',
				'home_welcome_pbar3_text' => '',
				'home_welcome_pbar3_value' => '',
				'home_welcome_pbar4_text' => '',
				'home_welcome_pbar4_value' => '',
				'home_welcome_pbar5_text' => '',
				'home_welcome_pbar5_value' => '',
				'home_why_choose_title' => '',
				'home_why_choose_subtitle' => '',
				'home_feature_title' => '',
				'home_feature_subtitle' => '',
				'home_service_title' => '',
				'home_service_subtitle' => '',
				'counter_1_title' => '',
				'counter_1_value' => '',
				'counter_1_icon' => '',
				'counter_2_title' => '',
				'counter_2_value' => '',
				'counter_2_icon' => '',
				'counter_3_title' => '',
				'counter_3_value' => '',
				'counter_3_icon' => '',
				'counter_4_title' => '',
				'counter_4_value' => '',
				'counter_4_icon' => '',
				'home_portfolio_title' => '',
				'home_portfolio_subtitle' => '',
				'home_booking_form_title' => '',
				'home_booking_faq_title' => '',
				'home_team_title' => '',
				'home_team_subtitle' => '',
				'home_ptable_title' => '',
				'home_ptable_subtitle' => '',
				'home_testimonial_title' => '',
				'home_testimonial_subtitle' => '',
				'home_blog_title' => '',
				'home_blog_subtitle' => '',
				'home_cta_text' => '',
				'home_cta_button_text' => '',
				'home_cta_button_url' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_home($form_data);

			// Adding Item in tbl_page_about
			$form_data = array(
				'about_heading' => 'About Heading',
				'about_content' => 'About Content',
				'mt_about' => '',
				'mk_about' => '',
				'md_about' => '',
				'lang_id' => $ai_id
			);
			$this->_Model->add_page_about($form_data);


			// Adding Item in tbl_page_faq
			$form_data = [
				'faq_heading' => 'FAQ Heading',
				'mt_faq' => '',
				'mk_faq' => '',
				'md_faq' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_faq($form_data);


			// Adding Item in tbl_page_service
			$form_data = [
				'service_heading' => 'Service Heading',
				'mt_service' => '',
				'mk_service' => '',
				'md_service' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_service($form_data);


			// Adding Item in tbl_page_testimonial
			$form_data = [
				'testimonial_heading' => 'Testimonial Heading',
				'mt_testimonial' => '',
				'mk_testimonial' => '',
				'md_testimonial' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_testimonial($form_data);


			// Adding Item in tbl_page_news
			$form_data = [
				'news_heading' => 'News Heading',
				'mt_news' => '',
				'mk_news' => '',
				'md_news' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_news($form_data);


			// Adding Item in tbl_page_event
			$form_data = [
				'event_heading' => 'Event Heading',
				'mt_event' => '',
				'mk_event' => '',
				'md_event' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_event($form_data);


			// Adding Item in tbl_page_search
			$form_data = [
				'search_heading' => 'Search Heading',
				'mt_search' => '',
				'mk_search' => '',
				'md_search' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_search($form_data);


			// Adding Item in tbl_page_term
			$form_data = [
				'term_heading' => 'Term Heading',
				'term_content' => 'Term Content',
				'mt_term' => '',
				'mk_term' => '',
				'md_term' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_term($form_data);


			// Adding Item in tbl_page_privacy
			$form_data = [
				'privacy_heading' => 'Privacy Heading',
				'privacy_content' => 'Privacy Content',
				'mt_privacy' => '',
				'mk_privacy' => '',
				'md_privacy' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_privacy($form_data);


			// Adding Item in tbl_page_team
			$form_data = [
				'team_heading' => 'Team Heading',
				'mt_team' => '',
				'mk_team' => '',
				'md_team' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_team($form_data);

			// Adding Item in tbl_page_portfolio
			$form_data = [
				'portfolio_heading' => 'Portfolio Heading',
				'mt_portfolio' => '',
				'mk_portfolio' => '',
				'md_portfolio' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_portfolio($form_data);

			// Adding Item in tbl_page_photo_gallery
			$form_data = [
				'photo_gallery_heading' => 'Photo Gallery Heading',
				'mt_photo_gallery' => '',
				'mk_photo_gallery' => '',
				'md_photo_gallery' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_photo_gallery($form_data);

			// Adding Item in tbl_page_pricing
			$form_data = [
				'pricing_heading' => 'Pricing Heading',
				'mt_pricing' => '',
				'mk_pricing' => '',
				'md_pricing' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_pricing($form_data);


			// Adding Item in tbl_page_contact
			$form_data = [
				'contact_heading' => 'Contact Heading',
				'contact_address' => '',
				'contact_email' => '',
				'contact_phone' => '',
				'contact_map' => '',
				'mt_contact' => '',
				'mk_contact' => '',
				'md_contact' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_page_contact($form_data);


			// Adding Item in tbl_footer
			$form_data = [
				'footer_copyright' => '',
				'footer_address' => '',
				'footer_email' => '',
				'footer_phone' => '',
				'newsletter_text' => '',
				'cta_text' => '',
				'cta_button_text' => '',
				'cta_button_url' => '',
				'lang_id' => $ai_id
			];
			$this->_Model->add_footer_setting($form_data);
		   

			$success = 'Language is added successfully!';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
  
        } else { 
			return view($this->add_url,$data); //admin/photo/add
        }
	}


	public function edit($id)
	{
    	// If there is no event in this id, then redirect
    	$tot = $this->_Model->item_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url($this->index_url));     	
    	}
		$data['setting'] = $this->commonModel->get_setting_data();
		
		$error = '';
		$success = '';

		

		if($this->request->getPost('form1')) 
		{
			$lang_name = $this->request->getPost('lang_name');
			$lang_short_name = $this->request->getPost('lang_short_name');
			$layout_direction = $this->request->getPost('layout_direction');
			$lang_default = $this->request->getPost('lang_default');

			if(PROJECT_MODE == 1) {
				if($lang_default == 1)
				{
					// Update others as empty
					$arr = [
						'lang_default' => ''
					];
					$this->_Model->make_all_empty($arr);

					// Make this one 'Yes'
					$lang_default = 'Yes';
				}
				else
				{
					$lang_default = '';	
				}
			}
			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}
			$rules = [
                'lang_name'         => 'required',
				'lang_short_name'         => 'required'
            ];

            if (!$this->validate($rules)) {
                return redirect()->to()->back()->withInput()->with('error', $this->validator->getErrors());
            }

			
			$form_data = [
				'lang_name'  => $lang_name,
					'lang_short_name'=> $lang_short_name,
					'layout_direction'=> $layout_direction,
					'lang_default' => $lang_default
			];
			//var_dump();die();
			$this->_Model->_update($id,$form_data);

			$success = 'Language is updated successfully';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
		   
		} else {
			$data['lang'] = $this->_Model->getData($id);
			
			return view($this->edit_url,$data); //'admin/photo/edit'
		}

	}


	public function delete($id) 
	{
    	$tot = $this->_Model->item_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url($this->index_url));
    	}
		if(PROJECT_MODE == 0) {
			session()->setFlashdata('error',PROJECT_NOTIFICATION);
			return redirect()->to($_SERVER['HTTP_REFERER']);
		}

		// Check first if you this lang_id is in other tables.
    	$check_1 = $this->_Model->check_category_for_lang_id($id);
    	$check_2 = $this->_Model->check_event_for_lang_id($id);
    	$check_3 = $this->_Model->check_faq_for_lang_id($id);
    	$check_4 = $this->_Model->check_feature_for_lang_id($id);
    	$check_5 = $this->_Model->check_news_for_lang_id($id);
    	$check_6 = $this->_Model->check_portfolio_for_lang_id($id);
    	$check_7 = $this->_Model->check_portfolio_category_for_lang_id($id);
    	$check_8 = $this->_Model->check_pricing_table_for_lang_id($id);
    	$check_9 = $this->_Model->check_service_for_lang_id($id);
    	$check_10 = $this->_Model->check_slider_for_lang_id($id);
    	$check_11 = $this->_Model->check_team_member_for_lang_id($id);
    	$check_12 = $this->_Model->check_testimonial_for_lang_id($id);
    	$check_13 = $this->_Model->check_why_choose_for_lang_id($id);
		if( (!$check_1) && 
    		(!$check_2) && 
    		(!$check_3) && 
    		(!$check_4) && 
    		(!$check_5) && 
    		(!$check_6) && 
    		(!$check_7) && 
    		(!$check_8) && 
    		(!$check_9) && 
    		(!$check_10) && 
    		(!$check_11) && 
    		(!$check_12) && 
    		(!$check_13)
    	)
    	{
			$this->_Model->_delete($id);

			$this->_Model->delete_detail($id);

			$this->_Model->delete_from_footer($id);
			$this->_Model->delete_from_page_about($id);
			$this->_Model->delete_from_page_contact($id);
			$this->_Model->delete_from_page_event($id);
			$this->_Model->delete_from_page_faq($id);
			$this->_Model->delete_from_page_home($id);
			$this->_Model->delete_from_page_news($id);
			$this->_Model->delete_from_page_photo_gallery($id);
			$this->_Model->delete_from_page_portfolio($id);
			$this->_Model->delete_from_page_pricing($id);
			$this->_Model->delete_from_page_privacy($id);
			$this->_Model->delete_from_page_search($id);
			$this->_Model->delete_from_page_service($id);
			$this->_Model->delete_from_page_team($id);
			$this->_Model->delete_from_page_term($id);
			$this->_Model->delete_from_page_testimonial($id);

			$success = 'Item is deleted successfully';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
		} else {
			$error = 'This language can not be deleted because this is used in other tables';
			session()->setFlashdata('error',$error);
			return redirect()->to(base_url($this->index_url));
		}
    }

	public function detail($id)
    {
    	$tot = $this->_Model->item_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url($this->index_url));
    	}
       	
       	$data['setting'] = $this->commonModel->get_setting_data();

       	$error = '';
		$success = '';

		if(isset($_POST['form1'])) 
		{
			foreach ($_POST['new_arr'] as $val) {
				$new_arr2[] = $val;
			}

			foreach ($_POST['new_arr1'] as $val) {
				$new_arr3[] = $val;
			}

			for($i=0;$i<count($new_arr2);$i++) {
							
				$form_data = array(
					'lang_string_value' => $new_arr2[$i]
	            );
	            $this->_Model->update_detail($new_arr3[$i],$form_data);
			}

	    	$data['lang_detail'] = $this->_Model->detail($id);
			
			$success = 'Language detail is updated successfully';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url("admin/lang/detail/{$id}"));
		}
		else
		{
			$data['lang_detail'] = $this->_Model->detail($id);
			$data['id'] = $id;
			$i = 0;
			$arr1 = [];
			$arr2 = [];
			$arr3 = [];
			foreach ($data['lang_detail'] as $row) {
				$arr1[$i] = $row['lang_detail_id'];
				$arr2[$i] = $row['lang_string'];
				$arr3[$i] = $row['lang_string_value'];
				$i++;
			}
			
			$data['arr1'] = $arr1;
			$data['arr2'] = $arr2;
			$data['arr3'] = $arr3;
			
			return view('admin/lang/detail',$data);
				
		}
		
    }


    function change($short_name)
    {

		if(PROJECT_MODE == 0) {
			$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
			redirect($_SERVER['HTTP_REFERER']);
		}

    	if($short_name == 'EN')
    	{
			$_SESSION['admin_sess_lang'] = 'EN';
    	}
    	elseif($short_name == 'AR')
    	{
    		$_SESSION['admin_sess_lang'] = 'AR';	
    	}
    	else
    	{
    		$_SESSION['admin_sess_lang'] = 'EN';
    	}

    	redirect($this->agent->referrer());
    }


}
