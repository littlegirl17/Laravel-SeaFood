<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission = null): Response
    {
        $admin =  auth()->guard('admin')->user();
        if ($admin && $admin->status >= 1) {
            $permissions = json_decode($admin->administrationGroup->permission, true);
            if ($permission && !in_array($permission, $permissions)) {
                return redirect()->route('dashboard')->with(['danger' => 'Bạn không có quyền truy cập trang này']);
            }
            return $next($request); //Nếu đúng, tiếp tục chuyển yêu cầu tới tuyến đường tiếp theo
        }

        return redirect('admin/manage');
    }
}
