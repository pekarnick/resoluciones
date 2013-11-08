@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
<link href="/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet" />
@stop


@section('titulo')
    <div class="widget-header">
        <i class="icon-warning-sign"></i>
        <h3>Nuevo permiso</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')

{{ Form::open(array('route' => 'permissions.store')) }}
<div class="row-fluid">
    <div class="span12">
        {{ Form::label('name', 'Nombre:') }}
        {{ Form::text('name', null, array('class' => 'input-xlarge')) }}
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        {{ Form::label('display_name', 'Nombre para mostrar:') }}
        {{ Form::text('display_name', null, array('class' => 'input-xlarge')) }}
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        {{ Form::submit('Guardar', array('class' => 'btn btn-info')) }}
        {{ link_to_route('permissions.index', 'Cancelar', null, array('class' => 'btn')) }}
    </div>
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