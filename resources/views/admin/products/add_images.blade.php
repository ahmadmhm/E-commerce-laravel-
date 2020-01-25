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
                <a href="#" class="current">Add Product Images</a> </div>
            <h1>Product Images</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Add Product Images</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{route('admin.add_images', ['id'=>$productDetails->id])}}"
                                  name="add_attribute" id="add_attribute" enctype="multipart/form-data">
                                @csrf
                                <div class="control-group">
                                    <label class="control-label">Product Name</label>
                                    <label class="control-label"><strong>{{$productDetails->product_name}}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Code</label>
                                    <label class="control-label"><strong>{{$productDetails->product_code}}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">File upload input</label>
                                    <div class="controls">
                                        <input name="product_image[]" id="product_image" type="file" multiple="multiple" />
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="submit" value="Add Image" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Images</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Image ID</th>
                                <th>Product ID</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>@php @endphp
                            @foreach($productDetails->Images as $image)
                                <tr class="gradeX">
                                    <td>{{$image->id}}</td>
                                    <td>{{$image->product_id}}</td>
                                    <td><img style="width: 150px;" src="{{ $image->image? \App\Helpers\Helpers::product_small_image_asset($image->image):''}}"></td>
                                    <td class="center">
                                        <a data-pid="{{$image->id}}" data-link="{{route('admin.delete_product_images', ['id'=>$image->id])}}"
                                           data-confirm="ahmad" href="javascript:" class="btn btn-danger btn-mini delete-image">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
