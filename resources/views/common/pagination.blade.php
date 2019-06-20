@if($paginator!=Null)
    @if ($paginator->lastPage() > 1)
    <div class="clear"></div>
    <ul class="pagination center">
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }} waves-effect padding-0"><a href="{{ $paginator->appends(Input::except('page'))->url(1) }}">ابتدا</a></li>
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }} waves-effect padding-0"><a href="{{ $paginator->appends(Input::except('page'))->url($paginator->currentPage()-1) }}"><i class="mdi-navigation-chevron-right"></i></a></li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ ($paginator->currentPage() == $i) ? ' active' : 'waves-effect' }}"><a href="{{ $paginator->appends(Input::except('page'))->url($i) }}">{{ $i }}</a></li>
        @endfor
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }} waves-effect padding-0"><a href="{{ $paginator->appends(Input::except('page'))->url($paginator->currentPage()+1) }}"><i class="mdi-navigation-chevron-left"></i></a></li>
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }} waves-effect padding-0"><a href="{{ $paginator->appends(Input::except('page'))->url($paginator->lastPage())  }}">انتها</a></li>
        <li class="left">صفحه <span class="page-count">{{$paginator->currentPage()}}</span> از <span class="total-page">{{$paginator->lastPage()}}</span></li>
    </ul>
    <div class="clear"></div>
    @endif
@endif