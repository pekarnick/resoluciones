@extends('layouts.resoluciones')
@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-pencil"></i>
        <h3>Resolución</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')

<h1>Show Resolucion</h1>

<p>{{ link_to_route('resolucions.index', 'Return to all resolucions') }}</p>

<table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th>Numero</th>
				<th>Tipo_id</th>
				<th>Fecha</th>
				<th>Resuelve</th>
				<th>Observaciones</th>
				<th>Archivo</th>
				<th>User_id</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $resolucion->numero }}}</td>
					<td>{{{ $resolucion->tipo_id }}}</td>
					<td>{{{ $resolucion->fecha }}}</td>
					<td>{{{ $resolucion->resuelve }}}</td>
					<td>{{{ $resolucion->observaciones }}}</td>
					<td>{{{ $resolucion->archivo }}}</td>
					<td>{{{ $resolucion->user_id }}}</td>
                    <td>{{ link_to_route('resolucions.edit', 'Edit', array($resolucion->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('resolucions.destroy', $resolucion->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
