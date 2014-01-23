@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-pencil"></i>
        <h3>Documentos</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')
@if((strtolower($rolusuario) == 'administrador') || (strtolower($rolusuario) == 'usuarios') || (strtolower($rolusuario) == 'jefe - director'))
    <p>{{ link_to_action('ResolucionsController@create', 'Cargar Resolución', array('tipo' => 'R'), array('class' => 'btn btn-large btn-primary')) }} {{ link_to_action('ResolucionsController@create', 'Cargar Memorándum', array('tipo' => 'M'), array('class' => 'btn btn-large btn-secondary')) }} {{ link_to_action('ResolucionsController@create', 'Cargar Disposición', array('tipo' => 'D'), array('class' => 'btn btn-large btn-primary')) }}</p> 
@endif
<fieldset>
    <legend>Buscar</legend>
    <form name="form1" action="" method="get" id="filter">
        <style type="text/css">
            #tablasearch tr td {
                vertical-align: bottom;
            }
            #tablasearch tr td .btn {
                margin-bottom: 10px;
            }
        </style>
        <table id="tablasearch" cellpadding="5">
            <tr>
                <td>
                    {{ Form::label('texto', 'Descripción contiene:') }}
                    {{ Form::input('text', 'texto', Session::get('busqueda.texto')) }}
                </td>
                <td>
                    {{ Form::label('numero', 'Número:') }}
                    {{ Form::input('number', 'numero', Session::get('busqueda.numero')) }}
                </td>
                <td>
                    <?php $anio = (Session::get('busqueda.anio') != null) ? Session::get('busqueda.anio') : date('Y'); ?>
                    {{ Form::label('anio', 'Año:') }}
                    {{ Form::select('anio', $anios, $anio) }}
                </td>
                <td>
                    {{ Form::label('tipo_id', 'Categoría:') }}
                    {{ Form::select('tipo_id', $listipos, Session::get('busqueda.tipo_id')) }}
                </td>
            </tr>
            <tr>
                <td>
                    <?php
                    function fechanorm($fechamysql) {
                        if($fechamysql != null) {
                            $fechanormal = explode('-', $fechamysql);
                            $fechanormal = $fechanormal[2].'/'.$fechanormal[1].'/'.$fechanormal[0];
                        } else {
                            $fechanormal = null;
                        }
                        return $fechanormal;
                    }
                    ?>
                    {{ Form::label('fdesde', 'Fecha desde:') }}
                    {{ Form::input('text', 'fdesde', fechanorm(Session::get('busqueda.fdesde')), array('class' => 'fecha')) }}
                </td>
                <td>
                    {{ Form::label('fhasta', 'Fecha hasta:') }}
                    {{ Form::input('text', 'fhasta', fechanorm(Session::get('busqueda.fhasta')), array('class' => 'fecha')) }}
                </td>
                <td>
                    {{ Form::label('user_id', 'Usuario:') }}
                    {{ Form::select('user_id', $usuarios, Session::get('busqueda.user_id')) }}
                </td>
                <td>
                    {{ Form::label('documento', 'Tipo:') }}
                    {{ Form::select('documento', array('' => '-- Seleccione --','Resolución' => 'Resolución','Disposición' => 'Disposición','Memorándum' => 'Memorándum'), Session::get('busqueda.documento')) }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    {{ Form::label('tags', 'Palabras clave:') }}
                    <small>(Escriba los tags)</small><br />
                    {{ Form::input('text', 'palabra', null, array('class' => 'input-small', 'id' => 'palabra')) }}<button id="showauto" onclick="return false;" class="btn">Seleccionar</button>
                    {{ Form::input('text', 'tags', Session::get('busqueda.tags'), array('class' => 'input-xxlarge','readonly' => 'readonly')) }}
                </td>
                <td colspan="1">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#" onclick="document.form1.submit(); return false;" class="btn btn-success">Buscar</a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/restablecerbuscador" class="btn">Mostrar todos</a>
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<hr>
@if (!empty($resolucions))
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Número</th>
                                <th>Fecha</th>
				<th>Tipo<br />Categoría</th>
				<th>Resuelve</th>
				<th>Archivo</th>
                                <th>Iniciales</th>
				<th>Usuario</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($resolucions as $resolucion)
				<tr>
					<td>{{{ $resolucion->numero }}}</td>
                                        <?php $dia = explode('-', $resolucion->fecha); ?>
					<td>{{{ $dia[2].'/'.$dia[1].'/'.$dia[0] }}}</td>
					<td>
                                            {{{ $resolucion->documento }}}<br />
                                            {{{ $resolucion->tipo_de_resolucion }}}
                                        </td>
					<td>{{{ $resolucion->resuelve }}}</td>
                                        <td>{{ link_to('descarga/'.str_replace('/', '-', $resolucion->archivo).'/DVP-'.$resolucion->numero, 'Descargar', $attributes = array('target' => '_blank','class' => 'btn btn-warning btn-xs'), $secure = null) }}</td>
					<td>{{{ $resolucion->iniciales }}}</td>
                                        <td>{{{ $resolucion->usuario }}}</td>
                                        <td>
                                            {{ link_to_route('resolucions.show', 'Detalles', array($resolucion->id), array('class' => 'btn btn-success')) }}
                                        </td>
                                        <td>
                                            @if(Auth::user()->hasRole("Administrador") || Auth::user()->hasRole("Jefe - Director"))
                                                {{ link_to_action('ResolucionsController@edit', 'Editar', array($resolucion->id), array('class' => 'btn btn-info')) }}
                                            @elseif(Auth::user()->id == $resolucion->userid)
                                                {{ link_to_action('ResolucionsController@edit', 'Editar', array($resolucion->id), array('class' => 'btn btn-info')) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(Auth::user()->hasRole("Administrador") || Auth::user()->hasRole("Jefe - Director"))
                                                {{ Form::open(array('method' => 'DELETE', 'action' => array('ResolucionsController@destroy', $resolucion->id))) }}
                                                    {{ Form::submit('Eliminar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('Esta seguro que desea borrar << $resolucion->documento Nº $resolucion->numero >>')")) }}
                                                {{ Form::close() }}
                                            @endif
                                        </td>
				</tr>
			@endforeach
		</tbody>
	</table>
        {{ $resolucions->links() }}
@else
	No se encontraron resoluciones
@endif

@stop

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $(".fecha").datepicker({
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
$(document).ready(function() {
    $("#palabra").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "/users/tags",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function(data) {
              
              response($.map(data, function(item) {
                return {
                      label: item.value,
                      value: ""
                };
              }));
          }
        });
      },
      minLength: 0,
      select: function(event, ui) {
          valant = $('#tags').attr('value');
          if($('#tags').attr('value')) {
              $('#tags').attr('value',valant+","+ui.item.label);
          } else {
              $('#tags').attr('value',ui.item.label);
          }
          $('#palabra').attr('value','');
      }
    }).focus(function(){            
        $(this).data("uiAutocomplete").search($(this).val());
    });
    $('#showauto').click(function() {
        $('#palabra').trigger("focus"); //or "click", at least one should work
    });
});
</script>
@stop