<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;

class Test extends Controller
{
    public function index()
    {
       
        try {
            $db = Database::connect();

            // Thử một truy vấn nhỏ để kích hoạt kết nối thật sự
            $query = $db->query('SELECT 1');

            echo "✅ Kết nối thành công!";
        } catch (\Exception $e) {
            echo "❌ Lỗi kết nối DB: " . $e->getMessage();
        }
    }
}
