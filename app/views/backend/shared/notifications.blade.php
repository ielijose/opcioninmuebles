@extends('backend.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('/assets/plugins/font-awesome-animation/font-awesome-animation.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/dropzone/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/jcrop/jquery.Jcrop.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/profile.min.css') }}">
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
@stop

@section('content')

<div id="main-content">
    @include('backend.partials.alert')
    <a href="javascript:void(0)" class="btn bg-purple filter pull-right">Filtrar</a>
    <div class="row">
        <div class="col-md-12">
            @if(count($notifications))
            <ul class="timeline">

                @foreach ($notifications as $key => $notification) 

                <li @if($key % 2 == 1) class="timeline-inverted"@endif>
                    <div class="timeline-badge bg-blue" data-rel="tooltip" title="{{ $notification->getHumanDate() }}"></div>

                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <div class="pull-left">
                                <div class="timeline-day-number">{{ $notification->getDay() }}</div>
                                <div>
                                    <div class="timeline-day">{{ $notification->getNameDay() }}</div>
                                    <div class="timeline-month c-gray">{{ $notification->getMonth() }} {{ $notification->getYear() }}</div>
                                </div>
                            </div>                                                        
                        </div>
                        <div class="timeline-body">
                            <a href="{{ $notification->getLink() }}">
                                <h4><strong>{{ $notification->notification }} </strong></h4>
                            </a>
                            <p>
                                De: {{ $notification->getReminder() }} <br>
                                Cliente: <a href="{{ $notification->getLink() }}"> <strong>{{ $notification->customer->name }} {{ $notification->customer->lastname }}</strong></a>
                            </p>
                        </div>
                    </div>
                </li>

                @endforeach
                
            </ul>
            @else
            <h3 class="text-center">No hay resultados.</h3>
            @endif
        </div>
    </div>
</div>
<div class="pull-right m-20 m-r-20">
 <?php echo $notifications->links(); ?> 
</div>

<div class="modal fade" id="modal-filter" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="#">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel"><strong>Filtrar notificaciones</strong> </h4>
                </div>
                <div class="modal-body ">                   

                    <div class="row" align="center">
                        <h3>Desde:</h3>
                        <div class="datepicker start" data-inline="true" data-date-format="yyyy-mm-dd"></div>
                    </div>

                    <div class="row" align="center">
                        <h3>Hasta:</h3>
                        <div class="datepicker end" data-inline="true" data-date-format="yyyy-mm-dd"></div>
                    </div>

                </div>        
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="filter-action">Filtrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="{{ asset('/assets/plugins/google-maps/gmaps.js') }}"></script>
<script src="{{ asset('/assets/js/timeline.js') }}"></script>

<script src="{{ asset('assets/plugins/bootstrap-progressbar/bootstrap-progressbar.js')}}"></script>

<script type="text/javascript">
$(document).on("ready", function(){
    /* Filtrado */

    $(".filter").on("click", function(){
        $("#modal-filter").modal();
    });


    $('#filter-action').on('click', function (e) {
        var d = new Date();
        var defaultDate = d.getFullYear() +"-"+ ('0' + (d.getMonth()+1)).slice(-2) +"-"+ ('0' + d.getDate()).slice(-2);
        var start = $('.start').data('date') || defaultDate;
        var end = $('.end').data('date') || defaultDate;
        location.href = "?start="+start+"&end="+end;
    })
});
</script>
@stop