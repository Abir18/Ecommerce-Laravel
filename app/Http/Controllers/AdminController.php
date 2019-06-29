<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// use App\Http\Controllers\Session;
use Session;


class AdminController extends Controller
{
    public function index() {
        return view('admin_login');
    }

    public function dashboard(Request $request) {
        $this->validate ($request, [
            'admin_email' => 'bail|required',
            'admin_password' => 'required'
        ]);


        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin')
                  ->where('admin_email', $admin_email)
                  ->where('admin_password', $admin_password)
                  ->first();
                //   if ($result) {
                //      $request->session()->put('admin_name', $result->admin_name);
                //      $request->session()->put('admin_id', $result->admin_id);
                //      return redirect('/dashboard');

                //   }
                //   else {
                //       $request->session()->put('message', 'Email or Password Invalid');
                //       return redirect('/admin');
                //   }

                  if ($result) {
                     Session::put('admin_name', $result->admin_name);
                     Session::put('admin_id', $result->admin_id);
                     return redirect('/dashboard');

                  }
                  else {
                      Session::put('message', 'Email or Password Invalid');
                      return redirect('/admin');
                  }



                //   print_r($result);
                //   exit();

        // return view('admin.dashboard');
    }
}
