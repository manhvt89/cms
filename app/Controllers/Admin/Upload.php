<?php

namespace App\Controllers\Admin;

use CodeIgniter\Controller;

class Upload extends Controller
{
	public function image()
	{
		$file = $this->request->getFile('upload');

		if ($file->isValid() && !$file->hasMoved()) {
			$newName = $file->getRandomName();
			$file->move(ROOTPATH . 'public/uploads/ckeditor', $newName);
			$url = base_url('uploads/ckeditor/' . $newName);

			return $this->response->setJSON([
				"uploaded" => 1,
				"fileName" => $newName,
				"url" => $url
			]);
		}

		return $this->response->setJSON([
			"uploaded" => 0,
			"error" => ["message" => "Upload failed."]
		]);
	}
}