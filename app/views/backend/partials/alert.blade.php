@if(Session::has('alert'))
    <div class="alert alert-{{ Session::get('alert.type') }} fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Aviso!</strong> {{ Session::get('alert.message') }}
    </div>
@endif