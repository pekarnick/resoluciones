@extends('layouts.resoluciones')
@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-pencil"></i>
        <h3>Detalles - {{ $resolucion->documento }}</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')
<?php
    function cambiar_a_normal($fechahora, $h = false) {
        $fechahora = explode(' ', $fechahora);
        $fechanormal = explode('-', $fechahora[0]);
        if(!$h) {
            return $fechanormal[2].'/'.$fechanormal[1].'/'.$fechanormal[0];
        } else {
            return $fechahora[1];
        }
    }
?>
<p>{{ link_to_route('resolucions.index', 'Volver', null, array('class' => 'btn btn-primary')) }}</p>
<div class="row-fluid">
    <div class="span4">
        <b>Número:</b><br>
        {{{ $resolucion->numero }}}
    </div>
    <div class="span4">
        <b>Fecha:</b><br>
        <?php
            $fechan = explode('-', $resolucion->fecha);
            echo $fechan[2].'/'.$fechan[1].'/'.$fechan[0];
        ?>
    </div>
    <div class="span4">
        <b>Por:</b><br>
        {{{ $resolucion->resuelve }}}
    </div>
</div>
<div class="row-fluid">
    <div class="span12">&nbsp;</div>
</div>
<div class="row-fluid">
    <div class="span4">
        <b>Categoría:</b><br>
        {{{ $resolucion->tipo_de_resolucion }}}<br><br>
        <b>Añadido por:</b><br>
        {{{ $resolucion->usuario }}}<br><br>
        <b>Añadido el:</b>  <?php echo cambiar_a_normal($resolucion->created_at) ?> <b>a las:</b> <?php echo cambiar_a_normal($resolucion->created_at, true) ?><br>
        <b>Modificado el:</b> <?php echo cambiar_a_normal($resolucion->updated_at) ?> <b>a las:</b> <?php echo cambiar_a_normal($resolucion->updated_at, true) ?>
    </div>
    <div class="span8">
        <b>Descripción:</b><br>
        {{{ $resolucion->observaciones }}}
    </div>
</div>
<br><br>
<embed src="{{ URL::to($resolucion->archivo) }}" height="600" width="100%" />
@stop
