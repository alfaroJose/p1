<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div class="usuarios form large-9 medium-8 columns content">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <legend><?= __('Agregar Usuario') ?></legend>
        <?php           

            echo $this->Form->control('id', ['required'=>true, 'type' => 'text', 'placeholder'=>'Carné', 'label'=>['text'=>'Usuario'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]); 

            echo $this->Form->control('nombre', ['required'=>true, 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            echo $this->Form->control('primer_apellido', ['required'=>true, 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            echo $this->Form->control('segundo_apellido', ['required'=>true, 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            echo $this->Form->control('cedula', ['required'=>true, 'label'=>['text'=>'Cédula'], 'placeholder'=>'123456789', 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            echo $this->Form->control('telefono', ['required'=>true, 'type'=>'tel', 'label'=>['text'=>'Teléfono'], 'placeholder'=>'88881111', 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            echo $this->Form->control('correo', ['required'=>true, 'type'=>'email', 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            echo $this->Form->control('roles_id', ['required'=>true, 'options' => $roles, 'empty' => true, 'label'=>['text'=>'Rol'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
66    <?= $this->Form->end() ?>
</div>
