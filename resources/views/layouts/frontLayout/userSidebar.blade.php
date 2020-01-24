<!--sidebar-menu-->
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            @foreach($categories as $category)
                @if($category->parent_id == '0' and $category->status == 1)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian" href="#{{$category->id}}">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    {{$category->name}}
                                </a>
                            </h4>
                        </div>
                        <div id="{{$category->id}}" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    @foreach($categories as $categoryIn)
                                        @if($categoryIn->parent_id == $category->id and $categoryIn->status == 1)
                                            <li><a href="{{route('categorize_products',['url'=>$categoryIn->url])}}">{{$categoryIn->name}} </a></li>
                                        @endif

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div><!--/category-products-->

    </div>
</div>
<!--sidebar-menu-->