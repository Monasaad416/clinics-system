<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class AutoCheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()->getName();
     

        $permission = Permission::whereRaw("FIND_IN_SET('$routeName', routes )")->first();
           //return dd($permission);
        // return dd($permission->name);
        if($permission){
            //return dd($permission->name);
            if($request->user()->cannot($permission->name)){
                abort(403);
            }
        }

        return $next($request);
    }
}
