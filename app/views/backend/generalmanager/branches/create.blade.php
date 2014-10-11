@extends('backend.generalmanager.layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('/assets/plugins/wizard/wizard.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/plugins/jquery-steps/jquery.steps.css') }}">
<style>
.wizard-inline > .content
{
    min-height: 27em !important;
}
</style>
@stop

@section('content')

<div id="main-content">    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Ingreso de <strong>Sucursal</strong></h3>
                            <p>Completa el siguiente formulario:</p>
                            <!-- BEGIN FORM WIZARD WITH VALIDATION -->
                            <form class="form-wizard" action="/branch" method="POST">
                                
                                <h1>Datos de la Sucursal</h1>
                                <section>
                                    <div class="form-group col-md-6">
                                        <label for="branchid">Número de Sucursal *</label>
                                        <input id="branchid" name="branchid" type="text" class="form-control required">
                                    </div>
   			
   			                        <div class="form-group col-md-6">
                                        <label for="street">Dirección *</label>
                                        <input id="street" name="street" type="text" class="form-control required street">
                                    </div>
   			
   									
   									<div class="form-group col-md-6">
                                        <label for="city_id">Ciudad *</label>
                                        <select class="form-control required" id="city_id" name="city_id">
                                            <option selected="selected" disabled>-- Seleccione --</option>
                                            @foreach ($cities as $key => $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach                                                              
                                        </select>
                                    </div>                                
                                    
                                    <div class="form-group col-md-6">
                                        <label for="estado">Estado *</label>
                                        <select class="form-control required" id="estado" name="estado">
                                            <option selected="selected" disabled>-- Seleccione --</option>
                                            <option value="prospecto">Prospecto</option>
                                        </select>
                                    </div>
                                    
									<div class="form-group col-md-6">
                                        <label for="state">Provincia *</label>
                                        <input id="state" name="state" type="text" class="form-control required state">
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="xipcode">Código Postal *</label>
                                        <input id="xipcode" name="xipcode" type="text" class="form-control required xipcode">
                                    </div>
			
			                        <div class="form-group col-md-6">
                                        <label for="country">País *</label>
                                        <select class="form-control required" id="country_id" name="country_id">
                                            <option selected="selected" disabled>-- Seleccione --</option>
                                            @foreach ($countries as $key => $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach                                                              
                                        </select>
                                    </div>     
                                    
                                    <div class="form-group col-md-6">
                                        <label for="phone">Teléfono</label>
                                        <input id="phone" name="phone" type="text" class="form-control">
                                    </div>                                                                 

                                    <p>(*) Obligatorio</p>

                                    <div class="alert alert-danger fade in hide" id="email-alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>Alerta!</strong> El Número de sucursal ya esta registrada en nuestra base de datos.                                        
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
});


</script>

@stop








