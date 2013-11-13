@extends('layouts.scaffold')

@section('main')

<h1>Show Nombre</h1>

<p>{{ link_to_route('nombres.index', 'Return to all nombres') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Nombre</th>
				<th>Documento</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $nombre->nombre }}}</td>
					<td>{{{ $nombre->documento }}}</td>
                    <td>{{ link_to_route('nombres.edit', 'Edit', array($nombre->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('nombres.destroy', $nombre->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
