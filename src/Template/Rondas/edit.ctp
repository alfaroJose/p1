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

              $( function() {
                $( "#fecha-inicial" ).datepicker({dateFormat: 'yy-mm-dd'});
              } );
              $( function() {
                $( "#fecha-final" ).datepicker({dateFormat: 'yy-mm-dd'});
              } );
              </script>
            </head>
            <body>
             
            
             
             
            </body>
            </html>

<div class="rondas form large-9 medium-8 columns content ">
    <?= $this->Form->create($ronda) ?>
    <fieldset>
        <legend><?= __('Editar Ronda') ?></legend>
        <?php
            echo $this->Form->control('fecha_inicial',['autocomplete' => 'off','templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'],'type'=> 'text']);
            echo $this->Form->control('fecha_final',['autocomplete' => 'off','templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'],'type'=> 'text']);
        ?>
    </fieldset>



    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right'])?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3 btn-space'])?>
    <?= $this->Form->end() ?>
</div>
