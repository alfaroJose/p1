<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ronda $ronda
 */
?>

<!doctype html>
            <html lang="en">
            <head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <title>jQuery UI Datepicker - Default functionality</title>
              <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
              <link rel="stylesheet" href="/resources/demos/style.css">
              <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
              <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
              <script>
                $.datepicker.regional['es'] = {
             closeText: 'Cerrar',
             prevText: '< Ant',
             nextText: 'Sig >',
             currentText: 'Hoy',
             monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
             monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
             dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
             dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
             dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
             weekHeader: 'Sm',
             dateFormat: 'dd/mm/yy',
             firstDay: 1,
             isRTL: false,
             showMonthAfterYear: false,
             yearSuffix: ''
             };
             $.datepicker.setDefaults($.datepicker.regional['es']);

              $( function() {
                $( "#fecha-inicial" ).datepicker({dateFormat: 'yy-mm-dd', onSelect: function(selected) {$("#fecha-final").datepicker("option","minDate", selected)
}});
              } );
              $( function() {
                $( "#fecha-final" ).datepicker({dateFormat: 'yy-mm-dd'});
              } );
              </script>
            </head>
            </html>

<div class="rondas form large-9 medium-8 columns content ">
    <?= $this->Form->create($ronda) ?>
    <fieldset>
        <legend><?= __('Editar Ronda') ?></legend>
        <?php
        $numeroRonda = array('1' => '1', '2' => '2', '3' => '3');
        echo $this->Form->control('numero', ['templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'],'options' => $numeroRonda,'type'=> 'select']);
            echo $this->Form->control('fecha_inicial',['autocomplete' => 'off','templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'],'type'=> 'text', 'readonly' => 'readonly', 'value'=> '']);
            echo $this->Form->control('fecha_final',['autocomplete' => 'off','templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'],'type'=> 'text', 'readonly' => 'readonly', 'value'=> '']);
        ?>
    </fieldset>



    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right'])?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3 btn-space'])?>
    <?= $this->Form->end() ?>
</div>
