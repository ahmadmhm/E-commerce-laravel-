
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
@elseif($errors->any())
    <?php $text =''; ?>
    {{--<div class="alert alert-danger" style="font-size: 0.7em;">--}}
    {{--</div>--}}
    @foreach($errors->all() as $error)
        <?php $text.='<br/>'.$error; ?>
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
@endif