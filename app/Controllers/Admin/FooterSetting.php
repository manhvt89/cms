<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\FooterSettingModel;

class FooterSetting extends AdminBaseController
{
    protected $_Model;
    protected $commonModel;

	protected $index_url;
	protected $add_url;
	protected $edit_url;
    public function __construct()
    {
        $this->_Model = new FooterSettingModel();
        $this->commonModel = new CommonModel();
		$this->index_url = "admin/footersetting";
		$this->add_url = "admin/footersetting/add";
		$this->edit_url = "admin/footersetting/edit";
        helper(['form', 'url']);
		
    }

    public function index()
	{
		$data = $this->data;
		$data['footer_setting'] = $this->_Model->show();
		$data['footer_setting_lang_independent'] = $this->_Model->show_lang_independent();
		$data['setting'] = $this->commonModel->get_setting_data();
		
        return view($this->index_url, $data); //admin/footersetting
	}

	public function edit($id)
	{
		$data = $this->data;
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
			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			

			$footer_copyright = $this->request->getPost('footer_copyright');
			$footer_address = $this->request->getPost('footer_address');
			$footer_email = $this->request->getPost('footer_email');
			$footer_phone = $this->request->getPost('footer_phone');
			$newsletter_text = $this->request->getPost('newsletter_text');
			$cta_text = $this->request->getPost('cta_text');
			$cta_button_text = $this->request->getPost('cta_button_text');
			$cta_button_url = $this->request->getPost('cta_button_url');

		
			$form_data = array(
				'footer_copyright' 	=> $footer_copyright,
				'footer_address' 	=> $footer_address,
				'footer_email' 		=> $footer_email,
				'footer_phone' 		=> $footer_phone,
				'newsletter_text' 	=> $newsletter_text,
				'cta_text' 			=> $cta_text,
				'cta_button_text' 	=> $cta_button_text,
				'cta_button_url' 	=> $cta_button_url
			);
			$this->_Model->_update($id,$form_data);

			$success = 'Photo is updated successfully';
			session()->setFlashdata('success',$success);
			return redirect()->to(base_url($this->index_url));
		   
		} else {
			$data['footer_setting'] = $this->_Model->getData($id);
			return view($this->edit_url,$data); //'admin/photo/edit'
		}

	}

	public function update()
	{
		$error = '';
		$success = '';

		if($this->request->getPost('form_footer_general')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

        	$form_data = [
				'footer_recent_news_item'  => $this->request->getPost('footer_recent_news_item'),
				'footer_recent_portfolio_item' => $this->request->getPost('footer_recent_portfolio_item')
			];
        	$this->_Model->update_footer_setting($form_data);
        	$success = 'Footer General information is updated successfully!';
        	session()->setFlashdata('success',$success);
		    return redirect()->to(base_url($this->index_url));
		}

		if(isset($_POST['form_footer_cta_bg'])) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}
					        
				$form_data = array(
					'cta_background' => $this->request->getPost('photo')
	            );
	        	$this->_Model->update_footer_setting($form_data);

	        	$success = 'Footer CTA Background is updated successfully!';
		    	session()->setFlashdata('success',$success);
		    	return redirect()->to(base_url('admin/footersetting'));
		    
		}


	}
	

}
