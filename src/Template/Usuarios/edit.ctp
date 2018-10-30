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
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 40%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            //Se guarda el usuario de la persona que ha hecho login (carné o nombre.usuario)
            $username = $this->request->getSession()->read('id');


            echo $this->Form->control('nombre', ['pattern'=>"[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,50}", 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('primer_apellido', ['pattern'=>"[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,50}", 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('segundo_apellido', ['pattern'=>"[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,50}", 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

           //Se guarda el tipo de identificación que tiene asignado el usuario para mostrarlo como valor default
            $tipoCedulaActual = $this->Usuario->getTipoCedula($usuario->nombre_usuario);
           
            echo $this->Form->control('tipo_identificacion', ['options' =>["1" => 'Cédula Nacional', "2" => 'Cédula Extranjera', "3" => 'DIMEX', "4" => 'Pasaporte'], 'default'=>$tipoCedulaActual[0], 'empty' => false, 'label'=>['text'=>'Tipo de identificacion'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
            
            //debug($tipoCedulaActual[0]);
            //die();

            echo $this->Form->control('identificacion', ['pattern'=>"[0-9A-Za-z]{1,15}", 'label'=>['text'=>'Identificacion'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('telefono', ['type'=>'tel', 'pattern'=>"[0-9]{8,20}", 'label'=>['text'=>'Teléfono'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
        ?>
        </div>
        <br>
        <h5> Datos de seguridad </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 40%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php       
            
            echo $this->Form->control('nombre_usuario', ['required'=>true, 'type' => 'text', 'readonly', 'label'=>['text'=>'Usuario'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            echo $this->Form->control('correo', ['type'=>'email', 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);

            /*Aquí se verifica el rol del usuario que está logueado, si es admin puede editar los roles en caso contrario el*/
            $rolActual = $this->Usuario->getRol($username);
            
            if($rolActual[0] == '1'){ //Es administrador
                echo $this->Form->control('roles_id', ['options' =>["1" => "Administrador", "2" => "Asistente Administrativo", "3" => "Profesor", "4" => "Estudiante"], 'default'=> $rolActual[0], 'empty' => false, 'label'=>['text'=>'Rol'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
            } else {
                echo $this->Form->control('roles_id', ['value'=> $rolActual[0], 'readonly', 'type' => 'text', 'empty' => false, 'label'=>['text'=>'Rol'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]); 
            }
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>