<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $adminuser = $request->session()->get("adduser");
        if(!$adminuser){
            $adminuser = $request->cookie("adduser");
            if(!$adminuser){
                session(["adminuser"=>$adminuser]);
                $request->session()->save();
            }else{
                // echo "123";
                return redirect("/login");
            }
        }
        return $next($request);
    }
}
