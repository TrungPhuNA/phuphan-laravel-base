<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission, $guard = null)
    {
        $authGuard = app('auth')->guard($guard);
        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $emailSupperAdmin = config('setting.admin.email_supper_admin');
        if(!empty($emailSupperAdmin) && $authGuard->email == $emailSupperAdmin)
            return $next($request);

        $checkPermission = config('setting.admin.check_permission');
        if(!empty($checkPermission) && $checkPermission !== true)
            return $next($request);

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
            if ($authGuard->user()->can($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}
