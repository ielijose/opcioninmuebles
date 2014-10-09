@extends('backend.generalmanager.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('/assets/plugins/wizard/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/jquery-steps/jquery.steps.css') }}">
@stop

@section('content')

<div id="main-content">    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3><strong>Clientes</strong> recepción</h3>
                            <p>Completa el siguiente formulario:</p>
                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-wizard" action="/customer" method="POST">
                                
                                <h1>Datos del cliente</h1>
                                <section>
                                    <div class="form-group col-md-6">
                                        <label for="name">Nombres *</label>
                                        <input id="name" name="name" type="text" class="form-control required">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="lastname">Apellidos *</label>
                                        <input id="lastname" name="lastname" type="text" class="form-control required">
                                    </div>                                  

                                    <div class="form-group col-md-6">
                                        <label for="email">Correo electronico *</label>
                                        <input id="email" name="email" type="text" class="form-control required email">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="phone">Télefono</label>
                                        <input id="phone" name="phone" type="text" class="form-control">
                                    </div>
                                                                     

                                    <p>(*) Obligatorio</p>

                                    <div class="alert alert-danger fade in hide" id="email-alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>Alerta!</strong> El correo electronico ya esta registrado en nuestra base de datos.                                        
                                    </div>


                                </section>
                                <h1>Datos del inmueble</h1>
                                <section>
                                    <div class="form-group col-md-6">
                                        <label for="code">Código del inmueble *</label>
                                        <input id="code" name="code" type="text" class="form-control required">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="estado">Estado *</label>
                                        <select class="form-control required" id="estado" name="estado">
                                            <option selected="selected" disabled>-- Seleccione --</option>
                                            <option value="prospecto">Prospecto</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="category_id">Categoría *</label>
                                        <select class="form-control required" id="category_id" name="category_id">
                                            <option selected="selected" disabled>-- Seleccione --</option>
                                            @foreach (Category::all() as $key => $category)
                                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                            @endforeach                                                              
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="city_id">Ciudad *</label>
                                        <select class="form-control required" id="city_id" name="city_id">
                                            <option selected="selected" disabled>-- Seleccione --</option>
                                            @foreach (City::all() as $key => $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach                                                              
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="portal_id">Portal *</label>
                                        <select class="form-control required" id="portal_id" name="portal_id">
                                            <option selected="selected" disabled>-- Seleccione --</option>
                                            @foreach (Portal::all() as $key => $portal)
                                                <option value="{{ $portal->id }}">{{ $portal->portal }}</option>
                                            @endforeach                                                              
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="service_id">Servicio *</label>
                                        <select class="form-control required" id="service_id" name="service_id">
                                            <option selected="selected" disabled>-- Seleccione --</option>
                                            @foreach (Service::all() as $key => $service)
                                                <option value="{{ $service->id }}">{{ $service->service }}</option>
                                            @endforeach                                                              
                                        </select>
                                    </div>

                                </section>
                                <h1>Observaciones</h1>
                                <section>
                                    <div class="form-group col-md-12">
                                        <label for="observation">Observación </label>
                                        <textarea name="observation" rows="5" class="form-control" placeholder=""></textarea>
                                    </div>
                                </section>
                                
                            </form>
                            <!-- END FORM WIZARD WITH VALIDATION -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('javascript')

<script type="text/javascript" src="{{ asset('/assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/wizard/wizard.js') }}"></script>
<script src="{{ asset('/assets/plugins/jquery-steps/jquery.steps.js') }}"></script>



<script>
$(document).on("ready", function(){

    var email = false;

    /****  Inline Form Wizard with Validation  ****/
    $(".form-wizard").steps({
        bodyTag: "section",
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex > newIndex) {
                return true;
            } 
            // Forbid suppressing "Warning" step if the user is to young
            if (newIndex === 1 && email == false) {
                return false;
            }

            var form = $(this);
            // Clean up if user went backward before
            if (currentIndex < newIndex) {
                // To remove error styles
                $(".body:eq(" + newIndex + ") label.error", form).remove();
                $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
            }
            // Disable validation on fields that are disabled or hidden.
            form.validate().settings.ignore = ":disabled,:hidden";
            // Start validation; Prevent going forward if false
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            
            
        },
        onFinishing: function (event, currentIndex) {
            var form = $(this);
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            var form = $(this);
            form.submit();
        }
    }).validate({
        errorPlacement: function (error, element) {
            element.before(error);
        },
        rules: {}
    });

    /* ajax */

    $("#email").on("change", function(){
        var e = $(this).val();

        $.post('/verify-email', {email: e}, function(data, textStatus, xhr) {
            if(data == 'false'){
                email = false;
                $("#email-alert").removeClass('hide');
            }else if(data == 'true'){
                email = true;
                $("#email-alert").addClass('hide');
            }
        });
    });

})




</script>

@stop








