@section('css')
    <link rel="stylesheet" href="{{asset('css/frontend_css/easyzoom.css')}}" />
@endsection
@extends('layouts.frontLayout.userMaster')

@section('content')


    <section>
        <div class="container">
            <div class="row">
                @include('layouts.frontLayout.userSidebar')
                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
                                <a href="{{\App\Helpers\Helpers::product_large_image_asset($product->product_image)}}">
                                <img style="width: 90%" class="mainImage" src="{{\App\Helpers\Helpers::product_small_image_asset($product->product_image)}}" alt="" />
                                </a>
                                    <h3>ZOOM</h3>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active thumbnails">
                                        @foreach($product->Images as $image)
                                            <a href="{{\App\Helpers\Helpers::product_large_image_asset($image->image)}}" data-standard="{{\App\Helpers\Helpers::product_large_image_asset($image->image)}}">
                                                <img class="changeImage" width="80px" src="{{\App\Helpers\Helpers::product_small_image_asset($image->image)}}" alt="">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Controls -->
                                <a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <img src="images/product-details/rating.png" class="newarrival" alt="" />
                                <h2>{{$product->product_name}}</h2>
                                <p>Code: {{$product->product_code}}</p>
                                <p>
                                    <select name="size" id="attribute">
                                        <option value="" style="width: 20%">Select Size</option>
                                        @foreach($product->Attributes as $attribute)
                                        <option value="{{$attribute->id}}">{{$attribute->size}}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <img src="images/product-details/rating.png" alt="" />
                                <span>
									<span id="price">US ${{$product->price}}</span>
									<label>Quantity:</label>
									<input type="text" value="3" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
                                <p><b>Availability:</b> In Stock</p>
                                <p><b>Condition:</b> New</p>
                                <p><b>Brand:</b> Ahmad</p>
                                <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                                <li><a href="#care" data-toggle="tab">Care</a></li>
                                <li><a href="#delivery" data-toggle="tab">Delivery</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active in" id="description" >
                                <div class="col-sm-12">
                                    <p>
                                        {{$product->description}}
                                    </p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="care" >
                                <div class="col-sm-12">
                                    <p>
                                        {{$product->care}}
                                    </p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="delivery" >
                                <div class="col-sm-3">
                                    <p>100 % Original</p>
                                </div>
                            </div>
                        </div>
                    </div><!--/category-tab-->
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
<script src="{{asset('js/frontend_js/easyzoom.js')}}"></script>
<script>
        $(document).on('change', '#attribute', function (e) {
            var id = $("#attribute").val() || null;

            if (id != null) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: '{{route("get_product_attribute")}}',
                    data: {attribute_id: id },
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response.price);
                        if(response != 'error'){
                            console.log(response.price);
                            $("#price").html("US $"+response.price);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        });
</script>
@endsection