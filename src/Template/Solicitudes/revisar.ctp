<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
 */
?>

<div class="solicitudes form large-9 medium-8 columns content">
    <?= $this->Form->create($solicitude) ?>
    <fieldset>
        <legend><?= __('Revisar Solicitud') ?></legend>

        <!-- Aqui carga los datos del estudiante para que solamente se puedan ver -->

        <br>
        <h5> Datos del estudiante </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php

            echo $this->Form->control('estudiante_primer_apellido', ['label'=>['text'=>'Primer Apellido'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_primer_apellido'] ]);
            echo $this->Form->control('estudiante_segundo_apellido', ['label'=>['text'=>'Segundo Apellido'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_segundo_apellido'] ]);
            echo $this->Form->control('estudiante_nombre', ['label'=>['text'=>'Nombre'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_nombre'] ]);
            echo $this->Form->control('estudiante_identificacion', ['label'=>['text'=>'Identificación'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_identificacion'] ]);
            echo $this->Form->control('estudiante_tipo_identificacion', ['label'=>['text'=>'Tipo de identificación'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_tipo_identificacion'] ]);
            echo $this->Form->control('estudiante_carne', ['label'=>['text'=>'Carné'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_carne'] ]);
            echo $this->Form->control('estudiante_telefono', ['label'=>['text'=>'Teléfono'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_telefono'] ]);
            echo $this->Form->control('estudiante_correo', ['label'=>['text'=>'Correo'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_correo'] ]);
            echo $this->Form->control('solicitud_carrera', ['label'=>['text'=>'Carrera'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_carrera'] ]);
            echo $this->Form->control('solicitud_horas_estudiante', ['label'=>['text'=>'Solicita horas estudiante'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_horas_estudiante'] ]);
            echo $this->Form->control('solicitud_horas_asistente', ['label'=>['text'=>'Solicita horas asistente'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_horas_asistente'] ]);
        ?>
        </div>

        <!-- Aqui carga los datos de asistencia externa para que solamente se puedan ver -->

        <br>
        <h5> ¿Tiene o va a solicitar asistencia en otra Unidad Académica u oficina de la Universidad? </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            echo $this->Form->control('solicitud_horas_estudiante_externas', ['label'=>['text'=>'Horas estudiante'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_horas_estudiante_externas'] ]);
            echo $this->Form->control('solicitud_horas_asistente_externas', ['label'=>['text'=>'Horas asistente'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_horas_asistente_externas'] ]); 
            if ($datosSolicitud[0]['solicitud_cantidad_horas_externa'] != 0) {
                echo $this->Form->control('solicitud_cantidad_horas_externa', ['label'=>['text'=>'Cantidad de horas'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_cantidad_horas_externa'] ]);
            }
        ?>
        </div>
    
        <!-- Aqui carga los datos del curso para que solamente se puedan ver -->

        <br>
        <h5> Curso solicitado </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            echo $this->Form->control('curso_sigla', ['label'=>['text'=>'Sigla'], 'readonly', 'value'=> $datosSolicitud[0]['curso_sigla'] ]);
            echo $this->Form->control('grupo_numero', ['label'=>['text'=>'Grupo'], 'readonly', 'value'=> $datosSolicitud[0]['grupo_numero'] ]);
            echo $this->Form->control('curso_nombre', ['label'=>['text'=>'Curso'], 'readonly', 'value'=> $datosSolicitud[0]['curso_nombre'] ]);
            echo $this->Form->control('profesor_nombre', ['label'=>['text'=>'Docente'], 'readonly', 'value'=> $datosSolicitud[0]['profesor_nombre'] ]);
        ?>
        </div>

        <!-- Variables para cargar radios bloqueados si no se cumple una obligatoria -->

        <?php
        $bloqueoAsistente = false;
        $opcionLibreAsistente = '';
        $bloqueoEstudiante = false;
        $opcionLibreEstudiante = '';
        $bloqueoGeneral = false;
        $opcionLibreGeneral = '';
        ?>
            
        <!-- Se almancena en las variables donde esta el requisito obligatorio que no cumplio -->

        <?php foreach ($datosRequisitosSolicitud as $bloqueo): ?>
        <?php 
        if($bloqueo['requisito_categoria'] == 'Horas Asistente' and $bloqueo['tiene_condicion'] == 'No'){
            $bloqueoAsistente = true;
            $opcionLibreAsistente = $bloqueo['requisito_id'];
        };
        if($bloqueo['requisito_categoria'] == 'Horas Estudiante' and $bloqueo['tiene_condicion'] == 'No'){
            $bloqueoEstudiante = true;
            $opcionLibreEstudiante = $bloqueo['requisito_id'];
        };
        if($bloqueo['requisito_categoria'] == 'General' and $bloqueo['tiene_condicion'] == 'No'){
            $bloqueoGeneral = true;
            $opcionLibreGeneral = $bloqueo['requisito_id'];
        };
        ?>
        <?php endforeach; ?>

        <!-- Logica basica del bloqueo, si asistente y estudiante no se cumplen, se bloquea todo menos
        las opciones de asistente y estudiante que no cumplio para poderlas cambiar, si eso no pasa pero 
        no cumplio una general, se bloquea todo menos la opcion general que no cumplio para poderla cambiar -->

        <?php
        if($bloqueoAsistente == true and $bloqueoEstudiante == true){
            $bloqueoGeneral = true;
            $opcionLibreGeneral = '';
        } else if($bloqueoGeneral == true){
            $bloqueoAsistente = true;
            $bloqueoEstudiante = true;
            $opcionLibreAsistente = '';
            $opcionLibreEstudiante = '';
        }
        ?>

        <!-- Aqui carga los requisitos para ver si se cumplen o no -->

        <br>
        <h5> Requisitos </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">

        <style> 
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            text-align: left;
            padding: 8px;
        }
        </style>

        <table id="requisitos" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= 'Horas Asistente' ?></th>
                    <th scope="col"><?= 'Tipo' ?></th>
                    <th scope="col" class="actions"><?= __('Cumple el requisito?') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $j = 0; 
                //Carga los requisitos para horas asistente
                foreach ($datosRequisitosSolicitud as $asistente): ?>
                <tr>
                <?php if($asistente['requisito_categoria'] == 'Horas Asistente'):?>
                    <td><?= h($asistente['requisito_nombre']) ?></td>
                    <td><?= h($asistente['requisito_tipo']) ?></td>
                    <td class="actions">
                    <?php
                        //Si el requisito es obligatirio entra aquí
                        if ($asistente['requisito_tipo'] == 'Obligatorio') {
                            $auto5[$i] = $asistente['requisito_id'];
                            $i = $i+1;
                            $options= array('Sí' => 'Sí', 'No' => 'No',);
                            if($asistente['requisito_id'] == $opcionLibreAsistente){
                                $attributes = array('legend' => false, 'value' => $asistente['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateAsistentes()');
                            } else {
                                $attributes = array('legend' => false, 'value' => $asistente['tiene_condicion'], 'disabled' => $bloqueoAsistente, 'onclick'=> 'updateAsistentes()');
                            }
                            echo $this->Form->radio($asistente['requisito_id'], $options, $attributes);
                        //Si el requisito no es obligatorio entra aqui, $bloqueoAsistente define si el radio debe ser bloqueado o no
                        } else {
                            $auto5[$i] = $asistente['requisito_id'];
                            $i = $i+1;
                            $auto6[$j] = $asistente['requisito_id'];
                            $j = $j+1;
                            $options= array('Sí' => 'Sí', 'No' => 'No', 'Inopia' => 'Inopia',);
                            if($asistente['requisito_id'] == $opcionLibreAsistente){
                                $attributes = array('legend' => false, 'value' => $asistente['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateAsistentes()');
                            } else {
                                $attributes = array('legend' => false, 'value' => $asistente['tiene_condicion'], 'disabled' => $bloqueoAsistente, 'onclick'=> 'updateAsistentes()');
                            }
                            echo $this->Form->radio($asistente['requisito_id'], $options, $attributes);
                        }
                    ?>    
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>

            <thead>
                <tr>
                    <th scope="col"><?= 'Horas Estudiante' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                $j = 0;
                //Carga los requisitos para horas estudiante
                foreach ($datosRequisitosSolicitud as $estudiante): ?>
                <tr>
                <?php if($estudiante['requisito_categoria'] == 'Horas Estudiante'):?>
                    <td><?= h($estudiante['requisito_nombre']) ?></td>
                    <td><?= h($estudiante['requisito_tipo']) ?></td>
                    <td class="actions">
                    <?php
                        //Si el requisito es obligatirio entra aquí
                        if ($estudiante['requisito_tipo'] == 'Obligatorio') {
                            $auto3[$i] = $estudiante['requisito_id'];
                            $i = $i+1;
                            $options= array('Sí' => 'Sí', 'No' => 'No',);
                            if($estudiante['requisito_id'] == $opcionLibreEstudiante){
                                $attributes = array('legend' => false, 'value' => $estudiante['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateEstudiantes()');
                            } else {
                                $attributes = array('legend' => false, 'value' => $estudiante['tiene_condicion'], 'disabled' => $bloqueoEstudiante, 'onclick'=> 'updateEstudiantes()');
                            }
                            echo $this->Form->radio($estudiante['requisito_id'], $options, $attributes);
                        //Si el requisito no es obligatorio entra aqui, $bloqueoEstudiante define si el radio debe ser bloqueado o no
                        } else {
                            $auto3[$i] = $estudiante['requisito_id'];
                            $i = $i+1;
                            $auto4[$j] = $estudiante['requisito_id'];
                            $j = $j+1;
                            $options= array('Sí' => 'Sí', 'No' => 'No', 'Inopia' => 'Inopia',);
                            if($estudiante['requisito_id'] == $opcionLibreEstudiante){
                                $attributes = array('legend' => false, 'value' => $estudiante['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateEstudiantes()');
                            } else {
                                $attributes = array('legend' => false, 'value' => $estudiante['tiene_condicion'], 'disabled' => $bloqueoEstudiante, 'onclick'=> 'updateEstudiantes()');
                            }
                            echo $this->Form->radio($estudiante['requisito_id'], $options, $attributes);
                        }
                    ?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; ?>
            </tbody>

            <thead>
                <tr>
                    <th scope="col"><?= 'General' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                $j = 0;
                //Carga los requisitos para horas asistente
                foreach ($datosRequisitosSolicitud as $general): ?>
                <tr>
                <?php if($general['requisito_categoria'] == 'General'):?>
                    <td><?= h($general['requisito_nombre']) ?></td>
                    <td><?= h($general['requisito_tipo']) ?></td>
                    <td class="actions">
                    <?php
                        //Si el requisito es obligatirio entra aquí
                        if ($general['requisito_tipo'] == 'Obligatorio') {
                            $auto[$i] = $general['requisito_id'];
                            $i = $i+1;
                            $options= array('Sí' => 'Sí', 'No' => 'No',);
                            if($general['requisito_id'] == $opcionLibreGeneral){  
                                $attributes = array('legend' => false, 'value' => $general['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateGenerales()');
                            } else {
                                $attributes = array('legend' => false, 'value' => $general['tiene_condicion'], 'disabled' => $bloqueoGeneral, 'onclick'=> 'updateGenerales()');
                            }
                            echo $this->Form->radio($general['requisito_id'], $options, $attributes);
                        //Si el requisito no es obligatorio entra aqui, $bloqueoAsistente define si el radio debe ser bloqueado o no
                        } else {
                            $auto[$i] = $general['requisito_id'];
                            $i = $i+1;
                            $auto2[$j] = $general['requisito_id'];
                            $j = $j+1;
                            $options= array('Sí' => 'Sí', 'No' => 'No', 'Inopia' => 'Inopia',);
                            if($general['requisito_id'] == $opcionLibreGeneral){  
                                $attributes = array('legend' => false, 'value' => $general['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateGenerales()');
                            } else {
                                $attributes = array('legend' => false, 'value' => $general['tiene_condicion'], 'disabled' => $bloqueoGeneral, 'onclick'=> 'updateGenerales()');
                            }
                            echo $this->Form->radio($general['requisito_id'], $options, $attributes);
                        }
                    ?>
                </tr>
                <?php endif; ?>
                <?php endforeach;
                ?>
            </tbody>
        </table>
        </div>

        <br>
        <h5> Estado </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php

        /*
        $estadoActual;
        if ($solicitude['estado'] == 'Rechazada - Profesor') {
            $estadoActual = '1';
        } else if ($solicitude['estado'] == 'Aceptada - Profesor') {
            $estadoActual = '2';
        } else if ($solicitude['estado'] == 'Aceptada - Profesor (Inopia)'){
            $estadoActual = '3';
        } else if ($solicitude['estado'] == 'Anulada'){
            $estadoActual = '4';
        } else {
            $estadoActual = '0';
        }
        */

            $estadoActual = $solicitude['estado'];
            echo $this->Form->input('estado', ['options' => [$estadoActual], 'type' => 'select', 'label' =>['text'=> 'Estado'], 'value'=> $estadoActual]);
            echo $this->Form->control('promedio', ['label' => 'Promedio', 'pattern'=>"[0-9]{0,2}"]);
            echo $this->Form->control('justificacion', ['label' => 'Justificación', 'type'=> 'textarea']);
        ?>

    </fieldset>
    <br>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>

    <?php
        //debug($auto);
        //die();

        /*Estos campos solamente sirven para almacenar vectores, dado que esta es la única forma eficiente que conozco de compartir variables entre php y javascript.*/
        echo $this->Form->input('a1', ['label' => '', 'id' => 'a1', 'type' => 'select' , 'options' => $auto, 'style' => 'visibility:hidden']); //lista de id de los requisitos obligatorios generales

        echo $this->Form->input('a2', ['label' => '', 'id' => 'a2', 'type' => 'select' , 'options' => $auto2, 'style' => 'visibility:hidden']); //lista de id de los requisitos no obligatorios generales

        echo $this->Form->input('a3', ['label' => '', 'id' => 'a3', 'type' => 'select' , 'options' => $auto3, 'style' => 'visibility:hidden']); //lista de id de los requisitos obligatorios de horas estudiante

        echo $this->Form->input('a4', ['label' => '', 'id' => 'a4', 'type' => 'select' , 'options' => $auto4, 'style' => 'visibility:hidden']); //lista de id de los requisitos no obligatorios de horas estudiante

        echo $this->Form->input('a5', ['label' => '', 'id' => 'a5', 'type' => 'select' , 'options' => $auto5, 'style' => 'visibility:hidden']); //lista de id de los requisitos obligatorios de horas asistente

        echo $this->Form->input('a6', ['label' => '', 'id' => 'a6', 'type' => 'select' , 'options' => $auto6, 'style' => 'visibility:hidden']); //lista de id de los requisitos no obligatorios de horas asistente
        //debug($auto6);
        //die();
    ?>

    <?= $this->Form->end() ?>
</div>

<script>

    function updateEstado(){
        opcionesEstado = document.getElementById("estado");
        while (opcionesEstado.options.length) {
            opcionesEstado.remove(0);
        }
        //opcionesEstado.options.remove();
        var tmp = document.createElement("option");               
        tmp.text = 'Rechazado';
        
        opcionesEstado.options.add(tmp,1);
    }

    function updateAsistentes(){
        //selReq = document.getElementById("5-no");
        //alert(selReq.value);

        a5 = document.getElementById("a5"); //Lista de id de requisitos obligatorios de horas asistente
        var r = a5.options.length;
        //alert(r);
        //alert(a5.options[0].text); options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        var encontrado = false;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            
            var x = a5.options[c].text
            //alert(x);
            var y = x + "-no";
            //alert(y);
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            //alert(x + selReq);
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos de horas asistente
                //alert(x);
                //alert(x + selReq);
                //Sería mejor llamar otra función que se encargue de recorrer los requisitos no obligatorios para deshabilitarlos.
                blockAsistentes(x);

                c = r; //termino el for de una vez, no necesito ver los demás requisitos ya que encontré uno obligatorio que está marcado no
                var encontrado = true;
            }
            
        }
        if(encontrado == false){ //Ninguno está marcada no por lo que hay que desbloquear todas las opciones
            unblockAsistentes();
            unblockGenerales();
        } else {
            var chkEstado = checkEstudiante();
            if (chkEstado == true){
                blockGenerales();
            }
        }
    }

    function blockAsistentes(selected){
        //alert(selected);
        a6 = document.getElementById("a6"); //Lista de id de requisitos no obligatorios horas asistente
        var r = a6.options.length;
        //alert(r);
        //alert(a6.options[0].text); //options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a6.options[c].text;
            //alert(x);
            if(x != selected){
                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
                //selReq = document.getElementById(x);
                //alert(selReq);
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
                document.getElementById(w).disabled = true;
            }
        }

        a5 = document.getElementById("a5"); //Lista de id de requisitos obligatorios horas asistente
        var s = a5.options.length;

        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los bloquea menos el seleccionado
        {
            
            var x = a5.options[c].text;
            if(x != selected){ //No bloquear el seleccionado
                //alert(x);
                var y = x + "-no";
                var z = x + "-sí";
                //selReq = document.getElementById(x);
                //alert(selReq);
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
            }

        }
    }

    function unblockAsistentes(){
        //alert(selected);
        a6 = document.getElementById("a6"); //Lista de id de requisitos no obligatorios horas asistentes
        var r = a6.options.length;
        //alert(r);
        //alert(a6.options[0].text); //options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los desbloquea
        {
            var x = a6.options[c].text;
            //alert(x);
            var y = x + "-no";
            var z = x + "-sí";
            var w = x + "-inopia";
            //selReq = document.getElementById(x);
            //alert(selReq);
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
            document.getElementById(w).disabled = false;

        }

        a5 = document.getElementById("a5"); //Lista de id de requisitos obligatorios generales
        var s = a5.options.length;
        //alert(a5.options[0].text);
        //alert(a5.options[1].text);

        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los desbloquea menos el seleccionado
        {      
            var x = a5.options[c].text;     
            //alert(x);
            var y = x + "-no";
            var z = x + "-sí";
            //selReq = document.getElementById(x);
            //alert(selReq);
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
        }        
    }

    function checkAsistente(){
        //selReq = document.getElementById("5-no");
        //alert(selReq.value);

        a5 = document.getElementById("a5"); //Lista de id de requisitos obligatorios de horas asistente
        var r = a5.options.length;
        //alert(r);
        //alert(a5.options[0].text); options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            
            var x = a5.options[c].text
            //alert(x);
            var y = x + "-no";
            //alert(y);
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            //alert(x + selReq);
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }
            
        }
        return false;
    }

    function updateEstudiantes(){
        //selReq = document.getElementById("5-no");
        //alert(selReq.value);

        a3 = document.getElementById("a3"); //Lista de id de requisitos obligatorios de horas estudiante
        var r = a3.options.length;
        //alert(r);
        //alert(a3.options[0].text); options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        var encontrado = false;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            
            var x = a3.options[c].text
            //alert(x);
            var y = x + "-no";
            //alert(y);
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            //alert(x + selReq);
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                //alert(x);
                //alert(x + selReq);
                //Sería mejor llamar otra función que se encargue de recorrer los requisitos no obligatorios para deshabilitarlos.
                blockEstudiantes(x);

                c = r; //termino el for de una vez, no necesito ver los demás requisitos ya que encontré uno obligatorio que está marcado no
                var encontrado = true;

            }
            
        }
        if(encontrado == false){ //Ninguno está marcada no por lo que hay que desbloquear todas las opciones
            unblockEstudiantes();
            unblockGenerales();
        } else {
            var chkEstado = checkAsistente();
            if (chkEstado == true){
                blockGenerales();
            }
        }
    }

    function blockEstudiantes(selected){
        //alert(selected);
        a4 = document.getElementById("a4"); //Lista de id de requisitos no obligatorios horas estudiante
        var r = a4.options.length;
        //alert(r);
        //alert(a4.options[0].text); //options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a4.options[c].text;
            if(x != selected){
                //alert(x);
                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
                //selReq = document.getElementById(x);
                //alert(selReq);
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
                document.getElementById(w).disabled = true;
            }
        }

        a3 = document.getElementById("a3"); //Lista de id de requisitos obligatorios horas estudiante
        var s = a3.options.length;

        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los bloquea menos el seleccionado
        {
            
            var x = a3.options[c].text;
            if(x != selected){ //No bloquear el seleccionado
                //alert(x);
                var y = x + "-no";
                var z = x + "-sí";
                //selReq = document.getElementById(x);
                //alert(selReq);
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
            }

        }
    }

    function unblockEstudiantes(){
        //alert(selected);
        a4 = document.getElementById("a4"); //Lista de id de requisitos no obligatorios horas estudiantes
        var r = a4.options.length;
        //alert(r);
        //alert(a4.options[0].text); //options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los desbloquea
        {
            var x = a4.options[c].text;
            //alert(x);
            var y = x + "-no";
            var z = x + "-sí";
            var w = x + "-inopia";
            //selReq = document.getElementById(x);
            //alert(selReq);
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
            document.getElementById(w).disabled = false;

        }

        a3 = document.getElementById("a3"); //Lista de id de requisitos obligatorios generales
        var s = a3.options.length;
        //alert(a3.options[0].text);
        //alert(a3.options[1].text);

        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los desbloquea menos el seleccionado
        {      
            var x = a3.options[c].text;     
            //alert(x);
            var y = x + "-no";
            var z = x + "-sí";
            //selReq = document.getElementById(x);
            //alert(selReq);
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
        }        
    }
    
    function checkEstudiante(){
        a3 = document.getElementById("a3"); //Lista de id de requisitos obligatorios de horas estudiante
        var r = a3.options.length;
        //alert(r);
        //alert(a3.options[0].text); options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            
            var x = a3.options[c].text
            //alert(x);
            var y = x + "-no";
            //alert(y);
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            //alert(x + selReq);
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }
            
        }
        return false;
    }

    function updateGenerales(){
        //selReq = document.getElementById("7-no");
        //alert(selReq.value);

        a1 = document.getElementById("a1"); //Lista de id de requisitos obligatorios generales
        var r = a1.options.length;
        //alert(r);
        //alert(a1.options[0].text); options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        var encontrado = false;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            
            var x = a1.options[c].text
            //alert(x);
            var y = x + "-no";
            //alert(y);
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            //alert(x + selReq);
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                //alert(x);
                //alert(x + selReq);
                //Sería mejor llamar otra función que se encargue de recorrer los requisitos no obligatorios para deshabilitarlos.
                blockGenerales(x);
                blockAsistentes(x);
                blockEstudiantes(x);

                c = r; //termino el for de una vez, no necesito ver los demás requisitos ya que encontré uno obligatorio que está marcado no
                var encontrado = true;

            }
            
        }
        if(encontrado == false){ //Ninguno está marcada no por lo que hay que desbloquear todas las opciones
            unblockGenerales();
            unblockAsistentes();
            unblockEstudiantes();
            updateAsistentes();
            updateEstudiantes();
        }
    }

    function blockGenerales(selected){
        //alert(selected);
        a2 = document.getElementById("a2"); //Lista de id de requisitos no obligatorios generales
        var r = a2.options.length;
        //alert(r);
        //alert(a2.options[0].text); //options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a2.options[c].text;
            if(x != selected){
                //alert(x);
                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
                //selReq = document.getElementById(x);
                //alert(selReq);
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
                document.getElementById(w).disabled = true;
            }
        }

        a1 = document.getElementById("a1"); //Lista de id de requisitos obligatorios generales
        var s = a1.options.length;

        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los bloquea menos el seleccionado
        {
            
            var x = a1.options[c].text;
            if(x != selected){ //No bloquear el seleccionado
                //alert(x);
                var y = x + "-no";
                var z = x + "-sí";
                //selReq = document.getElementById(x);
                //alert(selReq);
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
            }

        }
    }

    function unblockGenerales(){
        //alert(selected);
        a2 = document.getElementById("a2"); //Lista de id de requisitos no obligatorios generales
        var r = a2.options.length;
        //alert(r);
        //alert(a2.options[0].text); //options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los desbloquea
        {
            var x = a2.options[c].text;
            //alert(x);
            var y = x + "-no";
            var z = x + "-sí";
            var w = x + "-inopia";
            //selReq = document.getElementById(x);
            //alert(selReq);
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
            document.getElementById(w).disabled = false;

        }

        a1 = document.getElementById("a1"); //Lista de id de requisitos obligatorios generales
        var s = a1.options.length;
        //alert(a1.options[0].text);
        //alert(a1.options[1].text);

        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los desbloquea menos el seleccionado
        {      
            var x = a1.options[c].text;     
            //alert(x);
            var y = x + "-no";
            var z = x + "-sí";
            //selReq = document.getElementById(x);
            //alert(selReq);
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
        
        }        
    }

    function checkGenerales(){
        //selReq = document.getElementById("5-no");
        //alert(selReq.value);

        a1 = document.getElementById("a1"); //Lista de id de requisitos obligatorios de horas asistente
        var r = a1.options.length;
        //alert(r);
        //alert(a1.options[0].text); options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            
            var x = a1.options[c].text
            //alert(x);
            var y = x + "-no";
            //alert(y);
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            //alert(x + selReq);
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }
            
        }
        return false;
    }

    function checkInopia(){
        //selReq = document.getElementById("5-no");
        //alert(selReq.value);

        a2 = document.getElementById("a2"); //Lista de id de requisitos obligatorios de horas asistente
        a4 = document.getElementById("a4");
        a6 = document.getElementById("a6");
        var r = a2.options.length;
        //alert(r);
        //alert(a1.options[0].text); options[0].text devuelve el id de requisito en posicion 0, si fuera value devuelve literalmente el primer índice = 0.
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            
            var x = a2.options[c].text
            //alert(x);
            var y = x + "-inopia";
            //alert(y);
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            //alert(x + selReq);
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }
            
        }
        var r = a4.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            
            var x = a4.options[c].text
            //alert(x);
            var y = x + "-inopia";
            //alert(y);
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            //alert(x + selReq);
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }
            
        }
        var r = a6.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            
            var x = a6.options[c].text
            //alert(x);
            var y = x + "-inopia";
            //alert(y);
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            //alert(x + selReq);
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }
            
        }
        return false;
    }
    
</script>
