@extends('layouts.adminLayout.adminMaster')

@section('css')
    <link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
@endsection
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="#">Products</a>
                <a href="#" class="current">Edit Product</a> </div>
            <h1>Form validation</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Edit Product</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{route('admin.edit_product',['id'=>$product->id])}}" name="add_product"
                                  id="edit_product" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="control-group">
                                    <label class="control-label">Under Category</label>
                                    <div class="controls">
                                        <select name="category_id" id="category_id" style="width: 220px">
                                            {!! $levels !!}
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Name</label>
                                    <div class="controls">
                                        <input value="{{ old('product_name',isset($product->product_name) ? $product->product_name : '') }}" type="text" name="product_name" id="product_name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Code</label>
                                    <div class="controls">
                                        <input value="{{ old('product_code',isset($product->product_code) ? $product->product_code : '') }}" type="text" name="product_code" id="product_code">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Color</label>
                                    <div class="controls">
                                        <input value="{{ old('product_color',isset($product->product_color) ? $product->product_color : '') }}" type="text" name="product_color" id="product_color">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Description</label>
                                    <div class="controls">
                                        <textarea type="text" name="description" id="description">{{ old('description',isset($product->description) ? $product->description : '') }}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Material & Care</label>
                                    <div class="controls">
                                        <textarea type="text" name="care" id="description">{{ old('care',isset($product->care) ? $product->care : '') }}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Price</label>
                                    <div class="controls">
                                        <input value="{{ old('price',isset($product->price) ? $product->price : '') }}" type="text" name="price" id="price">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">File upload input</label>
                                    <div class="controls">
                                        <input value="{{ old('product_image',isset($product->product_image) ? $product->product_image : '') }}" name="product_image" id="product_image" type="file" />
                                        <img style="width: 100px" src="{{ $product->product_image? \App\Helpers\Helpers::product_small_image_asset($product->product_image):''}}">
                                        | <a href="{{route('admin.delete_product_image',['id'=>$product->id])}}">Delete</a>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="submit" value="Udate Product" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/backend_js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
    {{--    <script src="{{asset('js/backend_js/select2.min.js')}}"></script>--}}
@endsection
