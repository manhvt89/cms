<?php

namespace App\Controllers;


use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use Config\Services;
use Config\Database;
use App\Models\ModelLang;
use App\Models\Admin\ModelMenu;
use App\Models\CommonModel;
use App\Models\PortfolioModel;
use App\Controllers\Portfolio;


/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['local','slider','menu'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;
    protected $session;
    protected $db;

    public $data;
    /**
     * @return void
     */
    public function __construct()
    {
        helper($this->helpers);
        helper('menu');

    }
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        helper('form');
        // Preload any models, libraries, etc, here.
        $this->session = Services::session();
        try {
            $this->db = Database::connect();
            //var_dump($this->db);die();
            // Set session lang_id if not exist
            if (!$this->session->has('sess_lang_id')) {
                $this->session->set('sess_lang_id', 5);
            }

            // Load language file based on session
            $langId = $this->session->get('sess_lang_id');

            $query = $this->db->table('tbl_lang')->where('lang_id', $langId)->get();
            $result = $query->getRowArray();

            if ($result && isset($result['name'])) {
                $langName = $result['name'];
                // Load language file (must be present in app/Language/{langName}/website.php)
                helper('language');
                $this->request->setLocale($langName);
                // Language should be preloaded in CI4 via `app/Language`
                //$all_language = new ModelLang()->show_all_language();
                // Gán biến toàn cục
               
            }
            //var_dump($this->data['all_language']); die();
        } catch (\Exception $e) {
            echo "❌ Lỗi kết nối DB: " . $e->getMessage();
        }
        // E.g.: $this->session = service('session');
    }

    protected function render($view, $data = [])
    {
        helper('local');
        // Khởi tạo các model
        $modelLang = new ModelLang();
        $modelMenu = new ModelMenu();
        $commonModel = new CommonModel();
        $portfolioModel = new PortfolioModel();
        $langId = $this->session->get('sess_lang_id');

        $data = set_meta_defaults($data); // Chua co thi gan "" de tranh loi
        $data['langId'] = $langId;

        // Dữ liệu dùng chung cho mọi layout
        $data['all_language'] = $modelLang->show_all_language();
        $all_menu = $modelMenu->show();
        $data['arr_menu'] =  $all_menu;


        //var_dump( $data['menus']); die();
        $data['all_setting'] = $commonModel->all_setting();
        $data['all_dynamic_pages'] = $commonModel->all_dynamic_pages($langId);
        $data['setting'] = $data['all_setting'];
        $data['comment'] = $commonModel->all_comment();
        $data['all_categories']   = $commonModel->all_categories();

        // footer
        $portfolio_footer = $portfolioModel->get_portfolio_data();
        $data['portfolio_footer']       = $portfolio_footer;
        $footer_setting_lang_independent = $commonModel->all_footer_setting_lang_independent();
        $data['footer_setting_lang_independent'] = $footer_setting_lang_independent;
        $data['all_news']  = $commonModel->all_news($langId);
        $data['footer_setting'] = $commonModel->all_footer_setting($langId);
        $data['social'] = $commonModel->all_social();

        $footer_items = [
            'recent_posts' => [
                'all_news' => $data['all_news'],
                'limit' => $footer_setting_lang_independent['footer_recent_news_item']
            ],
            'portfolio' => [
                'portfolio_items' => $portfolio_footer,
                'limit' => $footer_setting_lang_independent['footer_recent_portfolio_item']
            ],
        ];

        if (function_exists("footer_recent_posts")){
            $data["footer_recent_posts"] = footer_recent_posts($footer_items['recent_posts']);
        } else {
            $data["footer_recent_posts"] = "";
        }

        if(function_exists("footer_recent_portfolio")){
            $data["footer_recent_portfolio"] = footer_recent_portfolio($footer_items['portfolio']);
        } else {
            $data["footer_recent_portfolio"] = "";
        }

        return view($view, $data);
    }
}
