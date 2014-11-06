@extends('backend.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('/assets/plugins/font-awesome-animation/font-awesome-animation.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/dropzone/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/jcrop/jquery.Jcrop.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/profile.min.css') }}">
@stop

@section('content')

<div id="main-content">
    @include('backend.partials.alert')
        
    <div class="row">
        <div class="col-md-12">
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
        </div>
    </div>
</div>
@stop

@section('javascript')
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="{{ asset('/assets/plugins/google-maps/gmaps.js') }}"></script>
<script src="{{ asset('/assets/js/timeline.js') }}"></script>

<script type="text/javascript">
$(document).on("ready", function(){

});
</script>
@stop