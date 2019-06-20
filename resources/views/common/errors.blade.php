@if(Session::has('flash_message_error'))
    <script>
        swal({
            title: 'خطا',
            type: 'error',
            html:'{!! session('flash_message_error') !!}',
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonColor: '#00b0ff',
            confirmButtonText: 'تایید'
        });
    </script>
@elseif(count($errors)>0)
    <?php $text =''; ?>
    {{--<div class="alert alert-danger" style="font-size: 0.7em;">--}}
    {{--</div>--}}
    @foreach($errors->all() as $error)
        <?php $text.='<br/>'.$error.'.'; ?>
    @endforeach

    <script>

        swal({
            title: '',
            type: 'error',
            html:'{!! $text !!}',
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonColor: '#00b0ff',
            confirmButtonText: 'تایید'
        });
    </script>
@elseif(session()->has('st'))
    {{--<h1 class="aler alert-success">{{session()->get('message')}}</h1>--}}
    <script>
        swal({
            title: '',
            type: 'error',
            html:'{{session()->get('st')}}',
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonColor: '#00b0ff',
            confirmButtonText: 'تایید'
        });
    </script>
    {{Session::forget('st')}}
@endif