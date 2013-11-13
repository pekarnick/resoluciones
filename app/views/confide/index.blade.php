@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-user"></i>
        <h3>Usuarios</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')
<p>
    {{ link_to_action('UserController@create', 'Nuevo usuario', null, array('class' => 'btn btn-large btn-primary')) }}&nbsp;&nbsp;&nbsp;
@if((strtolower($rolusuario) == 'administrador'))
    {{ link_to_action('RolesController@index', 'Roles', null, array('class' => 'btn btn-large btn-secondary')) }}
@endif
</p>
<?php $sino = array(0 => 'No', 1 => 'Si') ?>
@if (!empty($usuarios))
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre de usuario</th>
				<th>Nombre y apellido</th>
                                <th>Rol</th>
				<th>Habilitado</th>
                                <th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
                    <?php 
                        $color = array(
                            0 => '',
                            1 => 'btn-primary',
                            2 => 'btn-warning',
                            3 => 'btn-success',
                            4 => 'btn-danger',
                        );
                    ?>
			@foreach ($usuarios as $user)
				<tr>
					<td>{{{ $user->id }}}</td>
					<td>{{{ $user->username }}}</td>
                                        <td>{{{ $user->nombre_y_apellido }}}</td>
                                        <td><span class="btn btn-small {{ ($user->roleid != "" && !empty($color[$user->roleid])) ? $color[$user->roleid] : $color[0] }}">{{{ $user->rolename }}}</span></td>
					<td>{{{ $sino[$user->confirmed] }}}</td>
                                        <td>
                                            {{ link_to_action('UserController@edit', 'Editar', array($user->id), array('class' => 'btn btn-info')) }}&nbsp;&nbsp;
                                            <?php
                                                switch ($user->confirmed) {
                                                    case 0:
                                                        echo link_to('users/habilitar/'.$user->id, 'Hablitar', array('class' => 'btn btn-success'),$secure = null);
                                                    break;
                                                    case 1:
                                                        echo link_to('users/habilitar/'.$user->id, 'Deshabilitar', array('class' => 'btn btn-danger'),$secure = null);
                                                    break;
                                                }
                                            ?>
                                        </td>
                                        
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No se encontraron usuarios
@endif

@stop