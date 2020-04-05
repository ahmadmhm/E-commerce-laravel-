@extends('layouts.adminLayout.adminMaster')

@section('css')
    <link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/sweetalert2.min.css')}}" />
@endsection
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="#">Banners</a>
                <a href="#" class="current">Add Banner</a> </div>
            <h1>Form validation</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Add Banner</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{route('admin.edit_banner', ['id'=>$banner->id])}}" name="edit_banner" id="edit_banner"
                                  novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="control-group">
                                    <label class="control-label">Banner Image</label>
                                    <div class="controls">
                                        <input name="banner_image" id="banner_image" type="file" value="{{ old('banner_image',isset($banner->image) ? $banner->image : '') }}"/>
                                        <img style="width: 150px" src="{{ $banner->image? \App\Helpers\Helpers::banner_asset($banner->image):''}}">
                                        @if($banner->image)| <a href="{{route('admin.delete_banner_image',['id'=>$banner->id])}}">Delete</a>@endif
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Banner Title</label>
                                    <div class="controls">
                                        <input type="text" name="banner_title" id="banner_title" value="{{$banner->title}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Link</label>
                                    <div class="controls">
                                        <input type="text" name="link" id="url" value="{{$banner->link}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enable</label>
                                    <div class="controls">
                                        <input type="checkbox" name="status" id="status">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Banner" class="btn btn-success">
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
    <script>
        $(document).ready(function() {
            if({!! $banner->status !!} == 1){
                $("#status").prop('checked', true);
            }
            {{--$("#amount_type option[value='{!! $coupon->amount_type !!}']").prop('selected', true);--}}
            // you need to specify id of combo to set right combo, if more than one combo
        });
    </script>
@endsection
