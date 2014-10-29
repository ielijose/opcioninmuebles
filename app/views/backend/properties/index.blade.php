@extends('backend.layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/plugins/datatables/dataTables.tableTools.css') }}">
    
@stop

@section('content')

<div id="main-content">
    @include('backend.partials.alert')
    <div class="page-title"> <i class="icon-custom-left"></i>
        <h3 class="pull-left"><strong>Listado</strong> de Propiedades</h3>
        <a href="/property/create" class="btn btn-success pull-right m-20"> Nueva Propiedad </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading bg-blue">
                    <h3 class="panel-title"><strong>Listado</strong> de propiedades</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 table-responsive table-blue filter-right">

                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-dynamic">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Dirección</th>
                                        <th>Ciudad</th>
                                        <th>País</th>
                                        <th>Imagen</th>
                                        <th align="center">Visitas</th>
                                        <th align="center">Correos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties as $key => $property)      
                                    <tr>
                                        <td>{{ $property->id }}</td>
                                        <td>{{ $property->address }}</td>
                                        <td> {{ $property->city->name }} </td>
                                        <td>{{ $property->country->name }}</td>
                                        <td><img src="{{ $property->image }} " alt=""></td>
                                        <td align="center" style="font-size:18px">{{ $property->getStatistic('visit')}}</td>
                                        <td align="center" style="font-size:18px">{{ $property->getStatistic('mail')}}</td>
                                        <td><a href="/property/{{ $property->id }}" class="btn btn-info">Ver mas</a></td>
                                    </tr>
                                    @endforeach                                           
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('javascript')
    <script src="{{ asset('/assets/plugins/bootstrap-switch/bootstrap-switch.js') }}"></script>
    <script src="{{ asset('/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/dynamic/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/dataTables.tableTools.js') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/table.editable.js') }}"></script>
    <script src="{{ asset('/assets/js/table_dynamic.js') }}"></script>
@stop