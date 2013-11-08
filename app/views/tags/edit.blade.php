@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />
<link href="/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet" />
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-pencil"></i>
        <h3>Editar Tag</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')

{{ Form::model($tag, array('method' => 'PATCH', 'route' => array('tags.update', $tag->id))) }}

<div class="row-fluid">
    <div class="span12">
        {{ Form::label('nombre', 'Nombre:') }}
        {{ Form::text('nombre') }}
    </div>
    <div class="span12">
        {{ Form::submit('Guardar', array('class' => 'btn btn-info')) }}
        {{ link_to_action('TagsController@index', 'Cancelar', null, array('class' => 'btn btn-default')) }}
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