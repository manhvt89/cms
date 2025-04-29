<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class LangModel extends Model
{
    protected $db;
    protected $table = 'tbl_lang';
    protected $primaryKey = 'lang_id';
    protected $allowedFields = [
        'lang_name'             
        ,'lang_short_name'
        ,'layout_direction'          
        ,'layout_default'        
    ];

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    // ✅ Hàm: get_auto_increment_id
    public function get_auto_increment_id()
    {
        $query = $this->db->query("SHOW TABLE STATUS LIKE '{$this->table}'");
        return $query->getResultArray();
    }

    public function add_detail($data) 
    {
        return $this->add_page_to_db('tbl_lang_detail',$data);
    }

    public function add_page_home($data) {
        return $this->add_page_to_db('tbl_page_home',$data);
    }

    public function add_page_about($data) {
        return $this->add_page_to_db('tbl_page_about',$data);
    }

    public function add_page_faq($data)
    {
        return $this->add_page_to_db('tbl_page_faq',$data);
    }

    public function add_page_service($data) {
        return $this->add_page_to_db('tbl_page_service',$data);  
    }

    public  function add_page_testimonial($data) {
        return $this->add_page_to_db('tbl_page_testimonial',$data);
    }

    public function add_page_news($data) {
        return $this->add_page_to_db('tbl_page_news',$data);
    }

    public function add_page_event($data) {
        return $this->add_page_to_db('tbl_page_event',$data);
    }

    public function add_page_search($data) {
        return $this->add_page_to_db('tbl_page_search',$data);
    }

    public function add_page_term($data) {
        return $this->add_page_to_db('tbl_page_term',$data);
    }

    public function add_page_privacy($data) {
        return $this->add_page_to_db('tbl_page_privacy',$data);
    }

    public function add_page_team($data) {
        return $this->add_page_to_db('tbl_page_team',$data);
    }

    public function add_page_portfolio($data) {
        return $this->add_page_to_db('tbl_page_portfolio',$data);
    }

    public function add_page_photo_gallery($data) {
        return $this->add_page_to_db('tbl_page_photo_gallery',$data);
    }

    public function add_page_pricing($data) {
        return $this->add_page_to_db('tbl_page_pricing',$data);
    }

    public function add_page_contact($data) {
        return $this->add_page_to_db('tbl_page_contact',$data);
    }

    public function add_footer_setting($data) {
        return $this->add_page_to_db('tbl_footer',$data);
    }
    /**
     * Summary of add_page_to_db: Insert DB vào tablename
     * @param string $tableName
     * @param mixed $data
     * @return void
     */
    private function add_page_to_db(string $tableName, $data)
    {
        $this->db->table($tableName)->insert($data);
        return $this->db->insertID();
    }

    // ✅ Hàm: show
    public function show()
    {
        
        return $this->db->table('tbl_lang')
                
                ->orderBy('lang_id', 'ASC')
                ->get()
                ->getResultArray();

    }
    // ✅ Hàm: add
    public function add($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function make_all_empty($data)
    {
        return $this->db->table('tbl_lang')->set($data)->update();
    }

    

    // ✅ Hàm: update
    public function _update($id, $data)
    {
        return $this->where($this->primaryKey, $id)->set($data)->update();
    }

    // ✅ Hàm: delete
    public function _delete($id)
    {
        return $this->where($this->primaryKey, $id)
                    ->delete();
    }
    
    // ✅ Hàm: getData
    public function getData($id)
    {
        return $this->where($this->primaryKey, $id)->first();
    }

    // ✅ Hàm: event_check
    public function item_check($id)
    {
        return $this->getData($id);
    }
    private function check_page(string $tableName, $id)
    {
        return $this->db->table($tableName)
                        ->where('lang_id',$id)
                        ->get()
                        ->getNumRows();
    }
    public function check_category_for_lang_id($id) {
        return $this->check_page('tbl_category',$id);
    }

    public function check_event_for_lang_id($id) {
        return $this->check_page('tbl_event',$id);
       
    }

    public function check_faq_for_lang_id($id) {
        return $this->check_page('tbl_faq',$id);
        
    }

    public function check_feature_for_lang_id($id) {
        return $this->check_page('tbl_feature',$id);
       
    }

    public function check_news_for_lang_id($id) {
        return $this->check_page('tbl_news',$id);
    
    }


    public function check_portfolio_for_lang_id($id) {
        return $this->check_page('tbl_portfolio',$id);

    }

    public function check_portfolio_category_for_lang_id($id) {
        return $this->check_page('tbl_portfolio_category',$id);
       
    }

    public function check_pricing_table_for_lang_id($id) {
        return $this->check_page('tbl_pricing_table',$id);
     
    }

    public function check_service_for_lang_id($id) {
        return $this->check_page('tbl_service',$id);
    
    }

    public function check_slider_for_lang_id($id) {
        return $this->check_page('tbl_slider',$id);
       
    }

    public function check_team_member_for_lang_id($id) {
        return $this->check_page('tbl_team_member',$id);
    }

    public function check_testimonial_for_lang_id($id) {
        return $this->check_page('tbl_testimonial',$id);
    }

    public function check_why_choose_for_lang_id($id) {
        return $this->check_page('tbl_why_choose',$id);
    }

    function delete_detail($id)
    {
        return $this->db->table('tbl_lang_detail')
                    ->where('lang_id',$id)
                    ->delete();
    }

    public function delete_from_footer($id)
    {
        return $this->delete_from_page('tbl_footer',$id);
        
    }

    function delete_from_page_about($id)
    {
        return $this->delete_from_page('tbl_page_about',$id);
       
    }

    function delete_from_page_contact($id)
    {
        return $this->delete_from_page('tbl_page_contact',$id);
        
    }

    function delete_from_page_event($id)
    {
        return $this->delete_from_page('tbl_page_event',$id);
        
    }

    function delete_from_page_faq($id)
    {
        return $this->delete_from_page('tbl_page_faq',$id);
       
    }

    function delete_from_page_home($id)
    {
        return $this->delete_from_page('tbl_page_home',$id);
        
    }

    function delete_from_page_news($id)
    {
        return $this->delete_from_page('tbl_page_news',$id);
        
    }

    function delete_from_page_photo_gallery($id)
    {
        return $this->delete_from_page('tbl_page_photo_gallery',$id);
        
    }

    function delete_from_page_portfolio($id)
    {
        return $this->delete_from_page('tbl_page_portfolio',$id);
        
    }

    function delete_from_page_pricing($id)
    {
        return $this->delete_from_page('tbl_page_pricing',$id);
        
    }

    function delete_from_page_privacy($id)
    {
        return $this->delete_from_page('tbl_page_privacy',$id);
        
    }

    function delete_from_page_search($id)
    {
        return $this->delete_from_page('tbl_page_search',$id);
        
    }

    function delete_from_page_service($id)
    {
        return $this->delete_from_page('tbl_page_service',$id);
        
    }

    function delete_from_page_team($id)
    {
        return $this->delete_from_page('tbl_page_team',$id);
        
    }

    function delete_from_page_term($id)
    {
        return $this->delete_from_page('tbl_page_term',$id);
       
    }

    public function delete_from_page_testimonial($id)
    {
        return $this->delete_from_page('tbl_page_testimonial',$id);
    }

    private function delete_from_page(string $tableName,$id)
    {
        return $this->db->table($tableName)
                    ->where('lang_id',$id)
                    ->delete();
    }

    public function detail($id) {
        return $this->db->table('tbl_lang_detail')
                    ->where('lang_id',$id)
                    ->get()
                    ->getResultArray();
        
    }

    public function update_detail($id,$data) {
        return $this->db->table('tbl_lang_detail')->where('lang_detail_id',$id)
                ->update($data);
    }
    
}
