@extends('layout')
@section('content')
<div class="product-details"><!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
        <img src="{{ asset($product_by_details->product_image) }}" alt="" />
            <h3>ZOOM</h3>
        </div>
        {{-- <div id="similar-product" class="carousel slide" data-ride="carousel">
            
              <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                      <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                    </div>
                    <div class="item">
                      <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                    </div>
                    <div class="item">
                      <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                      <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
                    </div>
                    
                </div>

              <!-- Controls -->
              <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>
        </div> --}}

    </div>




    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="{{asset('frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
        <h2>{{ $product_by_details->product_name }}</h2>
            <p>Color: {{ $product_by_details->product_color }}</p>
            <img src="{{asset('frontend/images/product-details/rating.png')}}" alt="" />
            <span>
                <span>BDT {{ $product_by_details->product_price }} Tk</span>
            <form action="{{ url('/add-to-cart') }}" method="post">
                    {{ csrf_field() }}
                    <label>Quantity:</label>
                    <input name="qty" type="text" value="1" />
                    <input type="hidden" name="product_id" value="{{ $product_by_details->product_id }}">
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </form>
            </span>
            <p><b>Availability:</b> In Stock</p>
            <p><b>Condition:</b> New</p>
            <p><b>Brand:</b> {{ $product_by_details->manufacture_name }}</p>
            <p><b>Category:</b> {{ $product_by_details->category_name }}</p>
            <p><b>Size:</b> {{ $product_by_details->product_size }}</p>
        </div><!--/product-information-->
    </div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li><a href="#details" data-toggle="tab">Details</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
            <li><a href="#tag" data-toggle="tab">Tag</a></li>
            <li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="details" >
            <p>{{ $product_by_details->product_long_description }}</p>
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            
        </div>
        
        <div class="tab-pane fade" id="tag" >
            
        </div>
        
        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                
                <b>Rating: </b> <img src="{{asset('frontend/images/product-details/rating.png')}}" alt="" />
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
@endsection