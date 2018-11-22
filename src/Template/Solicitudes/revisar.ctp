<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
 */
?>

<div class="solicitudes form large-9 medium-8 columns content">
    <?= $this->Form->create($solicitude, array('onsubmit' => 'unblockTodo();')); ?>
    <fieldset>
        <legend><?= __('Revisar Solicitud') ?></legend>
        <!-- Aqui carga los datos del estudiante para que solamente se puedan ver -->
        <br>
        <h5> Datos del estudiante </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            echo $this->Form->control('estudiante_primer_apellido', ['label'=>['text'=>'Primer Apellido'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_primer_apellido'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('estudiante_segundo_apellido', ['label'=>['text'=>'Segundo Apellido'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_segundo_apellido'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('estudiante_nombre', ['label'=>['text'=>'Nombre'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_nombre'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('estudiante_identificacion', ['label'=>['text'=>'Identificación'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_identificacion'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('estudiante_tipo_identificacion', ['label'=>['text'=>'Tipo de identificación'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_tipo_identificacion'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('estudiante_carne', ['label'=>['text'=>'Carné'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_carne'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('estudiante_telefono', ['label'=>['text'=>'Teléfono'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_telefono'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('estudiante_correo', ['label'=>['text'=>'Correo'], 'readonly', 'value'=> $datosSolicitud[0]['estudiante_correo'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('solicitud_carrera', ['label'=>['text'=>'Carrera'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_carrera'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('solicitud_horas_estudiante', ['label'=>['text'=>'Solicita horas estudiante'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_horas_estudiante'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('solicitud_horas_asistente', ['label'=>['text'=>'Solicita horas asistente'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_horas_asistente'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
        ?>
        </div>
        <!-- Aqui carga los datos de asistencia externa para que solamente se puedan ver -->
        <br>
        <h5> ¿Tiene o va a solicitar asistencia en otra Unidad Académica u oficina de la Universidad? </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            echo $this->Form->control('solicitud_horas_estudiante_externas', ['label'=>['text'=>'Horas estudiante'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_horas_estudiante_externas'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('solicitud_horas_asistente_externas', ['label'=>['text'=>'Horas asistente'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_horas_asistente_externas'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]); 
            if ($datosSolicitud[0]['solicitud_cantidad_horas_externa'] != 0) {
                echo $this->Form->control('solicitud_cantidad_horas_externa', ['label'=>['text'=>'Cantidad de horas'], 'readonly', 'value'=> $datosSolicitud[0]['solicitud_cantidad_horas_externa'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            }
        ?>
        </div>
        <!-- Aqui carga los datos del curso para que solamente se puedan ver -->
        <br>
        <h5> Curso solicitado </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            echo $this->Form->control('curso_sigla', ['label'=>['text'=>'Sigla'], 'readonly', 'value'=> $datosSolicitud[0]['curso_sigla'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('grupo_numero', ['label'=>['text'=>'Grupo'], 'readonly', 'value'=> $datosSolicitud[0]['grupo_numero'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('curso_nombre', ['label'=>['text'=>'Curso'], 'readonly', 'value'=> $datosSolicitud[0]['curso_nombre'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
            echo $this->Form->control('profesor_nombre', ['label'=>['text'=>'Docente'], 'readonly', 'value'=> $datosSolicitud[0]['profesor_nombre'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'] ]);
        ?>
        </div>
        
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
                $auto5 = null;
                $auto6 = null; 
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
                            $attributes = array('legend' => false, 'value' => $asistente['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateAsistentes()');
                            echo $this->Form->radio($asistente['requisito_id'], $options, $attributes);
                        //Si el requisito no es obligatorio entra aqui
                        } else {
                            $auto6[$j] = $asistente['requisito_id'];
                            $j = $j+1;
                            $options= array('Sí' => 'Sí', 'No' => 'No', 'Inopia' => 'Inopia',);
                            $attributes = array('legend' => false, 'value' => $asistente['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateAsistentes()');
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
                $auto3 = null;
                $auto4 = null;
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
                            $attributes = array('legend' => false, 'value' => $estudiante['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateEstudiantes()');
                            echo $this->Form->radio($estudiante['requisito_id'], $options, $attributes);
                        //Si el requisito no es obligatorio entra aqui
                        } else {
                            $auto4[$j] = $estudiante['requisito_id'];
                            $j = $j+1;
                            $options= array('Sí' => 'Sí', 'No' => 'No', 'Inopia' => 'Inopia',);
                            $attributes = array('legend' => false, 'value' => $estudiante['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateEstudiantes()');
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
                $auto = null;
                $auto2 = null;
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
                            $attributes = array('legend' => false, 'value' => $general['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateGenerales()');
                            echo $this->Form->radio($general['requisito_id'], $options, $attributes);
                        //Si el requisito no es obligatorio entra aqui
                        } else {
                            $auto2[$j] = $general['requisito_id'];
                            $j = $j+1;
                            $options= array('Sí' => 'Sí', 'No' => 'No', 'Inopia' => 'Inopia',);
                            $attributes = array('legend' => false, 'value' => $general['tiene_condicion'], 'disabled' => false, 'onclick'=> 'updateGenerales()');
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

        <?php if($solicitude['estado'] == 'Aceptada - Profesor' or $solicitude['estado'] == 'Aceptada - Profesor (Inopia)' or $solicitude['estado'] == 'Rechazada'):?>
            <div onload="blockTodo()">
        <?php else:?>
            <div onload="updateAsistentes()">
            <div onload="updateEstudiantes()">
            <div onload="updateGenerales()">
            <div onload="updateEstado()">
            <div onload="setEstadoInicial()">
        <?php endif; ?>
        
        <!-- Aqui carga el estado de la solicitud con sus datos -->
        <br>
        <h5> Datos administrativos </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            echo $this->Form->input('estado', ['type' => 'select', 'label' =>['text'=> 'Estado'], 'value'=> $solicitude['estado'], 'required'=> true, 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);
            echo $this->Form->control('promedio', ['label' => 'Promedio', 'pattern'=>"[0-9]{0,2}", 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);          
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

    function unblockTodo(){
        a1 = document.getElementById("a1");
        a2 = document.getElementById("a2");
        a3 = document.getElementById("a3");
        a4 = document.getElementById("a4");
        a5 = document.getElementById("a5");
        a6 = document.getElementById("a6"); //Lista de id de requisitos no obligatorios horas asistente
        var r = a6.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a6.options[c].text;

                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
                document.getElementById(y).disabled = false;
                document.getElementById(z).disabled = false;
                document.getElementById(w).disabled = false;
           
        }
        var r = a4.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a4.options[c].text;
                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
                document.getElementById(y).disabled = false;
                document.getElementById(z).disabled = false;
                document.getElementById(w).disabled = false;

        }
        var r = a2.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a2.options[c].text;
                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
                document.getElementById(y).disabled = false;
                document.getElementById(z).disabled = false;
                document.getElementById(w).disabled = false;
        }
        var r = a5.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a5.options[c].text;
                var y = x + "-no";
                var z = x + "-sí";
                document.getElementById(y).disabled = false;
                document.getElementById(z).disabled = false;

        }
        var r = a3.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a3.options[c].text;
                var y = x + "-no";
                var z = x + "-sí";
                document.getElementById(y).disabled = false;
                document.getElementById(z).disabled = false;
        }
        var r = a1.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a1.options[c].text;
                var y = x + "-no";
                var z = x + "-sí";
                document.getElementById(y).disabled = false;
                document.getElementById(z).disabled = false;
        }
    }

    function blockTodo(){
        a1 = document.getElementById("a1");
        a2 = document.getElementById("a2");
        a3 = document.getElementById("a3");
        a4 = document.getElementById("a4");
        a5 = document.getElementById("a5");
        a6 = document.getElementById("a6"); //Lista de id de requisitos no obligatorios horas asistente
        var r = a6.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a6.options[c].text;

                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
                document.getElementById(w).disabled = true;
           
        }
        var r = a4.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a4.options[c].text;
                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
                document.getElementById(w).disabled = true;

        }
        var r = a2.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a2.options[c].text;
                var y = x + "-no";
                var z = x + "-sí";
                var w = x + "-inopia";
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
                document.getElementById(w).disabled = true;
        }
        var r = a5.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a5.options[c].text;
                var y = x + "-no";
                var z = x + "-sí";
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;

        }
        var r = a3.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a3.options[c].text;
                var y = x + "-no";
                var z = x + "-sí";
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
        }
        var r = a1.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a1.options[c].text;
                var y = x + "-no";
                var z = x + "-sí";
                document.getElementById(y).disabled = true;
                document.getElementById(z).disabled = true;
        }

        var actualizarEstado = "<?php echo $solicitude['estado']; ?>";
        var opcionesEstado = document.getElementById("estado");
        var tmp = document.createElement("option");               
        tmp.text = actualizarEstado;
        opcionesEstado.options.add(tmp,0);
        opcionesEstado.disabled = true;
    }

    function updateEstado(){
        var chkEstudiante = checkEstudiante(); //verdadero -> algun NO esta precionado
        var chkAsistente = checkAsistente();   // falso -> ningun NO esta precionado
        var chkGenerales = checkGenerales();

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
        } else {
            while (opcionesEstado.options.length) {
                opcionesEstado.remove(0);
            }
            var tmp = document.createElement("option");               
            tmp.text = 'Elegible';
            opcionesEstado.options.add(tmp,0);
            tmp = document.createElement("option");
            tmp.text = 'Anulada';
            opcionesEstado.options.add(tmp,3);
        }
    }

    function setEstadoInicial(){
        var actualizarEstado = "<?php echo $solicitude['estado']; ?>";

        if (actualizarEstado == 'Pendiente'){
            actualizarEstado = 'Pendiente - Administrador'
            document.getElementById("estado").value = actualizarEstado;
        } else if (actualizarEstado == 'Anulada'){
            document.getElementById("estado").value = actualizarEstado;
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
                blockAsistentes();
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
                blockAsistentes();
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
    }

    function blockAsistentes(){
        a6 = document.getElementById("a6"); //Lista de id de requisitos no obligatorios horas asistente
        var r = a6.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a6.options[c].text;
            var y = x + "-no";
            if (document.getElementById(y).checked == false){
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
            var y = x + "-no";
            if (document.getElementById(y).checked == false){
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
                blockEstudiantes();
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
                blockEstudiantes();
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
    }

    function blockEstudiantes(){
        a4 = document.getElementById("a4"); //Lista de id de requisitos no obligatorios horas estudiante
        var r = a4.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a4.options[c].text;
            var y = x + "-no";
            if (document.getElementById(y).checked == false){
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
            var y = x + "-no";
            if (document.getElementById(y).checked == false){
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
                blockGenerales();
                blockAsistentes();
                blockEstudiantes();
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
                blockGenerales();
                blockAsistentes();
                blockEstudiantes();
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
    }

    function blockGenerales(){
        a2 = document.getElementById("a2"); //Lista de id de requisitos no obligatorios generales
        var r = a2.options.length;
        for(c = 0;  c < r; c = c + 1) // Recorre los requisitos no obligatorios y los bloquea
        {
            var x = a2.options[c].text;
            var y = x + "-no";
            if (document.getElementById(y).checked == false){
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
            var y = x + "-no";
            if (document.getElementById(y).checked == false){
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