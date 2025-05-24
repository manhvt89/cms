<?php

use Config\Permissions;

if (!function_exists('has_permission')) {
    function has_permission(string $permission, ?string $role): bool
    {
        if (!$role) return false;

        $permissions = config(Permissions::class)->rolePermissions;

        return isset($permissions[$role]) && in_array($permission, $permissions[$role]);
    }
}


