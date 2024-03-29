<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ManufactureController extends Controller
{
    public function index() {
        $this->AdminAuthCheck();
        return view('admin.add_manufacture');
    }

    public function save_manufacture(Request $request) {
        $this->validate ($request, [
            'manufacture_name' => 'required',
            'manufacture_description' => 'required',
            'publication_status' => 'required'
        ]);
        
        // $this->AdminAuthCheck();
        $data = array();
        $data['manufacture_id'] = $request->manufacture_id;
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;
        $data['publication_status'] = $request->publication_status;

        DB::table('tbl_manufacture')->insert($data);
        $request->session()->put('message', 'Manufacture Addded Successfully');
        return redirect('/add-manufacture');
    }

    public function all_manufacture() {
        $this->AdminAuthCheck();
        $all_manufacture_info = DB::table('tbl_manufacture')->get();
        $manage_manufacture = view('admin.all_manufacture')
            ->with('all_manufacture_info', $all_manufacture_info);
          
        return view('admin_layout')
            ->with('admin.all_manufacture', $manage_manufacture);
    }

    public function edit_manufacture($manufacture_id) {
        $this->AdminAuthCheck();
        $manufacture_info = DB::table('tbl_manufacture')
                            ->where('manufacture_id', $manufacture_id)
                            ->first();

        $manufacture_info = view('admin.edit_manufacture')
                ->with('manufacture_info', $manufacture_info);
        return view('admin_layout')
                ->with('admin.edit_manufacture', $manufacture_info); 
    }

    public function update_manufacture(Request $request, $manufacture_id) {
        $this->validate ($request, [
            'manufacture_name' => 'required',
            'manufacture_description' => 'required'
        ]);
        
        $this->AdminAuthCheck();
        $data = array();
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;

        DB::table('tbl_manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->update($data);

            $request->session()->get('message', 'Manufacture Updated Successfully');
            return  redirect('all-manufacture');
    }

    public function delete_manufacture(Request $request, $manufacture_id) {
        $this->AdminAuthCheck();
        DB::table('tbl_manufacture')
        ->where('manufacture_id', $manufacture_id)
        ->delete();
        
        $request->session()->get('message', 'Manufacture Deleted Successfully');
        return  redirect('all-manufacture');
    }

    public function inactive_manufacture(Request $request, $manufacture_id) {
        $this->AdminAuthCheck();
        DB::table('tbl_manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->update(['publication_status' => 0]);
            $request->session()->put('message', 'Manufacture Inactive Successfully');
            return redirect('all-manufacture');
    }

    public function active_manufacture(Request $request, $manufacture_id) {
        $this->AdminAuthCheck();
        DB::table('tbl_manufacture')
            ->where('manufacture_id', $manufacture_id)
            ->update(['publication_status' => 1]);
            $request->session()->put('message', 'Manufacture Activated Successfully');
            return redirect('all-manufacture');
    }

    public function AdminAuthCheck() {
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return;
        } 
        else {
            return redirect('admin')->send();
        }
    }

}
