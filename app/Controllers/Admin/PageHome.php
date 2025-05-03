<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\PageHomeModel;

class PageHome extends AdminBaseController
{
    protected $_Model;
    protected $commonModel;

	protected $index_url;
	protected $add_url;
	protected $edit_url;
    public function __construct()
    {
        $this->_Model = new PageHomeModel();
        $this->commonModel = new CommonModel();
		$this->index_url = "admin/pagehome";
		$this->add_url = "admin/pagehome/add";
		$this->edit_url = "admin/pagehome/edit";
        helper(['form', 'url']);
		
    }

    public function index()
	{
		$data = $this->data;
		$data['setting'] = $this->commonModel->get_setting_data();
		$_items = $this->_Model->show();
		$data['page_home'] = $_items;
		$data['page_home_lang_independent'] = $this->_Model->show_lang_independent();
        return view($this->index_url, $data); //admin/slider
	}
	public function edit($id)
	{
    	// If there is no event in this id, then redirect
    	$tot = $this->_Model->item_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url($this->index_url));     	
    	}
		$data = $this->data;
		$data['setting'] = $this->commonModel->get_setting_data();
	
		$success = '';
		if($this->request->getPost('form1')) 
		{
			if(PROJECT_MODE == 0) {
				$this->session->set_flashdata('error',PROJECT_NOTIFICATION);
				redirect($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			$title = $this->request->getPost('title');
			$meta_keyword = $this->request->getPost('meta_keyword');
			$meta_description = $this->request->getPost('meta_description');
			$home_welcome_title = $this->request->getPost('home_welcome_title');
			$home_welcome_subtitle = $this->request->getPost('home_welcome_subtitle');
			$home_welcome_text = $this->request->getPost('home_welcome_text');
			$home_welcome_pbar1_text = $this->request->getPost('home_welcome_pbar1_text');
			$home_welcome_pbar1_value = $this->request->getPost('home_welcome_pbar1_value');
			$home_welcome_pbar2_text = $this->request->getPost('home_welcome_pbar2_text');
			$home_welcome_pbar2_value = $this->request->getPost('home_welcome_pbar2_value');
			$home_welcome_pbar3_text = $this->request->getPost('home_welcome_pbar3_text');
			$home_welcome_pbar3_value = $this->request->getPost('home_welcome_pbar3_value');
			$home_welcome_pbar4_text = $this->request->getPost('home_welcome_pbar4_text');
			$home_welcome_pbar4_value = $this->request->getPost('home_welcome_pbar4_value');
			$home_welcome_pbar5_text = $this->request->getPost('home_welcome_pbar5_text');
			$home_welcome_pbar5_value = $this->request->getPost('home_welcome_pbar5_value');
			$home_why_choose_title = $this->request->getPost('home_why_choose_title');
			$home_why_choose_subtitle = $this->request->getPost('home_why_choose_subtitle');
			$home_feature_title = $this->request->getPost('home_feature_title');
			$home_feature_subtitle = $this->request->getPost('home_feature_subtitle');
			$home_service_title = $this->request->getPost('home_service_title');
			$home_service_subtitle = $this->request->getPost('home_service_subtitle');
			$counter_1_title = $this->request->getPost('counter_1_title');
			$counter_1_value = $this->request->getPost('counter_1_value');
			$counter_1_icon = $this->request->getPost('counter_1_icon');
			$counter_2_title = $this->request->getPost('counter_2_title');
			$counter_2_value = $this->request->getPost('counter_2_value');
			$counter_2_icon = $this->request->getPost('counter_2_icon');
			$counter_3_title = $this->request->getPost('counter_3_title');
			$counter_3_value = $this->request->getPost('counter_3_value');
			$counter_3_icon = $this->request->getPost('counter_3_icon');
			$counter_4_title = $this->request->getPost('counter_4_title');
			$counter_4_value = $this->request->getPost('counter_4_value');
			$counter_4_icon = $this->request->getPost('counter_4_icon');
			$home_portfolio_title = $this->request->getPost('home_portfolio_title');
			$home_portfolio_subtitle = $this->request->getPost('home_portfolio_subtitle');
			$home_booking_form_title = $this->request->getPost('home_booking_form_title');
			$home_booking_faq_title = $this->request->getPost('home_booking_faq_title');
			$home_team_title = $this->request->getPost('home_team_title');
			$home_team_subtitle = $this->request->getPost('home_team_subtitle');
			$home_ptable_title = $this->request->getPost('home_ptable_title');
			$home_ptable_subtitle = $this->request->getPost('home_ptable_subtitle');
			$home_testimonial_title = $this->request->getPost('home_testimonial_title');
			$home_testimonial_subtitle = $this->request->getPost('home_testimonial_subtitle');
			$home_blog_title = $this->request->getPost('home_blog_title');
			$home_blog_subtitle = $this->request->getPost('home_blog_subtitle');
			

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}
			$rules = [
                'title'         => 'required',
				
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }

			
			$form_data = array(
				'title' => $title,
				'meta_keyword' => $meta_keyword,
				'meta_description' => $meta_description,
				'home_welcome_title' => $home_welcome_title,
				'home_welcome_subtitle' => $home_welcome_subtitle,
				'home_welcome_text' => $home_welcome_text,
				'home_welcome_pbar1_text' => $home_welcome_pbar1_text,
				'home_welcome_pbar1_value' => $home_welcome_pbar1_value,
				'home_welcome_pbar2_text' => $home_welcome_pbar2_text,
				'home_welcome_pbar2_value' => $home_welcome_pbar2_value,
				'home_welcome_pbar3_text' => $home_welcome_pbar3_text,
				'home_welcome_pbar3_value' => $home_welcome_pbar3_value,
				'home_welcome_pbar4_text' => $home_welcome_pbar4_text,
				'home_welcome_pbar4_value' => $home_welcome_pbar4_value,
				'home_welcome_pbar5_text' => $home_welcome_pbar5_text,
				'home_welcome_pbar5_value' => $home_welcome_pbar5_value,
				'home_why_choose_title' => $home_why_choose_title,
				'home_why_choose_subtitle' => $home_why_choose_subtitle,
				'home_feature_title' => $home_feature_title,
				'home_feature_subtitle' => $home_feature_subtitle,
				'home_service_title' => $home_service_title,
				'home_service_subtitle' => $home_service_subtitle,
				'counter_1_title' => $counter_1_title,
				'counter_1_value' => $counter_1_value,
				'counter_1_icon' => $counter_1_icon,
				'counter_2_title' => $counter_2_title,
				'counter_2_value' => $counter_2_value,
				'counter_2_icon' => $counter_2_icon,
				'counter_3_title' => $counter_3_title,
				'counter_3_value' => $counter_3_value,
				'counter_3_icon' => $counter_3_icon,
				'counter_4_title' => $counter_4_title,
				'counter_4_value' => $counter_4_value,
				'counter_4_icon' => $counter_4_icon,
				'home_portfolio_title' => $home_portfolio_title,
				'home_portfolio_subtitle' => $home_portfolio_subtitle,
				'home_booking_form_title' => $home_booking_form_title,
				'home_booking_faq_title' => $home_booking_faq_title,
				'home_team_title' => $home_team_title,
				'home_team_subtitle' => $home_team_subtitle,
				'home_ptable_title' => $home_ptable_title,
				'home_ptable_subtitle' => $home_ptable_subtitle,
				'home_testimonial_title' => $home_testimonial_title,
				'home_testimonial_subtitle' => $home_testimonial_subtitle,
				'home_blog_title' => $home_blog_title,
				'home_blog_subtitle' => $home_blog_subtitle
			);
			//var_dump();die();
			$this->_Model->_update($id,$form_data);

			$success = 'Page Home is updated successfully';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
		   
		} else {
			$data['page_home'] = $this->_Model->getData($id);
			
			return view($this->edit_url,$data); //'admin/photo/edit'
		}

	}

	// Hàm xử lý cập nhật và thông báo
	private function handle_update($condition, $post_fields, $success_msg, $form_check_value,$rules=[])
	{
		$request_value = $this->request->getPost($condition);
		if ($request_value == $form_check_value) {

			if ($redirect = $this->check_project_mode()) {
				return $redirect;
			}

			// Nếu có yêu cầu validate
			if (!empty($rules)) {
				if (!$this->validate($rules)) {
					return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
				}
			}
			// Tạo mảng dữ liệu từ các field
			$form_data = [];
			foreach ($post_fields as $field) {
				$form_data[$field] = $this->request->getPost($field);
			}

			$this->_Model->update_home($form_data);
			session()->setFlashdata('success', $success_msg);
			return redirect()->to(base_url($this->index_url));
		}
		return null;
	}

// Gọi hàm xử lý tương ứng với từng loại form

	public function update()
	{
		$error = '';
		$success = '';

		if ($redirect = $this->handle_update(
				'form_home_welcome', 
				['home_welcome_video', 'home_welcome_status'], 
				'Home page welcome information is updated successfully!', 
				1)) return $redirect;

		if ($redirect = $this->handle_update(
				'form_home_welcome_video_bg', 
				['home_welcome_video_bg'], 
				'Home page welcome video background is updated successfully!', 
				2,
				['home_welcome_video_bg'=> 'required'])) return $redirect;

		if ($redirect = $this->handle_update(
				'form_home_why_choose', 
				['home_why_choose_status'], 
				'Home page why choose us information is updated successfully!', 
				3)) return $redirect;

		if ($redirect = $this->handle_update(
			'form_home_feature', 
			['home_feature_status'], 
			'Home page why choose us information is updated successfully!', 
			4)) return $redirect;
		
		if ($redirect = $this->handle_update(
			'form_home_service', 
			['home_service_status'], 
			'Home page why choose us information is updated successfully!', 
			5)) return $redirect;

		if ($redirect = $this->handle_update(
			'form_home_counter_text', 
			['counter_status'], 
			'Home page why choose us information is updated successfully!', 
			6)) return $redirect;
		
		if ($redirect = $this->handle_update(
			'form_home_counter_photo', 
			['counter_photo'], 
			'Home page why choose us information is updated successfully!', 
			7,
			['counter_photo'=>'required'])) return $redirect;

		if ($redirect = $this->handle_update(
			'form_home_portfolio', 
			['home_portfolio_status'], 
			'Home page why choose us information is updated successfully!', 
			8)) return $redirect;

		if ($redirect = $this->handle_update(
			'form_home_booking', 
			['home_booking_status'], 
			'Home page why choose us information is updated successfully!', 
			9)) return $redirect;

		if ($redirect = $this->handle_update(
			'form_home_booking_photo', 
			['home_booking_photo'], 
			'Home page why choose us information is updated successfully!', 
			10,
			['home_booking_photo'=>'required'])) return $redirect;

		if ($redirect = $this->handle_update(
			'form_home_team', 
			['home_team_status'], 
			'Home page why choose us information is updated successfully!', 
			11)) return $redirect;

		if ($redirect = $this->handle_update(
			'form_home_pricing_table', 
			['home_ptable_status'], 
			'Home page why choose us information is updated successfully!', 
			12)) return $redirect;

		if ($redirect = $this->handle_update(
			'form_home_testimonial', 
			['home_testimonial_status'], 
			'Home page why choose us information is updated successfully!', 
			13)) return $redirect;

		if ($redirect = $this->handle_update(
			'form_home_testimonial_photo', 
			['home_testimonial_photo'], 
			'Home page why choose us information is updated successfully!', 
			14,
			['home_testimonial_photo'=>'required'])) return $redirect;
		
		if ($redirect = $this->handle_update(
			'form_home_blog', 
			['home_blog_item','home_blog_status'], 
			'Home page why choose us information is updated successfully!', 
			15)) return $redirect;
	}
	
}
