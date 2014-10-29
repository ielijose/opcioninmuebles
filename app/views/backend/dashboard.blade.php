@extends('backend.layouts.master')

@section('css')
    <link href="/assets/plugins/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">
    <link href="/assets/plugins/pickadate/themes/default.css" rel="stylesheet">
    <link href="/assets/plugins/pickadate/themes/default.date.css" rel="stylesheet">
    <link href="/assets/plugins/pickadate/themes/default.time.css" rel="stylesheet">
@endsection

@section('content')

<div id="main-content" class="dashboard">
    {{--<div class="row m-t-20">
        <div class="col-md-3 col-sm-12">
            <div class="panel no-bd bd-3 panel-stat">
                <div class="panel-body bg-blue p-15">
                    <div class="row m-b-10">
                        <div class="col-xs-3">
                            <i class="glyph-icon flaticon-visitors"></i>
                        </div>
                        <div class="col-xs-9">
                            <div class="live-tile" data-mode="carousel"
                                data-direction="vertical" data-delay="3500" data-height="56">
                                <div>
                                    <small class="stat-title">Visits today</small>
                                    <h1 class="m-0 w-300">25 610</h1>
                                </div>
                                <div>
                                    <small class="stat-title">Visits yesterday</small>
                                    <h1 class="m-0 w-300">22 420</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <small class="stat-title">New Visitors</small>
                            <div class="live-tile" data-mode="carousel"
                                data-direction="vertical" data-delay="3500" data-height="30">
                                <div>
                                    <h3 class="m-0 w-300">37.5%</h3>
                                </div>
                                <div>
                                    <h3 class="m-0 w-300">34.2%</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <small class="stat-title">Bounce Rate</small>
                            <div class="live-tile" data-mode="carousel"
                                data-direction="vertical" data-delay="3500" data-height="30">
                                <div>
                                    <h3 class="m-0 w-500">5.6%</h3>
                                </div>
                                <div>
                                    <h3 class="m-0 w-500">7.4%</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <div class="panel no-bd bd-3 panel-stat">
                <div class="panel-body bg-red p-15">
                    <div class="row m-b-6">
                        <div class="col-xs-3">
                            <i class="glyph-icon flaticon-educational"></i>
                        </div>
                        <div class="col-xs-9">
                            <small class="stat-title">PAGES VIEW</small>
                            <h1 class="m-0 w-500">201k</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <small class="stat-title">Duration</small>
                            <h3 class="m-0 w-500">18:25</h3>
                        </div>
                        <div class="col-xs-6">
                            <small class="stat-title">Pages / visits</small>
                            <h3 class="m-0 w-500">21</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <div class="panel no-bd bd-3 panel-stat">
                <div class="panel-body bg-green p-15">
                    <div class="row m-b-0">
                        <div class="col-xs-3">
                            <i class="glyph-icon flaticon-orders"></i>
                        </div>
                        <div class="col-xs-9">
                            <small class="stat-title">ORDERS THIS MONTH</small>
                            <div class="live-tile" data-delay="4000"
                                data-animation-easing="fade" data-height="47">
                                <div>
                                    <h1 class="m-0 w-500 bg-green">148</h1>
                                </div>
                                <div>
                                    <h1 class="m-0 w-500 bg-green">+28%</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <small class="stat-title">Last month</small>
                            <div class="live-tile" data-delay="4000"
                                data-animation-easing="fade" data-height="30">
                                <div class="bg-green">
                                    <h3 class="m-0 w-500">126</h3>
                                </div>
                                <div class="bg-green">
                                    <h3 class="m-0 w-500">$12,545</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <small class="stat-title">Last week</small>
                            <div class="live-tile" data-delay="4000"
                                data-animation-easing="fade" data-height="30">
                                <div class="bg-green">
                                    <h3 class="m-0 w-500">41</h3>
                                </div>
                                <div class="bg-green">
                                    <h3 class="m-0 w-500">$4,237</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12">
            <div class="panel no-bd bd-3 panel-stat">
                <div class="panel-body bg-dark p-15">
                    <div class="row m-b-6">
                        <div class="col-xs-3">
                            <i class="glyph-icon flaticon-incomes"></i>
                        </div>
                        <div class="col-xs-9">
                            <small class="stat-title">INCOMES THIS MONTH</small>
                            <h1 class="m-0 w-500">
                                $<span class="animate-number" data-value="42567"
                                    data-animation-duration="1400">0</span>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <small class="stat-title">Last month</small>
                            <h3 class="m-0 w-500">
                                $<span class="animate-number" data-value="38547"
                                    data-animation-duration="1400">0</span>
                            </h3>
                        </div>
                        <div class="col-xs-6">
                            <small class="stat-title">Last week</small>
                            <h3 class="m-0 w-500">
                                $<span class="animate-number" data-value="8754"
                                    data-animation-duration="1400">0</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                            <h2>Hola {{ Auth::user()->name() }}! Bienvenido al BackOffice de Opción Inmuebles.</h2>
                        </div>                  
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="graph-wrapper">
                                <div class="graph-info p-r-10">
                                    <a href="javascript:void(0)" class="btn bg-green">Correos</a>
                                    <a href="javascript:void(0)" class="btn bg-blue">Visitas</a>

                                    <a href="javascript:void(0)" class="btn bg-purple filter">Filtrar</a>
                                    <button href="#" id="bars" class="btn" disabled>
                                        <span></span>
                                    </button>
                                    <button href="#" id="lines" class="btn active" disabled>
                                        <span></span>
                                    </button>
                                </div>
                                <div class="h-300">
                                    <div class="h-300" id="graph-lines" style="width: 100%"></div>
                                    <div class="h-300" id="graph-bars" style="width: 100%"></div>
                                </div>
                            </div>

                            <input type="hidden" id="start" value="{{ Input::get('start') }}">
                            <input type="hidden" id="end" value="{{ Input::get('end') }}">
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{--<div class="row">        
        <div class="col-lg-12 m-b-20">
            <div class="modal fade" id="event-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                            <h4 class="modal-title">
                                <strong>Manage</strong> my events
                            </h4>
                        </div>
                        <div class="modal-body">
                            <p></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success save-event">Create
                                event</button>
                            <button type="button" class="btn btn-danger delete-event"
                                data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div id="external-events" class="bg-white row m-0">
                <div class="col-md-4 p-0">
                    <div class="widget bg-gray-l">
                        <div class="widget-body p-b-0">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <h2 class="panel-title width-100p c-blue w-500 f-20 carrois"
                                        id="calender-current-day">Events Manager</h2>
                                    <div id='external-events'>
                                        <br> <br> <br>
                                        <div class="external-event bg-green" data-class="bg-green"
                                            style="position: relative;">
                                            <i class="fa fa-move"></i>Sport
                                        </div>
                                        <div class="external-event bg-purple" data-class="bg-purple"
                                            style="position: relative;">
                                            <i class="fa fa-move"></i>Meeting
                                        </div>
                                        <div class="external-event bg-red" data-class="bg-red"
                                            style="position: relative;">
                                            <i class="fa fa-move"></i>Work
                                        </div>
                                        <div class="external-event bg-blue" data-class="bg-blue"
                                            style="position: relative;">
                                            <i class="fa fa-move"></i>Children
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-md-offset-1 p-0 no-bd">
                    <div class="widget bg-white">
                        <div class="widget-body p-b-0">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
</div>


<div class="modal fade" id="modal-filter" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="#">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Filtrar estadisticas</strong> </h4>
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

@endsection

@section('javascript')

<script src="{{ asset('assets/plugins/metrojs/metrojs.min.js') }}"></script>
<script src="{{ asset('assets/plugins/fullcalendar/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/simple-weather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('assets/plugins/google-maps/markerclusterer.js') }}"></script>
<script src="{{ asset('http://maps.google.com/maps/api/js?sensor=true') }}"></script>
<script src="{{ asset('assets/plugins/google-maps/gmaps.js') }}"></script>
<script src="{{ asset('assets/plugins/charts-flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/plugins/charts-flot/jquery.flot.animator.min.js') }}"></script>
<script src="{{ asset('assets/plugins/charts-flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('assets/plugins/charts-flot/jquery.flot.time.min.js') }}"></script>
<script src="{{ asset('assets/plugins/charts-morris/raphael.min.js') }}"></script>
<script src="{{ asset('assets/plugins/charts-morris/morris.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('assets/js/calendar.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script src="{{ asset('assets/js/dashboard.angular.js') }}"></script>




<script src="{{ asset('assets/plugins/datetimepicker/jquery.datetimepicker.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('assets/plugins/pickadate/picker.js')}}"></script>
<script src="{{ asset('assets/plugins/pickadate/picker.date.js')}}"></script>
<script src="{{ asset('assets/plugins/pickadate/picker.time.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap-switch/bootstrap-switch.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap-progressbar/bootstrap-progressbar.js')}}"></script>

<script>
    
    /* Filtrado */

    $(".filter").on("click", function(){
        $("#modal-filter").modal();
    });


    $('#filter-action').on('click', function (e) {
        var start = $('.start').data('date') || '';
        var end = $('.end').data('date') || '';
        location.href = "?start="+start+"&end="+end;
    })



</script>

@endsection

