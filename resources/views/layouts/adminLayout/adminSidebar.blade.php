<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li @php  if (preg_match("/dashboard/i" , url()->current())){ echo 'class="active"';} @endphp ><a href="{{route('admin.dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
        <li @php  if (preg_match("/category/i" , url()->current())){ echo 'style="display: block;"';} @endphp class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">2</span></a>
            <ul>
                <li @php if (preg_match("/add-category/i" , url()->current())){ echo 'class="active"';} @endphp><a href="{{route('admin.add_category')}}">Add Category</a></li>
                <li @php if (preg_match("/view-categor/i" , url()->current())){ echo 'class="active"';} @endphp><a href="{{route('admin.view_categories')}}">View Categories</a></li>
            </ul>
        </li>
        <li @php  if (preg_match("/product/i" , url()->current())){ echo 'style="display: block;"';} @endphp class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Products</span> <span class="label label-important">2</span></a>
            <ul>
                <li @php if (preg_match("/add-product/i" , url()->current())){ echo 'class="active"';} @endphp><a href="{{route('admin.add_product')}}">Add Product</a></li>
                <li @php if (preg_match("/view-product/i" , url()->current())){ echo 'class="active"';} @endphp><a href="{{route('admin.view_products')}}">View products</a></li>
            </ul>
        </li>
        <li @php  if (preg_match("/coupon/i" , url()->current())){ echo 'style="display: block;"';} @endphp class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupons</span> <span class="label label-important">2</span></a>
            <ul>
                <li @php if (preg_match("/add-coupon/i" , url()->current())){ echo 'class="active"';} @endphp><a href="{{route('admin.add_coupon')}}">Add Coupon</a></li>
                <li @php if (preg_match("/view-coupon/i" , url()->current())){ echo 'class="active"';} @endphp><a href="{{route('admin.view_coupons')}}">View Coupons</a></li>
            </ul>
        </li>
        <li @php  if (preg_match("/order/i" , url()->current())){ echo 'style="display: block;"';} @endphp class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Orders</span> <span class="label label-important">1</span></a>
            <ul>
                <li @php if (preg_match("/view-order/i" , url()->current())){ echo 'class="active"';} @endphp><a href="{{route('admin.view_orders')}}">View Orders</a></li>
            </ul>
        </li>
        <li @php  if (preg_match("/banner/i" , url()->current())){ echo 'style="display: block;"';} @endphp class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Banners</span> <span class="label label-important">2</span></a>
            <ul>
                <li @php if (preg_match("/add-banner/i" , url()->current())){ echo 'class="active"';} @endphp><a href="{{route('admin.add_banner')}}">Add Banner</a></li>
                <li @php if (preg_match("/view-banner/i" , url()->current())){ echo 'class="active"';} @endphp><a href="{{route('admin.view_banners')}}">View Banners</a></li>
            </ul>
        </li>
    </ul>
</div>
<!--sidebar-menu-->