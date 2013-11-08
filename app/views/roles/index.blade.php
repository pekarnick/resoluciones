@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-wrench"></i>
        <h3>Roles</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')

<p>
    {{ link_to_action('RolesController@create', 'Nuevo Rol', null, array('class' => 'btn btn-large btn-primary')) }}&nbsp;&nbsp;&nbsp;
    {{ link_to_action('PermissionsController@index', 'Permisos', null, array('class' => 'btn btn-large btn-secondary')) }}
</p>

@if ($roles->count())
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Rol</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($roles as $role)
				<tr>
					<td>{{ $role->name }}</td>
					
                                        <td>{{ link_to_route('roles.edit', 'Editar', array($role->id), array('class' => 'btn btn-info')) }}</td>
                                        <td>
                                            {{ Form::open(array('method' => 'DELETE', 'route' => array('roles.destroy', $role->id))) }}
                                                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger', 'onclick' => "return confirm('Esta seguro que desea borrar el Rol: $role->name')")) }}
                                            {{ Form::close() }}
                                        </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no roles
@endif

@stop
