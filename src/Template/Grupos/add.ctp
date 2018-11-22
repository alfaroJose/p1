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

            echo $this->Form->control('Sigla', ['label' => 'Sigla De Curso', 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'], 'options' => $siglaIndex, 'default'=>$defaultSelectCurso]);

            echo $this->Form->control('numero',['required'=>true, 'pattern' => '{[1-9]([0-9])?}' ,'placeholder'=>'01','templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Numero De grupo'],'type' => 'text' ]);

            echo $this->Form->control('Semestre', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'], 'options' => $opcionesSemestre, 'default'=>$defaultSelectSemestre]);

            echo $this->Form->control('año',['required'=>true, 'pattern' => '[0-9]{4}','placeholder'=>'0000','templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Año'],'type' => 'text' ]);

            echo $this->Form->control('Profesor', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'], 'options' => $correos, 'default'=>$defaultSelectProfesor]);
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>