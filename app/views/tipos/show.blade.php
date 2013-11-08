@extends('layouts.scaffold')

@section('main')

<h1>Show Tipo</h1>

<p>{{ link_to_route('tipos.index', 'Return to all tipos') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Nombre</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $tipo->nombre }}}</td>
                    <td>{{ link_to_route('tipos.edit', 'Edit', array($tipo->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('tipos.destroy', $tipo->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
