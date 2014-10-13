@extends('backend.generalmanager.layouts.master')

@section('css')
@stop

@section('content')

<div id="main-content">
            <div class="page-title"> <i class="icon-custom-left"></i>
                <h2>Usuarios <small> listado general</small></h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <div class="row">
                                
                                @foreach ($users as $key => $user)                                    
                                <div class="col-md-4 member-entry">
                                    <div class="row member">
                                        <div class="col-xs-3">
                                            <img src="{{ $user->getProfilePicture() }}" alt="avatar 1" class="pull-left img-responsive">
                                        </div>
                                        <div class="col-xs-9">
                                            <h3 class="m-t-0 member-name"><strong>{{ $user->full_name }}</strong></h3>
                                            <div>
                                                <p><i class="fa fa-envelope-o c-gray-light p-r-10"></i> {{ $user->email }}</p>
                                                <p><i class="fa fa-briefcase c-gray-light p-r-10"></i> {{ $user->getTypeName() }}</p>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                


                            </div>
                            <div class="m-t-30 align-center">
                                {{ $users->links() }}
                               {{-- <ul class="pagination">
                                    <li><span><i class="fa fa-angle-left c-gray-light"></i></span></li>
                                    <li class="active"><span>1</span></li>
                                    <li><a href="members.html#">2</a></li>
                                    <li><a href="members.html#">3</a></li>
                                    <li><span>...</span></li>
                                    <li><a href="members.html#">9</a></li>
                                    <li><a href="members.html#"><i class="fa fa-angle-right"></i></a></li>
                                </ul>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@stop

@section('javascript')
    <script src="{{ asset('/assets/plugins/quicksearch/jquery.quicksearch.js') }}"></script>
    <script src="{{ asset('/assets/js/members.js') }}"></script>
@stop