<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ModelCommon extends Model
{
    protected $table = 'tbl_settings'; // Chỉ định bảng mặc định nếu dùng Model::find()

    /**
     * Lấy danh sách ngôn ngữ
     */
    public function all_lang(): array
    {
        return $this->db->table('tbl_lang')->get()->getResultArray();
    }

    /**
     * Lấy thông tin cấu hình hệ thống
     */
    public function get_setting_data(): ?array
    {
        return $this->db->table('tbl_settings')
                        ->where('id', 1)
                        ->get()
                        ->getRowArray();
    }

    /**
     * Kiểm tra phần mở rộng cho ảnh
     */
    public function extension_check_photo(string $ext): bool
    {
        $ext = strtolower($ext);
        return in_array($ext, ['jpg', 'jpeg', 'png', 'gif']);
    }

    /**
     * Kiểm tra phần mở rộng cho file upload
     */
    public function extension_check_file(string $ext): bool
    {
        $ext = strtolower($ext);
        return in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv']);
    }

    /**
     * Resize và crop ảnh
     */
    public function image_handler(
        string $source_image,
        string $destination,
        int $tn_w = 100,
        int $tn_h = 100,
        int $quality = 80
    ): bool {
        if (!file_exists($source_image)) {
            return false;
        }

        $info = getimagesize($source_image);
        $imgtype = image_type_to_mime_type($info[2]);

        switch ($imgtype) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg($source_image);
                break;
            case 'image/gif':
                $source = imagecreatefromgif($source_image);
                break;
            case 'image/png':
                $source = imagecreatefrompng($source_image);
                break;
            default:
                return false;
        }

        $src_w = imagesx($source);
        $src_h = imagesy($source);
        $src_ratio = $src_w / $src_h;

        if ($tn_w / $tn_h > $src_ratio) {
            $new_h = $tn_w / $src_ratio;
            $new_w = $tn_w;
        } else {
            $new_w = $tn_h * $src_ratio;
            $new_h = $tn_h;
        }

        $x_mid = $new_w / 2;
        $y_mid = $new_h / 2;

        $newpic = imagecreatetruecolor((int) $new_w, (int) $new_h);
        imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);

        $final = imagecreatetruecolor($tn_w, $tn_h);
        imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);

        return imagejpeg($final, $destination, $quality);
    }
}
