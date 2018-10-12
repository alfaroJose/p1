<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario

 */
?>
<div class = "float-right">   
         <?= $this->Html->image('ucrLogo.png', ['alt' => 'CakePHP', 'width'=>"287", 'height' => '125']);?>     
</div>

 <div class = "float-left">
         <?= $this->html->image('ecciLogo.png',['alt' => 'CakePHP', 'width'=>"287", 'height' => '85']);?>
</div>
<br>
<br>
<br>
<br>
<br>
<div class="usuarios form large-9 medium-8 columns content">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <legend><?= __('Agregar Usuario') ?></legend>
        <br>
        <h5> Datos personales </h5>

        <div style="padding-left: 75px; width: 40%; border-style: solid; border-width: 1px; border-color: black;">
        <?php           
            
            echo $this->Form->control('nombre', ['required'=>true, 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('primer_apellido', ['required'=>true, 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('segundo_apellido', ['required'=>true, 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('cedula', ['required'=>true, 'pattern'=>"[0-9]{9}", 'label'=>['text'=>'Cédula'], 'placeholder'=>'123456789', 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('telefono', ['required'=>true, 'type'=>'tel', 'pattern'=>"[0-9]{8}", 'label'=>['text'=>'Teléfono'], 'placeholder'=>'88881111', 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
        ?>
        </div>
        <br>
        <h5> Datos de seguridad </h5>
        <div style="padding-left: 75px; width: 40%; border-width: 1px; border-style: solid; border-color: black;">

        <?php

            echo $this->Form->control('id', ['required'=>true, 'type' => 'text', 'pattern'=>".{6,50}", 'placeholder'=>'nombre.apellido', 'label'=>['text'=>'Usuario'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]); 
            
            echo $this->Form->control('correo', ['required'=>true, 'type'=>'email', 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('roles_id', ['required'=>true, 'options' =>['Administrador', 'Asistente administrativo','Profesor', 'Estudiante'], 'empty' => false, 'label'=>['text'=>'Rol'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>
