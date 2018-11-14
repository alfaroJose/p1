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
        <!-- Se almancena en las variables de en donde esta el requisito obligatorio que no cumplio -->
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
        <!-- Logica para cargar los bloqueos desde la base -->
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
                        //Si el requisito no es obligatorio entra aqui
                        } else {
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
                        //Si el requisito no es obligatorio entra aqui
                        } else {
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
                //Carga los requisitos para horas asistente y estudiante
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
                        //Si el requisito no es obligatorio entra aqui
                        } else {
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
        <div onload="updateEstado()">
        <div onload="setEstadoInicial()">
        <div onload="updateHoras()">
        <div onload="setHorasTipoInicial()">
        <!-- Aqui carga el estado de la solicitud con sus datos -->
        <br>
        <h5> Datos administrativos </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            echo $this->Form->input('estado', ['type' => 'select', 'label' =>['text'=> 'Estado'], 'value'=> $solicitude['estado'], 'onChange' => 'updateHoras()', 'required'=> true]);
            echo $this->Form->control('promedio', ['label' => 'Promedio', 'pattern'=>"[0-9]{0,2}"]);
            echo $this->Form->control('justificacion', ['label' => 'Justificación', 'type'=> 'textarea']);
            echo $this->Form->input('aceptados_tipo_horas',['type' => 'select', 'label' =>['text'=> 'Tipo de Horas Asignadas'],'id' => 'aceptados_tipo_horas', 'options'=> ['Horas Estudiante', 'Horas Asistente'], 'required'=> true]);
            echo $this->Form->input('aceptados_cantidad_horas', ['label' => 'Cantidad de Horas Asignadas', 'pattern'=>"[0-9]{0,2}", 'id' => 'aceptados_cantidad_horas', 'required'=> true]);
            
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>

    <?php
        /*Estos campos solamente sirven para almacenar vectores, dado que esta es la única forma eficiente que conozco de compartir variables entre php y javascript.*/
        echo $this->Form->input('a1', ['label' => '', 'id' => 'a1', 'type' => 'select' , 'options' => $auto, 'style' => 'visibility:hidden']); //lista de id de los requisitos obligatorios generales

        echo $this->Form->input('a2', ['label' => '', 'id' => 'a2', 'type' => 'select' , 'options' => $auto2, 'style' => 'visibility:hidden']); //lista de id de los requisitos no obligatorios generales

        echo $this->Form->input('a3', ['label' => '', 'id' => 'a3', 'type' => 'select' , 'options' => $auto3, 'style' => 'visibility:hidden']); //lista de id de los requisitos obligatorios de horas estudiante

        echo $this->Form->input('a4', ['label' => '', 'id' => 'a4', 'type' => 'select' , 'options' => $auto4, 'style' => 'visibility:hidden']); //lista de id de los requisitos no obligatorios de horas estudiante

        echo $this->Form->input('a5', ['label' => '', 'id' => 'a5', 'type' => 'select' , 'options' => $auto5, 'style' => 'visibility:hidden']); //lista de id de los requisitos obligatorios de horas asistente

        echo $this->Form->input('a6', ['label' => '', 'id' => 'a6', 'type' => 'select' , 'options' => $auto6, 'style' => 'visibility:hidden']); //lista de id de los requisitos no obligatorios de horas asistente
    ?>

    <?= $this->Form->end() ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>

    $(function(){
    $('div[onload]').trigger('onload');
    });

    function updateHoras(){
        var i = 1;
        var x = document.getElementById("estado");
        var y = document.getElementById("aceptados_tipo_horas");
        if (x.value == 'Aceptada - Profesor (Inopia)' || x.value == 'Aceptada - Profesor'){

            var chkEstudiante = checkEstudiante(); //verdadero -> algun no esta precionado
            var chkAsistente = checkAsistente();  //falso -> ningun no sin precionar

            var chkInopiaEstudiante = checkInopiaEstudiante(); // verdadero -> algun inopia esta precionado
            var chkInopiaAsistente = checkInopiaAsistente();    // falsto -> ningun inopia
            var chkInopiaGeneral = checkInopiaGeneral();

            var chkMarcadasEstudiante = checkMarcadasEstudiante(); //verdadero -> alguna casilla esta sin precionar
            var chkMarcadasAsistente = checkMarcadasAsistente();  // falso -> todo precionado

            while (y.options.length) {
                y.remove(0);
            }
            var tmp1 = document.createElement("option");               
            tmp1.text = ' - Seleccione un tipo de horas -';
            tmp1.value = '';
            y.options.add(tmp1,0);

            if (chkEstudiante == false && chkAsistente == false && chkMarcadasEstudiante == false && chkMarcadasAsistente == false && (chkInopiaGeneral == true || (chkInopiaAsistente == false && chkInopiaEstudiante == false) || (chkInopiaAsistente == true && chkInopiaEstudiante == true))){
                tmp = document.createElement("option");               
                tmp.text = 'Horas Estudiante';
                y.options.add(tmp,i);
                i = i + 1;
                tmp = document.createElement("option");
                tmp.text = 'Horas Asistente';
                y.options.add(tmp,i);
                i = i + 1;
            } else if ((chkEstudiante == false && chkMarcadasEstudiante == false && (chkMarcadasAsistente == true || chkAsistente == true)) || (x.value == 'Aceptada - Profesor (Inopia)' && chkInopiaEstudiante == true) || (x.value == 'Aceptada - Profesor' && chkInopiaEstudiante == false)){
                tmp = document.createElement("option");               
                tmp.text = 'Horas Estudiante';
                y.options.add(tmp,i);
                i = i + 1;
            } else if ((chkAsistente == false && chkMarcadasAsistente == false && (chkMarcadasEstudiante == true || chkEstudiante == true)) || (x.value == 'Aceptada - Profesor (Inopia)' && chkInopiaAsistente == true) || (x.value == 'Aceptada - Profesor' && chkInopiaAsistente == false)){
                tmp = document.createElement("option");
                tmp.text = 'Horas Asistente';
                y.options.add(tmp,i);
                i = i + 1;
            }
            document.getElementById("aceptados_tipo_horas").disabled = false;
            document.getElementById("aceptados_cantidad_horas").disabled = false;
        } else {
            while (y.options.length) {
                y.remove(0);
            }
            document.getElementById("aceptados_tipo_horas").disabled = true;
            document.getElementById("aceptados_cantidad_horas").value = '';
            document.getElementById("aceptados_cantidad_horas").disabled = true;
        }
    }

    function setEstadoInicial(){
        var actualizarEstado = "<?php echo $solicitude['estado']; ?>";
        if (actualizarEstado == 'Pendiente'){
            actualizarEstado = 'Pendiente - Administrador'
        }
        document.getElementById("estado").value = actualizarEstado;
    }

    function setHorasTipoInicial(){
        var actializarHoras = "<?php echo $datosSolicitud[0]['aceptados_cantidad_horas']; ?>";
        var actualizarTipoHoras = "<?php echo $datosSolicitud[0]['aceptados_tipo_horas']; ?>";
        if (actializarHoras != ''){
            document.getElementById("aceptados_cantidad_horas").value = actializarHoras;
        }
        if (actualizarTipoHoras != ''){
            document.getElementById("aceptados_tipo_horas").value = actualizarTipoHoras;
        }
    }

    function updateEstado(){
        var chkEstudiante = checkEstudiante(); //verdadero -> algun NO esta precionado
        var chkAsistente = checkAsistente();   // falso -> ningun NO esta precionado
        var chkGenerales = checkGenerales();

        var chkInopiaGeneral = checkInopiaGeneral(); // verdadero -> algun inopia esta precionado
        var chkInopiaEstudiante = checkInopiaEstudiante(); // falso -> ningun inopia esta precionado
        var chkInopiaAsistente = checkInopiaAsistente();

        var chkMarcadasGeneral = checkMarcadasGeneral(); //verdadero -> alguna casilla esta sin precionar
        var chkMarcadasEstudiante = checkMarcadasEstudiante(); // falso -> todas las casillas estan precionadas
        var chkMarcadasAsistente = checkMarcadasAsistente();
        
        opcionesEstado = document.getElementById("estado");
        if (chkGenerales == true || (chkEstudiante == true && chkAsistente == true) || (chkMarcadasGeneral == false && chkEstudiante == true && chkMarcadasAsistente == true) || (chkMarcadasGeneral == false && chkAsistente == true && chkMarcadasEstudiante == true)){
            while (opcionesEstado.options.length) {
                opcionesEstado.remove(0);
            }
            var tmp = document.createElement("option");               
            tmp.text = 'No Elegible';
            opcionesEstado.options.add(tmp,0);
            tmp = document.createElement("option");
            tmp.text = 'Anulada';
            opcionesEstado.options.add(tmp,1);
        } else if (chkMarcadasGeneral == true || (chkMarcadasGeneral == false && chkMarcadasEstudiante == true && chkMarcadasAsistente == true) || (chkMarcadasGeneral == false && chkMarcadasEstudiante == false && chkEstudiante == true && chkMarcadasAsistente == true) || (chkMarcadasGeneral == false && chkMarcadasEstudiante == true && chkMarcadasAsistente == false && chkAsistente == true)){
            while (opcionesEstado.options.length) {
                opcionesEstado.remove(0);
            }
            var tmp = document.createElement("option");         
            tmp.text = 'Pendiente - Administrador';
            opcionesEstado.options.add(tmp,0);
            tmp = document.createElement("option");
            tmp.text = 'Anulada';
            opcionesEstado.options.add(tmp,1);
        } else if (chkInopiaGeneral == false && chkMarcadasGeneral == false && chkMarcadasEstudiante == false && chkMarcadasAsistente == false && chkEstudiante == false && chkAsistente == false && chkGenerales == false && ((chkInopiaEstudiante == true && chkInopiaAsistente == false) || (chkInopiaEstudiante == false && chkInopiaAsistente == true))){
            while (opcionesEstado.options.length) {
                opcionesEstado.remove(0);
            }
            var tmp = document.createElement("option");               
            tmp.text = 'Elegible';
            opcionesEstado.options.add(tmp,0);
            tmp = document.createElement("option");
            tmp.text = 'Aceptada - Profesor';
            opcionesEstado.options.add(tmp,1);
            tmp = document.createElement("option");
            tmp.text = 'Aceptada - Profesor (Inopia)';
            opcionesEstado.options.add(tmp,2);
            tmp = document.createElement("option");
            tmp.text = 'Rechazada - Profesor';            
            opcionesEstado.options.add(tmp,3);
            tmp = document.createElement("option");
            tmp.text = 'Anulada';
            opcionesEstado.options.add(tmp,4);
        } else if(chkInopiaGeneral == true || chkInopiaEstudiante == true || chkInopiaAsistente == true){
            while (opcionesEstado.options.length) {
                opcionesEstado.remove(0);
            }
            var tmp = document.createElement("option");               
            tmp.text = 'Elegible';
            opcionesEstado.options.add(tmp,0);
            tmp = document.createElement("option");
            tmp.text = 'Aceptada - Profesor (Inopia)';
            opcionesEstado.options.add(tmp,1);
            tmp = document.createElement("option");
            tmp.text = 'Rechazada - Profesor';            
            opcionesEstado.options.add(tmp,2);
            tmp = document.createElement("option");
            tmp.text = 'Anulada';
            opcionesEstado.options.add(tmp,3);
        } else {
            while (opcionesEstado.options.length) {
                opcionesEstado.remove(0);
            }
            var tmp = document.createElement("option");               
            tmp.text = 'Elegible';
            opcionesEstado.options.add(tmp,0);
            tmp = document.createElement("option");
            tmp.text = 'Aceptada - Profesor';
            opcionesEstado.options.add(tmp,1);
            tmp = document.createElement("option");
            tmp.text = 'Rechazada - Profesor';            
            opcionesEstado.options.add(tmp,2);
            tmp = document.createElement("option");
            tmp.text = 'Anulada';
            opcionesEstado.options.add(tmp,3);
        }
    }

    function updateAsistentes(){
        var encontrado = false;
        a5 = document.getElementById("a5"); //Lista de id de requisitos obligatorios de horas asistente
        var r = a5.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {        
            var x = a5.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos de horas asistente
                blockAsistentes(x);
                c = r; //termino el for de una vez, no necesito ver los demás requisitos ya que encontré uno obligatorio que está marcado no
                var encontrado = true;
            }   
        }

        a6 = document.getElementById("a6");
        var s = a6.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos
        {
            var x = a6.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos de horas asistente
                blockAsistentes(x);
                c = s; //termino el for de una vez, no necesito ver los demás requisitos ya que encontré uno obligatorio que está marcado no
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
        updateEstado();
        updateHoras();
    }

    function blockAsistentes(selected){
        a6 = document.getElementById("a6"); //Lista de id de requisitos no obligatorios horas asistente
        var r = a6.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a6.options[c].text;
            if(x != selected){
                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
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
                var y = x + "-no";
                var z = x + "-sí";
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
            }
        }
    }

    function unblockAsistentes(){
        a6 = document.getElementById("a6"); //Lista de id de requisitos no obligatorios horas asistentes
        var r = a6.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los desbloquea
        {
            var x = a6.options[c].text;
            var y = x + "-no";
            var z = x + "-sí";
            var w = x + "-inopia";
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
            document.getElementById(w).disabled = false;

        }

        a5 = document.getElementById("a5"); //Lista de id de requisitos obligatorios generales
        var s = a5.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los desbloquea menos el seleccionado
        {      
            var x = a5.options[c].text;
            var y = x + "-no";
            var z = x + "-sí";
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
        }        
    }

    function checkAsistente(){
        a5 = document.getElementById("a5"); //Lista de id de requisitos obligatorios de horas asistente
        var r = a5.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {            
            var x = a5.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            } 
        }

        a6 = document.getElementById("a6"); //Lista de id de requisitos obligatorios de horas asistente
        var s = a6.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos
        { 
            var x = a6.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }
        }

        return false;
    }

    function updateEstudiantes(){
        var encontrado = false;
        a3 = document.getElementById("a3"); //Lista de id de requisitos obligatorios de horas estudiante
        var r = a3.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            var x = a3.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                blockEstudiantes(x);
                c = r; //termino el for de una vez, no necesito ver los demás requisitos ya que encontré uno obligatorio que está marcado no
                var encontrado = true;
            }
        }

        a4 = document.getElementById("a4");
        var s = a4.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos
        {
            var x = a4.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                blockEstudiantes(x);
                c = s; //termino el for de una vez, no necesito ver los demás requisitos ya que encontré uno obligatorio que está marcado no
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

        updateEstado();
        updateHoras();
    }

    function blockEstudiantes(selected){
        a4 = document.getElementById("a4"); //Lista de id de requisitos no obligatorios horas estudiante
        var r = a4.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a4.options[c].text;
            if(x != selected){
                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
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
                var y = x + "-no";
                var z = x + "-sí";
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
            }
        }
    }

    function unblockEstudiantes(){
        a4 = document.getElementById("a4"); //Lista de id de requisitos no obligatorios horas estudiantes
        var r = a4.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los desbloquea
        {
            var x = a4.options[c].text;
            var y = x + "-no";
            var z = x + "-sí";
            var w = x + "-inopia";
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
            document.getElementById(w).disabled = false;
        }

        a3 = document.getElementById("a3"); //Lista de id de requisitos obligatorios generales
        var s = a3.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los desbloquea menos el seleccionado
        {      
            var x = a3.options[c].text;     
            var y = x + "-no";
            var z = x + "-sí";
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
        }        
    }
    
    function checkEstudiante(){
        a3 = document.getElementById("a3"); //Lista de id de requisitos obligatorios de horas estudiante
        var r = a3.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            var x = a3.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }    
        }

        a4 = document.getElementById("a4"); //Lista de id de requisitos obligatorios de horas estudiante
        var s = a4.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos
        {
            var x = a4.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }    
        }

        return false;
    }

    function updateGenerales(){
        var encontrado = false;
        a1 = document.getElementById("a1"); //Lista de id de requisitos obligatorios generales
        var r = a1.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {    
            var x = a1.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                blockGenerales(x);
                blockAsistentes(x);
                blockEstudiantes(x);
                c = r; //termino el for de una vez, no necesito ver los demás requisitos ya que encontré uno obligatorio que está marcado no
                var encontrado = true;
            }            
        }

        a2 = document.getElementById("a2"); //Lista de id de requisitos obligatorios generales
        var s = a2.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos
        {            
            var x = a2.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                blockGenerales(x);
                blockAsistentes(x);
                blockEstudiantes(x);
                c = s; //termino el for de una vez, no necesito ver los demás requisitos ya que encontré uno obligatorio que está marcado no
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

        updateEstado();
        updateHoras()
    }

    function blockGenerales(selected){
        a2 = document.getElementById("a2"); //Lista de id de requisitos no obligatorios generales
        var r = a2.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a2.options[c].text;
            if(x != selected){
                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
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
                var y = x + "-no";
                var z = x + "-sí";
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
            }
        }
    }

    function unblockGenerales(){
        a2 = document.getElementById("a2"); //Lista de id de requisitos no obligatorios generales
        var r = a2.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los desbloquea
        {
            var x = a2.options[c].text;
            var y = x + "-no";
            var z = x + "-sí";
            var w = x + "-inopia";
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
            document.getElementById(w).disabled = false;
        }

        a1 = document.getElementById("a1"); //Lista de id de requisitos obligatorios generales
        var s = a1.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los desbloquea menos el seleccionado
        {      
            var x = a1.options[c].text;
            var y = x + "-no";
            var z = x + "-sí";
            document.getElementById(y).disabled = false;
            document.getElementById(z).disabled = false;
        }        
    }

    function checkGenerales(){
        a1 = document.getElementById("a1"); //Lista de id de requisitos obligatorios de horas asistente
        var r = a1.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {
            var x = a1.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }
        }
        
        a2 = document.getElementById("a2"); //Lista de id de requisitos obligatorios de horas asistente
        var s = a2.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos
        {
            var x = a2.options[c].text
            var y = x + "-no";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }
        }
        
        return false;
    }

    function checkInopiaGeneral(){
        a2 = document.getElementById("a2"); //Lista de id de requisitos obligatorios de horas asistente
        
        
        var r = a2.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos
        {    
            var x = a2.options[c].text
            var y = x + "-inopia";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }
        }
        return false;
    }

    function checkInopiaEstudiante(){
        a4 = document.getElementById("a4");
        var s = a4.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos
        {
            var x = a4.options[c].text
            var y = x + "-inopia";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }    
        }
        return false;
    }

    function checkInopiaAsistente(){
        a6 = document.getElementById("a6");
        var t = a6.options.length;
        for(c = 0;  c < t; c = c + 1) // Recorre los requisitos
        {            
            var x = a6.options[c].text
            var y = x + "-inopia";
            selReq = document.getElementById(y).checked; //devuelve en orden de la lista de id's si la opcion "no" is checked es true.
            if (selReq == true){ //La opción seleccionada es no por lo que hay que deshabilitar los demás requisitos generales
                return true;
            }
        }
        return false;
    }

    function checkMarcadasGeneral(){
        a1 = document.getElementById("a1");
        a2 = document.getElementById("a2");

        var s = a1.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los bloquea menos el seleccionado
        {
            var x = a1.options[c].text;
            var y = x + "-no";
            var z = x + "-sí";
            if(document.getElementById(y).disabled == false){
                if(document.getElementById(y).checked == false && document.getElementById(z).checked == false){
                    return true;
                }
            }
        }

        var r = a2.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a2.options[c].text;
            var y = x + "-no";
            var z = x + "-sí";
            var w = x + "-inopia";
            if(document.getElementById(y).disabled == false){
                if(document.getElementById(y).checked == false && document.getElementById(z).checked == false && document.getElementById(w).checked == false){
                    return true;
                }
            }            
        }

        return false;
    }

    function checkMarcadasEstudiante(){
        a3 = document.getElementById("a3");
        a4 = document.getElementById("a4");

        var s = a3.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los bloquea menos el seleccionado
        {
            var x = a3.options[c].text;
            var y = x + "-no";
            var z = x + "-sí";
            if(document.getElementById(y).disabled == false){
                if(document.getElementById(y).checked == false && document.getElementById(z).checked == false){
                    return true;
                }
            }
        }

        var r = a4.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a4.options[c].text;
            var y = x + "-no";
            var z = x + "-sí";
            var w = x + "-inopia";
            if(document.getElementById(y).disabled == false){
                if(document.getElementById(y).checked == false && document.getElementById(z).checked == false && document.getElementById(w).checked == false){
                    return true;
                }
            }            
        }

        return false;
    }

    function checkMarcadasAsistente(){
        a5 = document.getElementById("a5");
        a6 = document.getElementById("a6");
        
        var s = a5.options.length;
        for(c = 0;  c < s; c = c + 1) // Recorre los requisitos obligatorios y los bloquea menos el seleccionado
        {
            var x = a5.options[c].text;
            var y = x + "-no";
            var z = x + "-sí";
            if(document.getElementById(y).disabled == false){
                if(document.getElementById(y).checked == false && document.getElementById(z).checked == false){
                    return true;
                }
            }
        }

        var r = a6.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a6.options[c].text;
            var y = x + "-no";
            var z = x + "-sí";
            var w = x + "-inopia";
            if(document.getElementById(y).disabled == false){
                if(document.getElementById(y).checked == false && document.getElementById(z).checked == false && document.getElementById(w).checked == false){
                    return true;
                }
            }            
        }

        return false;
    }

</script>