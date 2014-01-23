<script src="/js/plugins/msgGrowl/js/msgGrowl.js"></script>
<script type="text/javascript">
var pagina = 1;
$(document).ready(function() {
    $("#fecha").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true, //muestra una lista de los meses
        changeYear: true, //muestra una lista de los años
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
        monthNamesShort: ["Ene","Feb","Mar","Abr", "May","Jun","Jul","Ago","Sep", "Oct","Nov","Dic"],
        dayNames: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sabado"],
        dayNamesShort: ["Dom","Lun","Mar","Mié","Juv","Vie","Sáb"],
        dayNamesMin: ["Do","Lu","Ma","Mi","Ju","Vi","Sá"],
        weekHeader: "Sm",
        prevText: "",
        nextText: ""
    });
});
<?php if ($errors->any()): ?>
    <?php foreach ($errors->all() as $error): ?>
        <?php if($error == 'El campo observaciones es obligatorio.') { $error = 'El campo descripción es obligatorio.'; } ?>
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
<?php endif; ?>
function nuevotipo() {
    $('#ntipo').show('slow');
}
function nuevotag() {
    $('#ntag').show('slow');
}
function nuevapagina() {
    pagina = pagina + 1;
    agregar = '<br>Pág. ' + pagina + ' <input name="archivo[archivo][]" type="file" id="archivo"><input type="hidden" value="'+ pagina +'" name="archivo[pagina][]">';
    $('.filesfield').append(agregar);
}
</script>