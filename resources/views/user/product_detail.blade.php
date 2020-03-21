@section('css')
    <link rel="stylesheet" href="{{asset('css/frontend_css/easyzoom.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
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
                            <form id="addtocart" name="addtocart" action="{{route('addToCart')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <input type="hidden" name="product_attribute_id" value="0">
                                <div class="product-information"><!--/product-information-->
                                    <img src="images/product-details/rating.png" class="newarrival" alt="" />
                                    <h2>{{$product->product_name}}</h2>
                                    <p>Code: {{$product->product_code}}</p>
                                    <p>
                                        <select style="width: 150px;" name="" id="attribute">
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
									<input type="text" name="quantity" value="1" />
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
                                    <p id="availability"><b>Availability:</b> In Stock</p>
                                    <p><b>Condition:</b> New</p>
                                    <p><b>Brand:</b> Ahmad</p>
                                    <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                                </div><!--/product-information-->

                            </form>
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
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php $s = 1; ?>
                                @foreach($relatedProducts->chunk(3) as $pack)
                                    @if($s == 1)
                                       <div class="item active">
                                           <?php $s=0; ?>
                                           @foreach($pack as $item)
                                               <div class="col-sm-4">
                                                    <div class="product-image-wrapper">
                                                            <div class="single-products">
                                                                <div class="productinfo text-center">
                                                                    <img style="width: 230px;" src="{{\App\Helpers\Helpers::product_small_image_asset($item->product_image)}}" alt="" />
                                                                    <h2>${{$item->price}}</h2>
                                                                    <p>Easy Polo Black Edition</p>
                                                                    <a href="{{route('product',['id'=>$item->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                               </div>
                                           @endforeach
                                       </div>
                                    @else
                                        <div class="item">
                                            @foreach($pack as $item)
                                                <div class="col-sm-4">
                                                    <div class="product-image-wrapper">
                                                        <div class="single-products">
                                                            <div class="productinfo text-center">
                                                                <img style="width: 230px;" src="{{\App\Helpers\Helpers::product_small_image_asset($item->product_image)}}"alt="" />
                                                                <h2>${{$item->price}}</h2>
                                                                <p>Easy Polo Black Edition</p>
                                                                <a href="{{route('product',['id'=>$item->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
<script src="{{asset('js/frontend_js/easyzoom.js')}}"></script>
<script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
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
                            //console.log(response.price);
                            $("#price").html("US $"+response.price);
                            $('input[name=product_attribute_id]').val(response.id);
                            if(response.stock == 0){
                                $(".cart").hide();
                                $("#availability").html('<b>Availability:</b> Out Of Stock');
                            }else {
                                $(".cart").show();
                                $("#availability").html('<b>Availability:</b> In Stock');
                            }
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