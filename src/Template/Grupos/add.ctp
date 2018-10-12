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
            echo $this->Form->control('numero',['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Numero'],'type' => 'text' ]);
            echo $this->Form->control('semestre',['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Sigla'],'type' => 'text' ]);
            echo $this->Form->control('año',['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Año'],'type' => 'text' ]);
            echo $this->Form->control('cursos_sigla',['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Sigla'],'type' => 'text' ]);
            echo ('<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">');
            echo ('<label> Profesor </label>');
            
            echo $this->Form->select('usuarios_id', $usuarios);
            echo ('</div><br>');
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>
