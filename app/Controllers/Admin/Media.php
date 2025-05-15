<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class Media extends Controller
{
    protected $uploadPath;
    protected $perPage;
    public function __construct()
    {
        $this->uploadPath = ROOTPATH . 'public/uploads/images/';
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
        $this->perPage = 12;
    }
	public function popup()
    {
        //echo ROOTPATH . 'uploads/images/*.{jpg,jpeg,png,gif}'; die();
        helper('filesystem');

        // Lấy danh sách file
        $files = get_filenames($this->uploadPath);

        // Gắn đường dẫn đầy đủ để dùng filemtime
        $filesWithPath = array_map(fn($f) => $this->uploadPath . $f, $files);

        // Sắp xếp theo thời gian cập nhật giảm dần
        usort($filesWithPath, fn($a, $b) => filemtime($b) - filemtime($a));

        // Xử lý phân trang
        $perPage = $this->perPage;
        $page = (int)($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        $paginatedFiles = array_slice($filesWithPath, $offset, $perPage);
        $totalPages = ceil(count($filesWithPath) / $perPage);

        return view('admin/media/popup', [
            'files' => $paginatedFiles,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
        //var_dump( $files);die();
        
    }

    public function upload()
    {
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $name = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/images/', $name);
            return $this->response->setJSON([
                'success' => true,
                'url' => base_url("uploads/images/{$name}"),
                'csrf_hash' => csrf_hash()
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Không thể upload ảnh.',
            'csrf_hash' => csrf_hash()
        ]);
    }
    public function ajaxLibrary1()
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
    public function ajaxLibrary()
    {
        helper('filesystem');

        // Lấy danh sách file
        $files = get_filenames($this->uploadPath);

        // Gắn đường dẫn đầy đủ để dùng filemtime
        $filesWithPath = array_map(fn($f) => $this->uploadPath . $f, $files);

        // Sắp xếp theo thời gian cập nhật giảm dần
        usort($filesWithPath, fn($a, $b) => filemtime($b) - filemtime($a));

        // Xử lý phân trang
        $perPage = $this->perPage;
        $page = (int)($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        $paginatedFiles = array_slice($filesWithPath, $offset, $perPage);
        $totalPages = ceil(count($filesWithPath) / $perPage);

        return view('admin/media/_image_grid', [
            'files' => $paginatedFiles,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
        return view('admin/media/_image_grid', $data);
    }


}