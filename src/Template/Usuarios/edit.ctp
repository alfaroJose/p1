<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<div class="usuarios">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <legend><?= __('Modificar usuario') ?></legend>
        <br>
        <h5> Datos personales </h5>

        <div style="border-width: 1px; border-style: solid; border-color: black;">
        <?php
            echo $this->Form->control('nombre', ['templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            echo $this->Form->control('primer_apellido', ['templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            echo $this->Form->control('segundo_apellido', ['templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            echo $this->Form->control('cedula', ['label'=>['text'=>'Cédula'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            echo $this->Form->control('telefono', ['label'=>['text'=>'Teléfono'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);
        ?>
        </div>
        <h5> Datos de seguridad </h5>
        <div style="border-width: 1px; border-style: solid; border-color: black;">

        <?php
            echo $this->Form->control('id', ['required'=>true, 'type' => 'text', 'placeholder'=>'Carné', 'label'=>['text'=>'Usuario'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]); 

            echo $this->Form->control('correo', ['templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            echo $this->Form->control('roles_id', ['options' => $roles, 'empty' => true, 'label'=>['text'=>'Rol'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>