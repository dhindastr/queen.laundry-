<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class RoleMiddleware {
    public function handle(Request $request, Closure $next, string ...$roles): mixed {
        foreach($roles as $role){
            if($role==='customer'&&auth('customer')->check())return $next($request);
            if($role!=='customer'&&auth()->check()&&auth()->user()->role===$role)return $next($request);
        }
        if(auth('customer')->check())return redirect()->route('customer.dashboard');
        if(auth()->check()){
            return match(auth()->user()->role){
                'admin'=>redirect()->route('admin.dashboard'),
                'kurir'=>redirect()->route('kurir.dashboard'),
                'owner'=>redirect()->route('owner.dashboard'),
                default=>redirect('/')
            };
        }
        return redirect()->route('login');
    }
}
