@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
<link href="/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet" />
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-pencil"></i>
        <h3>Nueva {{ $tipocarga }}</h3>
    </div> <!-- /widget-header -->
@stop

@section('main')

{{ Form::open(array('action' => 'ResolucionsController@store', 'files' => true)) }}
<div class="row-fluid">
    <div class="span12">
        @include('includes.form_resoluciones')
        <div class="row-fluid">
            <div class="span12">
                <hr>
                {{ Form::submit('Guardar', array('class' => 'btn btn-info')) }}
                {{ link_to_action('ResolucionsController@index', 'Cancelar', null, array('class' => 'btn')) }}
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop

@section('scripts')
<script src="/js/plugins/msgGrowl/js/msgGrowl.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#fecha").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true, //muestra una lista de los meses
        changeYear: true, //muestra una lista de los años
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthNamesShort: ["Ene","Feb","Mar","Abr", "May","Jun","Jul","Ago","Sep", "Oct","Nov","Dic"],
        dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sabado"],
        dayNamesShort: ["Dom","Lun","Mar","Mié","Juv","Vie","Sáb"],
        dayNamesMin: ["Do","Lu","Ma","Mi","Ju","Vi","Sá"],
        weekHeader: "Sm",
        prevText: "",
        nextText: ""
    });
});
<?php if ($errors->any()): ?>
    <?php foreach ($errors->all() as $error): ?>
        <?php if($error == 'El campo observaciones es obligatorio.') { $error = 'El campo descripción es obligatorio.'; } ?>
        $(document).ready(function() {
            $.msgGrowl ({
                type: 'error',
                title: 'Error',
                position: 'top-left',
        //        lifetime: 10000,
                sticky: true,
                text: '<?php echo $error; ?>'
            });
        });
    <?php endforeach; ?>
<?php endif; ?>
function nuevotipo() {
    $('#ntipo').show('slow');
}
function nuevotag() {
    $('#ntag').show('slow');
}
</script>
@stop
