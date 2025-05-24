<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\CommonModel;
use App\Models\Admin\ModelProfile;

class Profile extends AdminBaseController
{
    protected $modelCommon;
    protected $modelProfile;
    protected $session;

    public function __construct()
    {
        $this->modelCommon = new CommonModel();
        $this->modelProfile = new ModelProfile();
        $this->session = session();
        helper(['form', 'url']);
    }

    public function index()
    {
        $data = $this->data;
        $data['setting'] = $this->modelCommon->get_setting_data();
        return view('admin/profile',$data);
    }

    public function update()
    {
        $data['setting'] = $this->modelCommon->get_setting_data();
        $request = service('request');

        // form1: update email
        if ($request->getPost('form1')) {
            if (PROJECT_MODE == 0) {
                return redirect()->back()->with('error', PROJECT_NOTIFICATION);
            }

            $rules = [
                'email' => 'required|valid_email'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->with('error', $this->validator->listErrors());
            }

            $form_data = [
                'email' => $request->getPost('email'),
            ];
            $this->modelProfile->update_profile($form_data);
            $this->session->set($form_data);
            return redirect()->to(base_url('admin/profile'))->with('success', 'Profile Information is updated successfully!');
        }

        // form2: update photo
        if ($request->getPost('form2')) {
            if (PROJECT_MODE == 0) {
                return redirect()->back()->with('error', PROJECT_NOTIFICATION);
            }

            $photo = $this->request->getFile('photo');

            if (!$photo->isValid()) {
                return redirect()->back()->with('error', 'You must have to select a photo');
            }

            $ext = $photo->getClientExtension();
            if (!$this->modelCommon->extension_check_photo($ext)) {
                return redirect()->back()->with('error', 'Invalid file extension');
            }

            $oldPhoto = $this->session->get('photo');
            if ($oldPhoto && file_exists(FCPATH . 'public/uploads/' . $oldPhoto)) {
                unlink(FCPATH . 'public/uploads/' . $oldPhoto);
            }

            $final_name = 'user-' . time() . '.' . $ext;
            $photo->move(FCPATH . 'public/uploads/', $final_name);

            $form_data = ['photo' => $final_name];
            $this->modelProfile->update_profile($form_data);
            $this->session->set($form_data);
            return redirect()->to(base_url('admin/profile'))->with('success', 'Photo is updated successfully!');
        }

        // form3: update password
        //var_dump($request->getPost('form3'));die();
        if ($request->getPost('form3')) {
            if (PROJECT_MODE == 0) {
                return redirect()->back()->with('error', PROJECT_NOTIFICATION);
            }

            $rules = [
                'password' => 'required',
                're_password' => 'required|matches[password]',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->with('error', $this->validator->listErrors());
            }

            $form_data = [
                'password' => md5($request->getPost('password')),
            ];
            $this->modelProfile->update_profile($form_data);
            $this->session->set($form_data);
            return redirect()->to(base_url('admin/profile'))->with('success', 'Password is updated successfully!');
        }

        return view('admin/profile',$data);
    }
}
