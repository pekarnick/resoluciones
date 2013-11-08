<div class="row-fluid">    
    <div class="span3">
        {{ Form::label('numero', 'Numero:') }}
        {{ Form::input('number', 'numero') }}
    </div>
    <div class="span3">
        {{ Form::label('tipo_id', 'Tipo:') }}
        {{ Form::select('tipo_id', $listipos) }}<br/>
        <div id="nuevo-tipo" onclick="nuevotipo();">Nuevo tipo: <small>(Sobrescribe selección)</small></div>
        {{ Form::input('text','tipon',null,array('class' => 'input', 'style' => 'display: none','id' => 'ntipo')) }}
    </div>
    <div class="span3">
        {{ Form::label('fecha', 'Fecha:') }}
        {{ Form::text('fecha') }}
    </div>
    <div class="span3">
        <?php $resolutor = (!empty($resolucion['resuelve'])) ? ucfirst(strtolower($resolucion['resuelve'])) : null; ?>
        {{ Form::label('resuelve', 'Quién resuelve:') }}
        {{ Form::select('resuelve', $nombres, $resolutor) }}
    </div>
</div>
<div class="row-fluid">
    <span class="span6">
        {{ Form::label('tag', 'Tags:') }}
        <table class="table table-condensed table-hover">
            <?php foreach($tags as $tag): ?>
            <tr>
                <td class="col-checkbox">
                    {{ Form::checkbox('tag[]', $tag->id, in_array($tag->id,$checkedarray)) }}
                </td>
                <td>
                    {{ $tag->nombre }}
                </td>
            </tr>
            <?php endforeach; ?>
            </tr>
        </table>
        <table class="table table-condensed table-hover">
            <tr>
                <td>
                    <div id="nuevo-tag" onclick="nuevotag();">Nuevo tag:</div>
                    {{ Form::input('text','tagsn',null,array('class' => 'input', 'style' => 'display: none','id' => 'ntag')) }}
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
        </table>
    </span>
    <div class="span6">
        <div class="row-fluid">
            <div class="span12">
                {{ Form::label('observaciones', 'Descripción:') }}
                {{ Form::textarea('observaciones', null,array('class' => 'input-xxlarge')) }}
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                {{ Form::label('iniciales', 'Iniciales:') }}
                {{ Form::input('text', 'iniciales',null,array('class' => 'input-mini')) }}
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                {{ Form::label('archivo', 'Archivo:') }}
                {{ Form::file('archivo') }}
            </div>
        </div>
    </div>
</div>

