<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Permissions;
class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Kiểm tra đăng nhập
        if (! session('logged_in')) {
            session()->set('redirect_url', current_url());
            return redirect()->to(base_url('admin/login'));
        }

        // Lấy thông tin vai trò và action
        $role = session()->get('role'); // Lấy role từ session
        $controller = service('router')->controllerName(); // Controller hiện tại
        $method = service('router')->methodName(); // Method hiện tại (action)

        // Tạo permission string ví dụ: "users.delete"
        $controllerName = strtolower(class_basename($controller)); // Lấy tên controller không có namespace
        $permission = "{$controllerName}.{$method}"; 

        // Kiểm tra quyền truy cập theo role và permission
        $permissions = config(Permissions::class)->rolePermissions;

        if (!isset($permissions[$role]) || !in_array($permission, $permissions[$role])) {
            return redirect()->to(base_url('admin'))->with('error', 'Bạn không có quyền truy cập chức năng này');
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action after
    }
}
