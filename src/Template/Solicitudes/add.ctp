<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
 */
?>
<div class="solicitudes form large-9 medium-8 columns content">
    <?= $this->Form->create($solicitude) ?>
    <fieldset>
        <legend><?= __('Nueva Solicitud') ?></legend>
        <br>
        <h5> Datos del estudiante </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            /*Aquí se pide el nombre de usuario (cané para estudiantes) de la persona logueada*/
            $username = $this->request->getSession()->read('id');

            /*Aquí se solicita la información del estudiante según el carné de la persona logueada*/
            $datosEstudiante = $this->Solicitude->getStudentInfo($username);
            $idEstudiante = $datosEstudiante[0];
            $nombreEstudiante = $datosEstudiante[1];
            $primerApellidoEstudiante = $datosEstudiante[2];
            $segundoApellidoEstudiante = $datosEstudiante[3];
            $correoEstudiante = $datosEstudiante[4];
            $telefonoEstudiante = $datosEstudiante[5];
            $cedulaEstudiante = $datosEstudiante[7];

            echo $this->Form->control('primer_apellido', ['readonly', 'value'=>$primerApellidoEstudiante, 'templates'=> ['inputContainer'=>'<div class="row col-xs-6 col-sm-6 col-md-6 col-lg-6">{{content}}</div><br>']]);
            echo $this->Form->control('segundo_apellido', ['readonly', 'value'=>$segundoApellidoEstudiante]);
            echo $this->Form->control('nombre', ['readonly', 'value'=>$nombreEstudiante]);
            echo $this->Form->control('identificacion', ['label'=>['text'=>'Identificación'], 'readonly', 'value'=>$cedulaEstudiante]);
            echo $this->Form->control('carne', ['label'=>['text'=>'Carné'], 'readonly', 'value'=>$username]);
            echo $this->Form->control('telefono', ['label'=>['text'=>'Teléfono'], 'readonly', 'value'=>$telefonoEstudiante]);
            echo $this->Form->control('correo', ['readonly', 'value'=>$correoEstudiante]);
            echo $this->Form->control('carrera');

            //¿Qué tipo de horas desea solicitar? <checkbox></checkbox> <input type="checkbox"> Horas Asistente <input type="checkbox"> Horas Estudiante -->
            echo ("Solicita:");
            echo $this->Form->control('horas_estudiante', ['label' =>['text'=>'Horas Estudiante'], 'type' => 'checkbox']);
            echo $this->Form->control('horas_asistente', ['label' =>['text'=> 'Horas Asistente'], 'type' => 'checkbox']);
            echo ("(Puede marcar ambas opciones)<br>");
            echo ( "Documentos que debe adjuntar al entregar el formulario en la ECCI:<br> 
                1. Entregar este formulario debidamente en la Secretaría de la ECCI 
                sin la firma del docente.<br>
                2. Si es su primera asistencia en la UCR debe traer además una carta de un Banco Público en la que certfique su número de cuenta de ahorro o cuenta cliente y copia de su documento de identificación.<br><br>");

            echo ("Información sobre otras asistencias:<br>
                1. ¿Tiene o va a solicitar asistencia en otra Unidad Académica u oficina de la universidad?<br>");
            //NO FUNCIONA EL RADIO BUTTON?!
            echo $this->Form->control('asistencia_externa', ['label' =>['text'=> 'Sí'], 'type' => 'radio']);
            echo $this->Form->control('asistencia_externa', ['label' =>['text'=>'No'], 'type' => 'radio']);

            
            echo $this->Form->control('cantidad_horas_externa', ['label' =>['text'=> 'Cantidad'], 'type'=> 'number', 'min'=>"0", 'step'=>"1"]);
            echo $this->Form->control('tipo_horas_externa');
            //echo $this->Form->control('fecha');
            //echo $this->Form->control('cantidad_horas', ['label' =>['text'=> 'Cantidad', 'type'=> 'number', 'min'=>"0"]]);
            //echo $this->Form->control('estado');
            //echo $this->Form->control('ronda');
        ?>
        <h5> Curso solicitado </h5>
        <?php

            echo $this->Form->control('usuarios_id', ['readonly', 'value'=>$idEstudiante]); //Usuario id del estudiante, no debería verse
            echo $this->Form->control('grupos_id', ['options' => $grupos]);

        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Generar Solicitud'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>
