<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class Media extends Controller
{
    protected $uploadPath;

    public function __construct()
    {
        $this->uploadPath = ROOTPATH . 'public/uploads/images/';
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
    }
	public function popup()
    {
        //echo ROOTPATH . 'uploads/images/*.{jpg,jpeg,png,gif}'; die();
        $files = glob(ROOTPATH . 'public/uploads/images/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        

        // Sắp xếp theo thời gian cập nhật mới nhất
        usort($files, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        //var_dump( $files);die();
        return view('admin/media/popup', ['files' => $files]);
    }

    public function upload()
    {
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $name = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/images/', $name);
            return $this->response->setJSON([
                'success' => true,
                'url' => base_url('uploads/images/' . $name),
                'csrf_hash' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Không thể upload ảnh.',
            'csrf_hash' => csrf_hash()
        ]);
    }
    public function ajaxLibrary()
    {
        helper('filesystem');

        $files = get_filenames($this->uploadPath);

        // Gắn thêm đường dẫn đầy đủ để gọi được filemtime
        $filesWithPath = array_map(fn($f) => $this->uploadPath . $f, $files);

        // Sắp xếp giảm dần theo thời gian cập nhật
        usort($filesWithPath, fn($a, $b) => filemtime($b) - filemtime($a));

        return view('admin/media/_image_grid', [
            'files' => $filesWithPath
        ]);

    }

}