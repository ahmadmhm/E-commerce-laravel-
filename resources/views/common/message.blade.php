@if(session()->has('message'))
    {{--<h1 class="aler alert-success">{{session()->get('message')}}</h1>--}}
    <script>
        swal({
            title: '',
            type: 'success',
            html:'{{session()->get('message')}}',
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonColor: '#00b0ff',
            confirmButtonText: 'تایید'
        });
    </script>
    {{Session::forget('message')}}
@elseif(Session::has('flash_message_success'))
    <script>
        swal({
            title: '',
            type: 'success',
            html:'{!! session('flash_message_success') !!}',
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonColor: '#00b0ff',
            confirmButtonText: 'تایید'
        });
    </script>
@endif