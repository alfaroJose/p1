<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo $grupo
 */
?>

<div class="grupos form large-9 medium-8 columns content">
    <?= $this->Form->create($grupo) ?>
    <fieldset>
        <legend><?= __('Editar Grupo') ?></legend>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 40%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php

            echo ('<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">');
            echo $this->Form->control( 'sigla',['type'=>'text','readonly','value'=>$cursos[0][0]]);
            echo ('</div><br>');


            echo $this->Form->control('Profesor', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'], 'options' => $correos, 'default'=>$defaultSelectProfesor]);
            echo $this->Form->control('numero', ['pattern'=>"[0-9]{1,2}",'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'], 'label' => ['text' => 'Numero de grupo'],'type' => 'text' ]);
            echo $this->Form->control('Semestre', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'], 'options' => $opcionesSemestre, 'default'=>$defaultSelectSemestre]);
            echo $this->Form->control('año', ['pattern'=>"[0-9]{4}",'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Año'],'type' => 'text' ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>
