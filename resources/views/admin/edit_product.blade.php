@extends('admin_layout')
@section('admin_content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i> 
    </li>
    <li>
        <i class="icon-edit"></i>
        <a href="#">Update Product</a>
    </li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Update Product</h2>
        </div>
        <h2 class="alert-success">
            <?php
                $message = Session::get('message');
                if($message) {
                    echo $message;
                    Session::put('message', null);
                }
            ?>
        </h2>

        <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="box-content">
        <form class="form-horizontal" action="{{ url('/update-product', $product_info->product_id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="date01">Product Name</label>
                  <div class="controls">
                  <input type="text" class="input-xlarge " name="product_name" value="{{ $product_info->product_name }}">
                  </div>
                </div>

                {{-- <div class="control-group">
                  <label class="control-label" for="date01">Product Image</label>
                  <div class="controls">
                  <input type="file" class="input-xlarge " name="product_image" value="{{ $product_info->product_image }}">
                  </div>
                </div> --}}

                <div class="control-group">
                        <label class="control-label" for="date01">Product Price</label>
                        <div class="controls">
                        <input type="text" class="input-xlarge " name="product_price" value="{{ $product_info->product_price }}">
                        </div>
                </div>

                <div class="control-group">
                        <label class="control-label" for="date01">Category Name</label>
                        <div class="controls">
                        <input type="text" class="input-xlarge " name="category_name" value="{{ $product_info->category_name }}">
                        </div>
                </div>

                <div class="control-group">
                        <label class="control-label" for="date01">Manufacture Name</label>
                        <div class="controls">
                        <input type="text" class="input-xlarge " name="manufacture_name" value="{{ $product_info->manufacture_name }}">
                        </div>
                </div>

                {{-- <div class="control-group hidden-phone">
                  <label class="control-label" for="textarea2">product Description</label>
                  <div class="controls">
                    <textarea class="cleditor" name="product_description" rows="3">
                        {{ $product_info->product_description }}
                    </textarea>
                  </div>
                </div> --}}
                
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Update Product</button>
                  <button type="reset" class="btn">Cancel</button>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection
