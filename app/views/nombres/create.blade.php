@extends('layouts.resoluciones')

@section('css')
<link href="/css/pages/dashboard.css" rel="stylesheet" />   
<link href="/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet" />
@stop


@section('titulo')
    <div class="widget-header">
        <i class="icon-wrench"></i>
        <h3>Nuevo nombre</h3>
    </div> <!-- /widget-header -->
@stop
@section('main')

{{ Form::open(array('route' => 'nombres.store')) }}
@include('includes.form_nombres')
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


