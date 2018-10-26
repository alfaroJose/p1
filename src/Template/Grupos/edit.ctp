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
        <div style="padding-left: 75px; width: 70%; border-style: solid; border-width: 1px; border-color: black;">
        <?php
        //echo $this->Form->select( 'sigla', ['options' => $cursos]);
        //foreach ($todo as $grupo)
        //debug(iterator_to_array($cursos));
        //die;
            //$cursos = $this->Grupos->obtenerCursos($id);
            echo $this->Form->control('sigla', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'], 'options' => $cursos]);
            echo $this->Form->control('Profesor', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'], 'options' => $correo]);
            //echo $this->Form->control('sigla', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Sigla'],'type' => 'text','readonly' ], ['options' => $cursos]);
            //echo $this->Form->control('usuarios_id', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Profesor'],'type' => 'text','readonly' ]);
            echo $this->Form->control('numero', ['pattern'=>"[0-9]{1,2}",'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Numero de grupo'],'type' => 'text' ]);
            echo $this->Form->control('semestre', ['pattern'=>"[0-9]{1,2}",'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Semestre'],'type' => 'text' ]);
            echo $this->Form->control('año', ['pattern'=>"[0-9]{4,4}",'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => ['text' => 'Año'],'type' => 'text' ]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>
