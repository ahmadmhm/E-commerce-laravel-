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
                <a href="#" class="current">Add Product Attributes</a> </div>
            <h1>Product Attributes</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Add Product Attributes</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{route('admin.add_attributes', ['id'=>$productDetails->id])}}"
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
                                    <label class="control-label">Product Color</label>
                                    <label class="control-label"><strong>{{$productDetails->product_color}}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="field_wrapper">
                                        <div>
                                            <input type="text" name="sku[]" id="sku" placeholder="SKU" required style="width: 15%"/>
                                            <input type="text" name="size[]" id="size" placeholder="Size" required style="width: 15%"/>
                                            <input type="text" name="price[]" id="price" placeholder="Price" required style="width: 15%"/>
                                            <input type="text" name="stock[]" id="stock" placeholder="Stock" required style="width: 15%"/>
                                            <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <input type="submit" value="Add Attributes" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                        <h5>View Attributes</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Attributes ID</th>
                                <th>SKU</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>@php @endphp
                            @foreach($productDetails->Attributes as $attribute)
                                <tr class="gradeX">
                                    <td>{{$attribute->id}}</td>
                                    <td>{{$attribute->sku}}</td>
                                    <td>{{$attribute->size}}</td>
                                    <td>{{$attribute->price}}</td>
                                    <td>{{$attribute->stock}}</td>
                                    <td class="center">
                                        <a data-pid="{{$attribute->id}}" data-link="{{route('admin.delete_product_attribute', ['id'=>$attribute->id])}}"
                                           data-confirm="ahmad" href="javascript:" class="btn btn-danger btn-mini delete-attribute">Delete</a>
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
