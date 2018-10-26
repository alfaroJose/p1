<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo $grupo
 */
?>
<div class="grupos form large-9 medium-8 columns content">
    <?= $this->Form->create($grupo) ?>
    <fieldset>
         <br>
        <legend><?= __('Agregar Grupo') ?></legend>
        <div style="padding-left: 75px; width: 70%; border-style: solid; border-width: 1px; border-color: black;">
         <?php
         echo ('<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">');
            echo ('<label> Siglas de Cursos </label>');
            echo $this->Form->select( 'sigla', $cursos );
            echo ('</div><br>');

            echo $this->Form->control('numero',['required'=>true, 'pattern' => '[0-9]{1,2}' ,'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Numero de grupo'],'type' => 'text' ]);
            echo $this->Form->control('semestre',['required'=>true,'pattern' => '[1-3]{1}' ,'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Semestre'],'type' => 'text' ]);
            echo $this->Form->control('año',['required'=>true,'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Año'],'type' => 'text' ]);

            echo ('<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">');
            echo ('<label> Profesores </label>');
            echo $this->Form->select( 'nombre', $profesores );
            echo ('</div><br>');
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>
