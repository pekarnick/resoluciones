@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-road"></i>
        <h3>Nombres</h3>
    </div> <!-- /widget-header -->
@stop

@section('main')

<p>{{ link_to_route('nombres.create', 'Nuevo nombre', null,array('class' => 'btn btn-primary')) }}</p>

@if ($nombres->count())
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Documentos</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($nombres as $nombre)
				<tr>
					<td>{{{ $nombre->nombre }}}</td>
					<td>{{{ $nombre->documento }}}</td>
                    <td>{{ link_to_route('nombres.edit', 'Editar', array($nombre->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('nombres.destroy', $nombre->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('Esta seguro que desea borrar: $nombre->nombre')")) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no nombres
@endif

@stop
