@extends('layouts.adminLayout.adminMaster')

@section('css')
@endsection
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <a href="#">Categories</a>
                <a href="#" class="current">Edit Category</a> </div>
            <h1>Form validation</h1>
        </div>
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Edit Category</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{route('admin.edit_category',['id'=>$category->id])}}" name="edit_category" id="edit_category" novalidate="novalidate">
                                @csrf
                                <div class="control-group">
                                    <label class="control-label">Category Name</label>
                                    <div class="controls">
                                        <input type="text" value="{{ old('category_name',isset($category->name) ? $category->name : '') }}" name="category_name" id="category_name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Category Level</label>
                                    <div class="controls">
                                        <select name="parent_id">
                                            <option value="0">Main Category</option>
                                            @foreach($levels as $level)
                                                <option {{old('parent_id',($level->id == $category->parent_id))? 'selected' : ''}} value="{{$level->id}}">{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Category Description</label>
                                    <div class="controls">
                                        <textarea type="text" name="description" id="description">{{ old('description',isset($category->description) ? $category->description : '') }}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">URL</label>
                                    <div class="controls">
                                        <input type="text" value="{{ old('url',isset($category->url) ? $category->url : '') }}" name="url" id="url">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enable</label>
                                    <div class="controls"><?php  ?>
                                        <input type="checkbox" {{ old('status',(isset($category->status) and $category->status == 1) ? 'checked' : '') }} name="status" id="status">
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Update Category" class="btn btn-success">
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
@endsection
