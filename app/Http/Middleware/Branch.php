<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Branches;

class Branch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->route('branch_id')) {
            return redirect('/'); 
        }
        
        $branch = Branches::where('command', explode('-', $request->route('branch_id')))->where('branch_id', explode('-', $request->route('branch_id'))[1])->first();
        $request->merge(['branch' => $branch]);
        $request->flash();
        if($branch->is_active) {
            return $next($request);
        } else {
           $isHeader = (explode('/', $request->getPathInfo())[2] == 'pos') ? $request->navbar : true;
           $isFooter = (explode('/', $request->getPathInfo())[2] == 'pos') ? $request->footer : true;
            abort(403, 'account_suspended', ['navbar' => $isHeader, 'footer' => $isFooter]);
        }

    }
}
