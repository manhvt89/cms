<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CsrfToken extends BaseController
{
    public function getCsrf()
    {
        return $this->response->setJSON([
            'csrfName' => csrf_token(),
            'csrfHash' => csrf_hash(),
        ]);
    }
}
