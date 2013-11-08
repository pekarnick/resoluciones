@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-pencil"></i>
        <h3>Tags</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')
<p>{{ link_to_action('TagsController@create', 'Nuevo Tag', null, array('class' => 'btn btn-large btn-primary')) }}</p>

@if ($tags->count())
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Nombre</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($tags as $tag)
				<tr>
					<td>{{{ $tag->nombre }}}</td>
                    <td>{{ link_to_route('tags.edit', 'Editar', array($tag->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('tags.destroy', $tag->id))) }}
                            {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No se encontraron tags
@endif

@stop
