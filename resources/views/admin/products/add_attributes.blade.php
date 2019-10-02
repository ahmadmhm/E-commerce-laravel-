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
