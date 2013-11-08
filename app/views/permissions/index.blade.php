@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
@stop
@section('titulo')
    <div class="widget-header">
        <i class="icon-warning-sign"></i>
        <h3>Permisos</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')
<p>
    {{ link_to_action('PermissionsController@create', 'Nuevo permiso', null, array('class' => 'btn btn-large btn-primary')) }}&nbsp;&nbsp;&nbsp;
</p>

@if ($permissions->count())
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th>Nombre para mostrar</th>
                                <th>Rol permitido</th>
                                <th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
                    <?php 
                        $color = array(
                            1 => 'btn-primary',
                            2 => 'btn-warning',
                            3 => 'btn-success',
                            4 => 'btn-danger',
                        );
                    ?>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>
                                {{{ $permission->display_name }}}
                            </td>
                            <td>
                                <?php
                                    foreach($permisosasignados as $permisoasignado):
                                        if($permission->id == $permisoasignado->permissionid) {
                                            if(!empty($color[$permisoasignado->roleid]))
                                                echo '<span class="btn btn-small '.$color[$permisoasignado->roleid].'">'.$permisoasignado->rolename.'</span>&nbsp;&nbsp;';
                                            else {
                                                echo '<span class="btn btn-small">'.$permisoasignado->rolename.'</span>&nbsp;&nbsp;';
                                            }
                                        }
                                    endforeach;
                                ?>
                            </td>
                            <td>
                                {{ link_to_route('permissions.edit', 'Editar', array($permission->id), array('class' => 'btn btn-info')) }}
                            </td>
                        </tr>
                    @endforeach
		</tbody>
	</table>

<pre>
<?php //print_r($permisosasignados); ?>
</pre>

        
@else
	There are no permissions
@endif

@stop
