@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
<link href="/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet" />
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-user"></i>
        <h3>Editar Usuario</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')
{{ Form::model($usuario[0], array('method' => 'post', 'url' => array(URL::to('user/edit/'.$usuario[0]->id)))) }}
<div class="row-fluid">
        <div class="span12">
            <div class="form-group">
                {{ Form::label('nombre_y_apellido', 'Nombre y apellido:') }}
                {{ Form::text('nombre_y_apellido', null, array('class' => 'input-xxlarge')) }}
            </div>
        </div>
        <div class="row-fluid">
            <div class="span3">
                <div class="form-group">
                    {{ Form::label('username', 'Nombre de usuario:') }}
                    {{ Form::text('username') }}
                </div>
            </div>
            <div class="span3">
                <div class="form-group">
                    {{ Form::label('rol', 'Rol') }}
                    {{ Form::select('rol', $roles, $usuario[0]->roleid) }}
                </div>
            </div>
            <div class="span6">
                <div class="form-group">
                    {{ Form::label('email', 'Correo electrónico:') }}
                    {{ Form::text('email') }}
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="form-group">
                    {{ Form::label('password', 'Contraseña:') }}
                    {{ Form::password('password') }}
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Contraseña:') }}
                    {{ Form::password('password_confirmation') }}
                </div>
            </div>
        </div>
    </div>
    @if ( Session::get('error') )
        <div class="alert alert-error alert-danger">
            @if ( is_array(Session::get('error')) )
                {{ head(Session::get('error')) }}
            @endif
        </div>
    @endif

    @if ( Session::get('notice') )
        <div class="alert">{{ Session::get('notice') }}</div>
    @endif

    <div class="form-actions form-group">
        {{ Form::submit('Guardar', array('class' => 'btn btn-info')) }}
        {{ link_to('users', 'Cancelar', array('class' => 'btn'),$secure = null) }}
    </div>
{{ Form::close() }}
@stop

@section('scripts')
<script src="/js/plugins/msgGrowl/js/msgGrowl.js"></script>
<?php if ($errors->any()): ?>
<script type="text/javascript">
    <?php foreach ($errors->all() as $error): ?>
        $(document).ready(function() {
            $.msgGrowl ({
                type: 'error',
                title: 'Error',
                position: 'top-left',
        //        lifetime: 10000,
                sticky: true,
                text: '<?php echo $error; ?>'
            });
        });
    <?php endforeach; ?>
</script>
<?php endif; ?>
@stop