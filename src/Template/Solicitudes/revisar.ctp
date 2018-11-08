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
                foreach ($datosRequisitosSolicitud as $asistente): ?>
                <tr>
                <?php if($asistente['requisito_categoria'] == 'Horas Asistente'):?>
                    <td><?= h($asistente['requisito_nombre']) ?></td>
                    <td><?= h($asistente['requisito_tipo']) ?></td>
                    <td class="actions">
                    <?php
                    
                        if ($asistente['requisito_tipo'] == 'Obligatorio') {
                            $options= array('Sí' => 'Sí', 'No' => 'No',);
                            $attributes = array('legend' => false, 'value' => $asistente['tiene_condicion'],);
                            echo $this->Form->radio($asistente['requisito_id'], $options, $attributes);
                        } else {
                            $options= array('Sí' => 'Sí', 'No' => 'No', 'Inopia' => 'Inopia',);
                            $attributes = array('legend' => false, 'value' => $asistente['tiene_condicion'],);
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
                <?php foreach ($datosRequisitosSolicitud as $estudiante): ?>
                <tr>
                <?php if($estudiante['requisito_categoria'] == 'Horas Estudiante'):?>
                    <td><?= h($estudiante['requisito_nombre']) ?></td>
                    <td><?= h($estudiante['requisito_tipo']) ?></td>
                    <td class="actions">
                    <?php
                        if ($estudiante['requisito_tipo'] == 'Obligatorio') {
                            $options= array('Sí' => 'Sí', 'No' => 'No',);
                            $attributes = array('legend' => false, 'value' => $estudiante['tiene_condicion'],);
                            echo $this->Form->radio($estudiante['requisito_id'], $options, $attributes);
                        } else {
                            $options= array('Sí' => 'Sí', 'No' => 'No', 'Inopia' => 'Inopia',);
                            $attributes = array('legend' => false, 'value' => $estudiante['tiene_condicion'],);
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
                foreach ($datosRequisitosSolicitud as $general): ?>
                <tr>
                <?php if($general['requisito_categoria'] == 'General'):?>
                    <td><?= h($general['requisito_nombre']) ?></td>
                    <td><?= h($general['requisito_tipo']) ?></td>
                    <td class="actions">
                    <?php
                        if ($general['requisito_tipo'] == 'Obligatorio') {
                            $auto[$i] = $general['requisito_id'];
                            $i = $i+1;
                            $options= array('Sí' => 'Sí', 'No' => 'No',);
                            $attributes = array('legend' => false, 'value' => $general['tiene_condicion'], 'onclick'=> 'updateGenerales()',);
                            echo $this->Form->radio($general['requisito_id'], $options, $attributes);


                            /*echo $this->Form->radio($general['requisito_id'], [
                                                    ['value'=>'1', 'text'=>'Sí ', 'onclick' => 'prueba()'],
                                                    ['value'=>'0', 'text'=> 'No', 'onclick' => 'prueba()']]);*/
                            

                        } else {
                            $auto2[$j] = $general['requisito_id'];
                            $j = $j+1;
                            $options= array('Sí' => 'Sí', 'No' => 'No', 'Inopia' => 'Inopia',);
                            $attributes = array('legend' => false, 'value' => $general['tiene_condicion'],);
                            echo $this->Form->radio($general['requisito_id'], $options, $attributes);
                        }
                    ?>
                </tr>
                <?php endif; ?>
                <?php endforeach; 
                //debug($datosRequisitosSolicitud);
                //die();?>
            </tbody>
        </table>
        </div>

        <br>
        <h5> Estado </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php

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

            echo $this->Form->control('estado', ['options' => ['Elegible', 'Rechazada - Profesor', 'Aceptada - Profesor', 'Aceptada - Profesor (Inopia)', 'Anulada'], 'value'=>$estadoActual]);
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

        echo $this->Form->input('a2', ['label' => '', 'id' => 'a2', 'type' => 'select' , 'options' => $auto2, 'style' => 'visibility:hidden']); //lista de id de los requisitos obligatorios generales
        //debug($auto2);
        //die();
    ?>

    <?= $this->Form->end() ?>
</div>

<script>

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

                c = r; //termino el for de una vez, no necesito ver los demás requisitos ya que encontré uno obligatorio que está marcado no
                var encontrado = true;

            }
            
        }
        if(encontrado == false){ //Ninguno está marcada no por lo que hay que desbloquear todas las opciones
            unblockGenerales();
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
</script>

