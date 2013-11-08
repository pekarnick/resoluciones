@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />
<link href="/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet" />
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-user"></i>
        <h3>Nuevo Usuario</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')
<form method="POST" action="{{{ (Confide::checkAction('UserController@store')) ?: URL::to('user')  }}}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <div class="row-fluid">
        <div class="span12">
            <div class="form-group">
                <label for="username">Nombre y Apellido</label>
                <input class="form-control input-xxlarge" placeholder="Nombre y Apellido" type="text" name="nombre_y_apellido" id="username" value="{{{ Input::old('nombre_y_apellido') }}}">
            </div>
        </div>
        <div class="row-fluid">
            <div class="span3">
                <div class="form-group">
                    <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
                </div>
            </div>
            <div class="span3">
                <div class="form-group">
                        {{ Form::label('rol', 'Rol') }}
                        {{ Form::select('rol', $roles) }}
                </div>
            </div>
            <div class="span6">
                <div class="form-group">
                    <label for="email">{{{ Lang::get('confide::confide.e_mail') }}}</label>
                    <input class="form-control input-xxlarge" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="form-group">
                    <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <div class="form-group">
                    <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
                    <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
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
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
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