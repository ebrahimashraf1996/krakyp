@if(!empty($success))
    <div class="toast" role="alert" id="success" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <img src="{{asset('assets/front/images/logo.png')}}" width="50" class="rounded me-2" alt="Tangle Kids Wear">
            &nbsp;
            <strong class="me-auto ms-auto">Signture For Digital Marketing</strong>
            {{--            <small id="notify_type"></small>--}}
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>

        </div>
        <div class="toast-body alert alert-success" id="notify_msg">
            {{$success}}
        </div>

    </div>

@endif

