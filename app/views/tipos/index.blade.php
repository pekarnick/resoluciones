@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-tags"></i>
        <h3>Categorías</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')
<p>{{ link_to_route('tipos.create', 'Nueva Categoría', null, array('class' => 'btn btn-large btn-primary')) }}</p>

@if ($tipos->count())
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Nombre</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($tipos as $tipo)
				<tr>
					<td>{{{ $tipo->nombre }}}</td>
                                        <td>{{ link_to_route('tipos.edit', 'Editar', array($tipo->id), array('class' => 'btn btn-info')) }}</td>
                                        <td>
                                            {{ Form::open(array('method' => 'DELETE', 'route' => array('tipos.destroy', $tipo->id))) }}
                                                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('Esta seguro que desea borrar el tipo de resolución: $tipo->nombre')")) }}
                                            {{ Form::close() }}
                                        </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No se econtraron categorías
@endif

@stop
