<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;

class CategoryController extends Controller
{
    public function index() {
        $this->AdminAuthCheck();
        return view('admin.add_category');
    }

    public function all_category() {
        $this->AdminAuthCheck();
        $all_category_info = DB::table('tbl_category')->get();
        $manage_category = view('admin.all_category')
            ->with('all_category_info', $all_category_info);
        
        return view('admin_layout')
            ->with('admin.all_category', $manage_category);
    }

    public function save_category(Request $request) {
        $this->validate ($request, [
            'category_name' => 'required',
            'category_description' => 'required',
            'publication_status' => 'required'
        ]);
        
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status;

        DB::table('tbl_category')->insert($data);
        $request->session()->put('message', 'Category Addded Successfully');
        return redirect('/add-category');
    }

    public function inactive_category(Request $request, $category_id) {
        DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->update(['publication_status' => 0]);
            $request->session()->put('message', 'Category Inactive Successfully');
            return redirect('all-category');
    }

    public function active_category(Request $request, $category_id) {
        DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->update(['publication_status' => 1]);
            $request->session()->put('message', 'Category Activated Successfully');
            return redirect('all-category');
    }

    public function edit_category($category_id) {
        $this->AdminAuthCheck();
        $category_info = DB::table('tbl_category')
                            ->where('category_id', $category_id)
                            ->first();

        $category_info = view('admin.edit_category')
                ->with('category_info', $category_info);
        return view('admin_layout')
                ->with('admin.edit_category', $category_info); 
    }

    public function update_category(Request $request, $category_id) {
        $this->validate ($request, [
                'category_name' => 'required',
                'category_description' => 'required'
        ]);
        
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;

        DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->update($data);

            $request->session()->get('message', 'Category Updated Successfully');
            return  redirect('all-category');
    }
        
        public function delete_category(Request $request, $category_id) {
            $this->AdminAuthCheck();
            DB::table('tbl_category')
            ->where('category_id', $category_id)
            ->delete();
            
            $request->session()->get('message', 'Category Deleted Successfully');
            return  redirect('all-category');
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
