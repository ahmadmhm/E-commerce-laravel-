@extends('layouts.adminLayout.adminMaster')

@section('css')
    <link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}" />
    <link rel="stylesheet" href="{{asset('css/backend_css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
@endsection
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="#">Categories</a>
                <a href="#" class="current">View Products</a> </div>
            <h1>Products</h1>
        </div>
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>View Categories</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Product Color</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr class="gradeX">
                        <td>{{$product->id}}</td>
                        <td>{{$product->category_id}}</td>
                        <td>{{($product->Category()->first() != null)?$product->Category->name:''}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_code}}</td>
                        <td>{{$product->product_color}}</td>
                        <td>{{$product->price}}</td>
                        <th>
                            <img src="{{\App\Helpers\Helpers::product_small_image_asset($product->product_image)}}">
                        </th>
                        <td class="center"><a href="{{route('admin.edit_category', ['id'=>$product->id])}}" class="btn btn-primary btn-mini">Edit</a>
                            <a id="deleteCategory" data-confirm="ahmad" href="{{route('admin.delete_category', ['id'=>$product->id])}}" class="btn btn-danger btn-mini">Delete</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/backend_js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
@endsection
