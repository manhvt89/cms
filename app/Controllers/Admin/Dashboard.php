<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;
use App\Models\Admin\ModelDashboard;
use App\Models\Admin\ModelCommon;

class Dashboard extends AdminBaseController
{
    protected $dashboardModel;
    protected $commonModel;

    public function __construct()
    {
        $this->dashboardModel = new ModelDashboard();
        $this->commonModel = new ModelCommon();
    }

    public function index()
    {
        $data = $this->data;
        $data['setting'] = $this->commonModel->get_setting_data();
        $data['total_category'] = $this->dashboardModel->show_total_category();
        $data['total_news'] = $this->dashboardModel->show_total_news();
        $data['total_team_member'] = $this->dashboardModel->show_total_team_member();
        $data['total_client'] = $this->dashboardModel->show_total_client();
        $data['total_service'] = $this->dashboardModel->show_total_service();
        $data['total_testimonial'] = $this->dashboardModel->show_total_testimonial();
        $data['total_event'] = $this->dashboardModel->show_total_event();
        $data['total_photo'] = $this->dashboardModel->show_total_photo();
        $data['total_pricing_table'] = $this->dashboardModel->show_total_pricing_table();
        return view('admin/dashboard', $data);
    }
}
