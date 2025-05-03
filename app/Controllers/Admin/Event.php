<?php

namespace App\Controllers\Admin;
//use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\EventModel;

class Event extends AdminBaseController
{
    protected $eventModel;
    protected $commonModel;


    public function __construct()
    {
        $this->eventModel = new EventModel();
        $this->commonModel = new CommonModel();
        helper(['form', 'url']);
		
    }

    public function index()
	{
		$data = $this->data;
		$data['setting'] = $this->commonModel->get_setting_data();
		$data['event'] = $this->eventModel->show();
        return view('admin/event', $data);
	}

	public function add()
	{
		$data = $this->data;
		$data['setting'] = $this->commonModel->get_setting_data();
		$data['all_lang'] = $this->commonModel->all_lang();

		$error = '';
		$success = '';

		if($this->request->getPost('form1')) {

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;
			$rules = [
                'event_title'         => 'required',
                'event_content_short' => 'required',
                'event_content'       => 'required',
				'event_start_date' => 'required',
				'event_end_date'=>'required',
				'event_location'=>'required'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }
			
		    if($valid == 1) 
		    {
				$meta_title          = trim($this->request->getPost('meta_title'));
				$meta_keyword        = trim($this->request->getPost('meta_keyword'));
				$meta_description    = trim($this->request->getPost('meta_description'));

				$meta_title = $meta_title !== '' ? $meta_title : $this->request->getPost('event_title');
           	 	$meta_keyword = $meta_keyword !== '' ? $meta_keyword : '';
            	$meta_description = $meta_description !== '' ? $meta_description : $this->request->getPost('event_content_short');
            
		        $form_data = [
					'event_title'         => $this->request->getPost('event_title'),
					'event_content'       => $this->request->getPost('event_content'),
					'event_content_short' => $this->request->getPost('event_content_short'),
					'event_start_date'    => $this->request->getPost('event_start_date'),
					'event_end_date'      => $this->request->getPost('event_end_date'),
					'event_location'      => $this->request->getPost('event_location'),
					'event_map'           => $this->request->getPost('event_map'),
					'photo'               => $this->request->getPost('photo'),
					'banner'              => $this->request->getPost('banner'),
					'meta_title'          => $meta_title,
					'meta_keyword'        => $meta_keyword,
					'meta_description'    => $meta_description,
					'lang_id'             => $this->request->getPost('lang_id')
				];
	            $this->eventModel->add($form_data);

		        $success = 'Event is added successfully!';
		        session()->setFlashdata('success',$success);
				return redirect()->to(base_url('admin/event'));
		    } 
		    else
		    {
		    	session()->setFlashdata('error',$error);
				return redirect()->to(base_url('admin/event/add'));
		    }
            
        } else {
            
			return view('admin/event_add',$data);
			
        }
		
	}


	public function edit($id)
	{
		$data = $this->data;
    	// If there is no event in this id, then redirect
    	$tot = $this->eventModel->event_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url('admin/event'));        	
    	}
		$data['setting'] = $this->commonModel->get_setting_data();
		$data['all_lang'] = $this->commonModel->all_lang();
		$error = '';
		$success = '';

		if($this->request->getPost('form1')) 
		{

			if(PROJECT_MODE == 0) {
				session()->setFlashdata('error',PROJECT_NOTIFICATION);
				return redirect()->to($_SERVER['HTTP_REFERER']);
			}

			$valid = 1;

			$rules = [
                'event_title'         => 'required',
                'event_content_short' => 'required',
                'event_content'       => 'required',
				'event_start_date' => 'required',
				'event_end_date'=>'required',
				'event_location'=>'required'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }

		    if($valid == 1) 
		    {
				$meta_title          = trim($this->request->getPost('meta_title'));
				$meta_keyword        = trim($this->request->getPost('meta_keyword'));
				$meta_description    = trim($this->request->getPost('meta_description'));

				$meta_title = $meta_title !== '' ? $meta_title : $this->request->getPost('event_title');
           	 	$meta_keyword = $meta_keyword !== '' ? $meta_keyword : '';
            	$meta_description = $meta_description !== '' ? $meta_description : $this->request->getPost('event_content_short');
            
		    	
				$form_data = [
					'event_title'         => $this->request->getPost('event_title'),
					'event_content'       => $this->request->getPost('event_content'),
					'event_content_short' => $this->request->getPost('event_content_short'),
					'event_start_date'    => $this->request->getPost('event_start_date'),
					'event_end_date'      => $this->request->getPost('event_end_date'),
					'event_location'      => $this->request->getPost('event_location'),
					'event_map'           => $this->request->getPost('event_map'),
					'photo'               => $this->request->getPost('photo'),
					'banner'              => $this->request->getPost('banner'),
					'meta_title'          => $meta_title,
					'meta_keyword'        => $meta_keyword,
					'meta_description'    => $meta_description,
					'lang_id'             => $this->request->getPost('lang_id')
				];
		        
				$this->eventModel->_update($id,$form_data);

				$success = 'Event is updated successfully';
				session()->setFlashdata('success',$success);
				return redirect()->to(base_url('admin/event'));
		    }
		    else
		    {
		    	session()->setFlashdata('error',$error);
				return redirect()->to(base_url('admin/event/add'));
		    }
           
		} else {
			$data['event'] = $this->eventModel->getData($id);
           
			return view('admin/event_edit',$data);
			
		}

	}


	public function delete($id) 
	{
    	$tot = $this->eventModel->event_check($id);
    	if(!$tot) {
    		return redirect()->to(base_url('admin/event'));
        	
    	}

		if(PROJECT_MODE == 0) {
			session()->setFlashdata('error',PROJECT_NOTIFICATION);
			return redirect()->to($_SERVER['HTTP_REFERER']);
		}

        
        $this->eventModel->_delete($id);
        $success = 'Event is deleted successfully';
		session()->setFlashdata('success',$success);
		return redirect()->to(base_url('admin/event'));
    }

}
