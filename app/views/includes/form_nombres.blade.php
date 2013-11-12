<?php
$documentos = array(
    'Resolución' => 'Resolución',
    'Disposición' => 'Disposición',
    'Memorándum' => 'Memorándum'
);
?>
<div class="row-fluid">
    <div class="span12">
        {{ Form::label('nombre', 'Nombre:') }}
        {{ Form::text('nombre') }}
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        {{ Form::label('documento', 'Documento:') }}
        {{ Form::select('documento', $documentos) }}
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        {{ Form::submit('Guardar', array('class' => 'btn btn-info')) }}
        {{ link_to_route('nombres.index', 'Cancelar', null, array('class' => 'btn')) }}
    </div>
</div>