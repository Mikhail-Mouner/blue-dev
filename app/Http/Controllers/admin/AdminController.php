<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getLogin()
    {
        return view('admin.login');
    }
 
    public function login(Request $request)
    {
        $remeber = (boolval($request->rember_me))? true : false ;
        $admin = auth()->guard('admin')->attempt([ 'name' => $request->name, 'password' => $request->password ],$remeber);
        if ($admin)
            return redirect(route('admin.home'));
        return redirect(route('admin.getLogin'));
            
    }

    public function logout()
    {
        Auth::logout();
    }
}
