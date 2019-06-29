<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class ProductController extends Controller
{
    public function index() {
        $this->AdminAuthCheck();
        return view('admin.add_product');
    }

    

    public function save_product(Request $request) {
        $this->validate ($request, [
            'product_name' => 'required',
            'product_short_description' => 'required',
            'category_id' => 'required',
            'manufacture_id' => 'required',
            'product_price' => 'required',
            'publication_status' => 'required'
        ]);
        
        $this->AdminAuthCheck();
        $data = array();
            $data['product_name'] = $request->product_name;
            $data['category_id'] = $request->category_id;
            $data['manufacture_id'] = $request->manufacture_id;
            $data['product_short_description'] = $request->product_short_description;
            $data['product_long_description'] = $request->product_long_description;
            $data['product_price'] = $request->product_price;
            $data['product_size'] = $request->product_size;
            $data['product_color'] = $request->product_color;
            $data['publication_status'] = $request->publication_status;
            $image = $request->file('product_image');
        if($image) {
            $image_name = str_random(40);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);
            if($success) {
                $data['product_image'] = $image_url;
                    DB::table('tbl_products')->insert($data);
                    $request->session()->put('message', 'Product Added Successfully');
                    return redirect('add-product');
            }
        }
        $data['product_image'] = '';
                    DB::table('tbl_products')->insert($data);
                    $request->session()->put('message', 'Product Added Successfully without image');
                    return redirect('add-product');
    }

    public function all_product() {
        $this->AdminAuthCheck();
        $all_products_info = DB::table('tbl_products')
                                ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
                                ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
                                ->select('tbl_products.*', 'tbl_category.category_name', 'tbl_manufacture.manufacture_name')
                                ->get();
                                
                                
        $manage_products = view('admin.all_products')
        ->with('all_products_info', $all_products_info);
        
        return view('admin_layout')
        ->with('admin.all_products', $manage_products);
    }
    
    public function inactive_product(Request $request, $product_id) {
        $this->AdminAuthCheck();
        DB::table('tbl_products')
        ->where('product_id', $product_id)
        ->update(['publication_status' => 0]);
        $request->session()->put('message', 'Product Inactive Successfully');
        return redirect('all-product');
    }
    
    public function active_product(Request $request, $product_id) {
        $this->AdminAuthCheck();
        DB::table('tbl_products')
        ->where('product_id', $product_id)
        ->update(['publication_status' => 1]);
        $request->session()->put('message', 'Product Activated Successfully');
        return redirect('all-product');
    }
    
    public function edit_product($product_id) {
        $product_info = DB::table('tbl_products')
                            ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
                            ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
                            ->select('tbl_products.*', 'tbl_category.category_name', 'tbl_manufacture.manufacture_name')
                            ->where('product_id', $product_id)
                            ->first();
        
        $product_info = view('admin.edit_product')
        ->with('product_info', $product_info);
        return view('admin_layout')
        ->with('admin.edit_product', $product_info); 
    }
    
    public function update_product(Request $request, $product_id) {
        $this->validate ($request, [
            'product_name' => 'required',
            'product_price' => 'required',
            'manufacture_name' => 'required',
            'category_name' => 'required'
        ]);
        
        $this->AdminAuthCheck();
        $data = array();
        $data['product_name'] = $request->product_name;
        // $data['product_image'] = $request->file('product_image');
        $data['product_price'] = $request->product_price;
        $data['category_name'] = $request->category_name;
        $data['manufacture_name'] = $request->manufacture_name;




        DB::table('tbl_products')
            ->where('product_id', $product_id)
            ->join('tbl_category', 'tbl_products.category_id', '=', 'tbl_category.category_id')
            ->join('tbl_manufacture', 'tbl_products.manufacture_id', '=', 'tbl_manufacture.manufacture_id')
            ->select('tbl_products.*', 'tbl_category.category_name', 'tbl_manufacture.manufacture_name')
            ->update($data);
        
            $request->session()->get('message', 'Product Updated Successfully');
            return  redirect('all-product');
    }


    public function delete_product(Request $request, $product_id) {
        $this->AdminAuthCheck();
        DB::table('tbl_products')
        ->where('product_id', $product_id)
        ->delete();
        
        $request->session()->get('message', 'Product Deleted Successfully');
        return  redirect('all-product');
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

