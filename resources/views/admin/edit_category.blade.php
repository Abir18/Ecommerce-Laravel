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
        <a href="#">Update Category</a>
    </li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Update Category</h2>
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
        <form class="form-horizontal" action="{{ url('/update-category', $category_info->category_id) }}" method="POST">
                {{ csrf_field() }}

              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="date01">Category Name</label>
                  <div class="controls">
                  <input type="text" class="input-xlarge " name="category_name" value="{{ $category_info->category_name }}">
                  </div>
                </div>

                <div class="control-group hidden-phone">
                  <label class="control-label" for="textarea2">Category Description</label>
                  <div class="controls">
                    <textarea  name="category_description" rows="3">
                        {{ $category_info->category_description }}
                    </textarea>
                  </div>
                </div>
                
                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Update Category</button>
                  <button type="reset" class="btn"><a href="{{ url('/all-category') }}">Cancel</a></button>
                </div>
              </fieldset>
            </form>   

        </div>
    </div><!--/span-->

</div><!--/row-->
@endsection
