@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
<link href="/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet" />
@stop

@section('titulo')
    <div class="widget-header">
        <i class="icon-pencil"></i>
        <h3>Nueva {{ $tipocarga }}</h3>
    </div> <!-- /widget-header -->
@stop

@section('main')

{{ Form::open(array('action' => 'ResolucionsController@store', 'files' => true)) }}
<div class="row-fluid">
    <div class="span12">
        @include('includes.form_resoluciones')
        <div class="row-fluid">
            <div class="span12">
                <hr>
                {{ Form::submit('Guardar', array('class' => 'btn btn-info')) }}
                {{ link_to_action('ResolucionsController@index', 'Cancelar', null, array('class' => 'btn')) }}
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop

@section('scripts')
    @include('includes.script_form_resolucions')
@stop
