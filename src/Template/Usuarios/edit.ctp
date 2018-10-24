<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */

use Cake\ORM\TableRegistry;
?>

<div class="usuarios">
    <?= $this->Form->create($usuario) ?>
    <fieldset>
        <legend><?= __('Modificar usuario') ?></legend>
        <br>
        <h5> Datos personales </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 40%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            echo $this->Form->control('nombre', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('primer_apellido', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('segundo_apellido', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('tipo_identificacion', ['options' =>['Cédula Nacional', 'Cédula Extranjera','DIMEX', 'Pasaporte'], 'empty' => false, 'label'=>['text'=>'Tipo de identificacion'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('identificacion', ['label'=>['text'=>'Identificacion'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('telefono', ['label'=>['text'=>'Teléfono'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
        ?>
        </div>
        <br>
        <h5> Datos de seguridad </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 40%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php       
            
            echo $this->Form->control('nombre_usuario', ['required'=>true, 'type' => 'text', 'readonly', 'label'=>['text'=>'Usuario'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('correo', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);


            /*Aquí se verifica el rol del usuario que está logueado, si es admin puede editar los roles en caso contrario el campo rol no es editable*/
            $username = $this->request->getSession()->read('id');
            $users = TableRegistry::get('Usuarios');
            $index = $users->find()
            ->select(['roles_id'])
            ->where(['nombre_usuario =' => $username])
            ->first();
            
            if($index->roles_id == 1){ //Es administrador
                echo $this->Form->control('roles_id', ['options' =>['Administrador','Asistente administrativo','Profesor', 'Estudiante'], 'empty' => false, 'label'=>['text'=>'Rol'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            } else {
                echo $this->Form->control('roles_id', ['value'=> $usuario->roles_id, 'readonly', 'type' => 'text', 'empty' => false, 'label'=>['text'=>'Rol'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]); 
            }
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>