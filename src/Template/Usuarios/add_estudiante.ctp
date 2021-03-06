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
        <br>
        <h5> Datos personales </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 40%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">   <?php           
            
            echo $this->Form->control('nombre', ['required'=>true, 'pattern'=>"[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,50}", 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
            echo $this->Form->control('primer_apellido', ['required'=>true, 'pattern'=>"[A-Za-zñÑáéíóúÁÉÍÓÚ\s{1,50}", 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
            echo $this->Form->control('segundo_apellido', ['pattern'=>"[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,50}", 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
            echo $this->Form->control('tipo_identificacion', ['required'=>true, 'options' =>['Cédula Nacional', 'Cédula Extranjera','DIMEX', 'Pasaporte'], 'empty' => false, 'label'=>['text'=>'Tipo de identificacion'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
            echo $this->Form->control('identificacion', ['required'=>true, 'pattern'=>"[0-9A-Za-z]{1,15}", 'label'=>['text'=>'Identificacion'], 'placeholder'=>'123456789', 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
            echo $this->Form->control('telefono', ['required'=>true, 'type'=>'tel', 'pattern'=>"[0-9]{8,20}", 'label'=>['text'=>'Teléfono'], 'placeholder'=>'88881111', 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
        ?>
        </div>
        <br>
        <h5> Datos de seguridad </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 40%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            $username = $this->request->getSession()->read('id');
            echo $this->Form->control('nombre_usuario', ['value' => $username, 'readonly', 'required'=>true, 'type' => 'text', 'pattern'=>".{6,50}", 'placeholder'=>'Carné', 'label'=>['text'=>'Usuario'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]); 
            
            echo $this->Form->control('correo', ['required'=>true, 'type'=>'email', 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);;
            echo $this->Form->control('roles_id', ['type' => 'text', 'required'=>true, 'value' => 'Estudiante', 'readonly', 'empty' => false, 'label'=>['text'=>'Rol'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]); 
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right', 'onClick'=>'form.submit();this.disabled=true']) ?>
    <?= $this->Html->link(__('Cancelar'),['controller' => 'Inicio', 'action'=>'inicio'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>