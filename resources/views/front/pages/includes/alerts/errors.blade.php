@if(Session::has('error'))
    <div class="toast" role="alert"  id="error" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="{{asset('assets/front/images/logo.png')}}" width="50" class="rounded me-2" alt="Tangle Kids Wear">
            &nbsp;
            <strong class="me-auto ms-auto">Tangle Kids Wear</strong>
            {{--            <small id="notify_type"></small>--}}
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>

        </div>
        <div class="toast-body alert alert-danger" id="notify_msg">
            {{Session::get('error')}}
        </div>

    </div>

@endif

