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
                <a href="#">Products</a>
                <a href="#" class="current">View Products</a> </div>
            <h1>Products</h1>
        </div>
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>View Products</h5>
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
                            <img style="width: 100px" src="{{ $product->product_image? \App\Helpers\Helpers::product_small_image_asset($product->product_image):''}}">
                        </th>
                        <td class="center">
                            <a href="#myModal" data-toggle="modal" data-id="{{$product->id}}" class="btn btn-success btn-mini viewProduct" title="View Details">View</a>
                            <a href="{{route('admin.edit_product', ['id'=>$product->id])}}" class="btn btn-primary btn-mini" title="Edit Product">Edit</a>
                            <a href="{{route('admin.add_attributes', ['id'=>$product->id])}}" class="btn btn-success btn-mini" title="Add Attributes">Add</a>
                            <a href="{{route('admin.add_images', ['id'=>$product->id])}}" class="btn btn-info btn-mini" title="Add Image">Add</a>
                            <a data-pid="{{$product->id}}" data-link="{{route('admin.delete_product', ['id'=>$product->id])}}" title="Delete Product" data-confirm="ahmad" href="javascript:" <?php /*href="{{route('admin.delete_product', ['id'=>$product->id])}}"*/?>

                            class="btn btn-danger btn-mini deleteProduct">Delete</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal hide">
        <div class="modal-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <h3 id="title"></h3>
        </div>
        <div class="modal-body">
            <p id="pid"></p>
            <p id="catid"></p>
            <p id="catname"></p>
            <p id="pcode"></p>
            <p id="pcolor"></p>
            <p id="pdes"></p>
            <p id="pprice"></p>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('js/backend_js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/backend_js/matrix.popover.js')}}"></script>
    <script src="{{asset('js/frontend_js/sweetalert2.min.js')}}"></script>
    <script>
        //ajax for checking current password
        $(".viewProduct").bind('click',function () {
            var product_id = $(this).data('id');

            if (product_id.length != 0) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    url: '{{route('admin.get_products')}}',
                    data: {id: product_id},
                    dataType: 'json',
                    success: function (response) {

                        if(response != 'error'){
                            // console.log(response.category);
                            // resetModal();
                            $("#title").html(response.product_name);
                            $("#pid").html("Product ID :"+response.id);
                            $("#catid").html("Category ID :"+response.category.id);
                            $("#catname").html("Category Name :"+response.category.name);
                            $("#pcode").html("Product Code :"+response.product_code);
                            $("#pcolor").html("Product Color :"+response.product_color);

                            $("#pdes").html("Product Description :"+ (response.description != null?response.description:''));
                            $("#pprice").html("Product Price :"+response.price);
                        }
                    },
                    error: function (data) {
                        // console.log(data);
                    }
                });
            }
        });

    function resetModal() {
        $("#title").html('');
        $("#pid").html("Product ID :");
        $("#catid").html("Category ID :");
        $("#catname").html("Category Name :");
        $("#pcode").html("Product Code :");
        $("#pcolor").html("Product Color :");

        $("#pdes").html("Product Description :");
        $("#pprice").html("Product Price :");
    }
    </script>
@endsection
