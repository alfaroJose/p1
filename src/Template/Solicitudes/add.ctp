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
            /*$datosEstudiante = $this->Solicitude->getStudentInfo($username);
            $idEstudiante = $datosEstudiante[0];
            $nombreEstudiante = $datosEstudiante[1];
            $primerApellidoEstudiante = $datosEstudiante[2];
            $segundoApellidoEstudiante = $datosEstudiante[3];
            $correoEstudiante = $datosEstudiante[4];
            $telefonoEstudiante = $datosEstudiante[5];
            $cedulaEstudiante = $datosEstudiante[7];*/

            echo $this->Form->control('primer_apellido', ['readonly', 'value'=>$primerApellidoEstudiante, 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);
            echo $this->Form->control('segundo_apellido', ['readonly', 'value'=>$segundoApellidoEstudiante, 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);
            echo $this->Form->control('nombre', ['readonly', 'value'=>$nombreEstudiante, 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);
            echo $this->Form->control('identificacion', ['label'=>['text'=>'Identificación'], 'readonly', 'value'=>$cedulaEstudiante, 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);
            echo $this->Form->control('carne', ['label'=>['text'=>'Carné'], 'readonly', 'value'=>$username, 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);
            echo $this->Form->control('telefono', ['label'=>['text'=>'Teléfono'], 'readonly', 'value'=>$telefonoEstudiante, 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);
            echo $this->Form->control('correo', ['readonly', 'value'=>$correoEstudiante, 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);
            echo $this->Form->control('carrera', ['pattern'=>"[A-Za-zñÑáéíóúÁÉÍÓÚ\s]{1,100}", 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);

            //¿Qué tipo de horas desea solicitar? <checkbox></checkbox> <input type="checkbox"> Horas Asistente <input type="checkbox"> Horas Estudiante -->
            echo ("Solicita:");            
            echo $this->Form->control('horas_asistente', ['label' =>['text'=> 'Horas Asistente'], 'type' => 'checkbox', 'required' => false]);
            echo $this->Form->control('horas_estudiante', ['label' =>['text'=>'Horas Estudiante'], 'type' => 'checkbox', 'required' => false]);
            echo ("(Puede marcar ambas opciones)<br>");
            echo ( "Documentos que debe adjuntar al entregar el formulario en la ECCI:<br> 
                1. Entregar este formulario debidamente en la Secretaría de la ECCI 
                sin la firma del docente.<br>
                2. Si es su primera asistencia en la UCR debe traer además una carta de un Banco Público en la que certfique su número de cuenta de ahorro o cuenta cliente y copia de su documento de identificación.<br><br>");

            echo ("Información sobre otras asistencias:<br>
                1. ¿Tiene o va a solicitar asistencia en otra Unidad Académica u oficina de la universidad?<br>");
            echo $this->Form->radio('asistencia_externa', ['No', 'Sí']);
            
            echo $this->Form->control('cantidad_horas_externa', ['label' =>['text'=> 'Cantidad'], 'type'=> 'number', 'min'=>"0", 'step'=>"1", 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);            
            echo $this->Form->control('horas_asistente_externa', ['label' =>['text'=> 'Horas Asistente'], 'type' => 'checkbox', 'required' => false]);
            echo $this->Form->control('horas_estudiante_externa', ['label' =>['text'=>'Horas Estudiante'], 'type' => 'checkbox', 'required' => false]);
           
            echo $this->Form->hidden('fecha', ['default' => date('Y-m-d')]);
            echo $this->Form->hidden('cantidad_horas', ['value'=>0, 'label' =>['text'=> 'Cantidad', 'type'=> 'number', 'min'=>"0"]]); //Se crea la solicitud con cero horas asignadas
            echo $this->Form->hidden('estado', ['value'=>'Pendiente', 'readonly']); //Anulada o pendiente? pendiente hasta que se mande a imprimir? estado inicial Anulada
            echo $this->Form->hidden('ronda', ['value'=>$roundNumber, 'readonly']);
        ?>
        <h5> Curso solicitado </h5>
        <?php    
            if ($c2 != null){
                echo $this->Form->control('curso_sigla', ['label' =>['text'=> 'Sigla'], 'options' => $c2, 'onChange' => 'updateClass()', 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'], 'required'=> true]);
            } else {
                echo $this->Form->control('curso_sigla', ['label' =>['text'=> 'Sigla'], 'value'=> 'No hay cursos disponibles', 'onChange' => 'updateClass()', 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'], 'required'=> true, 'readonly']);
            }
            
            echo $this->Form->input('grupo_numero', ['type' => 'select', 'label' =>['text'=> 'Grupo'], /*'options' => $class, */'onChange' => 'save()', 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'], 'required'=> true]);
            echo $this->Form->input('curso_nombre', ['id' => 'nc', 'label' =>['text'=> 'Nombre del curso'], 'readonly', 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'], 'required'=> true]);
            echo $this->Form->input('grupo_profesor', ['id' => 'prof', 'disabled', 'type' =>'text', 'label' =>['text'=> 'Nombre del docente'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>'], 'required'=> true]);
            echo $this->Form->input('grupos_id', ['label' => '', 'id' => 'grupos-id', 'type' =>'text', 'readonly', 'style' => 'visibility:hidden', 'required'=> true]);
            echo $this->Form->hidden('usuarios_id', ['readonly', 'value'=>$idEstudiante]); //Usuario id del estudiante, no debería verse

        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Generar Solicitud'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>

    <?php
        /*Estos campos solamente sirven para almacenar vectores, dado que esta es la única forma eficiente que conozco de compartir variables entre php y javascript.*/

        //if($class != null){
            echo $this->Form->input('a1', ['label' => '', 'id' => 'a1', 'type' => 'select' , 'options' => $class, 'style' => 'visibility:hidden']); //número de grupo            
        //}
        
        echo $this->Form->input('a2', ['label' => '', 'id' => 'a2', 'type' => 'select' , 'options' => $code, 'style' => 'visibility:hidden']); //sigla de los cursos
        echo $this->Form->input('a3', ['label' => '', 'id' => 'a3', 'type' => 'select' , 'options' => $nombre, 'style' => 'visibility:hidden']); //nombre de los cursos
        echo $this->Form->input('a4', ['label' => '', 'id' => 'a4', 'type' => 'select' , 'options' => $course, 'style' => 'visibility:hidden']); //id de los cursos 
        //echo $this->Form->input('a5', ['label' => '', 'id' => 'a5', 'type' => 'select' , 'options' => $auto]); //id de grupos        
    ?>
    
    <?= $this->Form->end() ?>
</div>


<script>
    /*
    Esta funcion se encarga de cargar el valor de select de grupos en base al valor ingresado en el select de curso.
    Ejemplo: Si se selecciona curso ci1314, entonces el select de grupos almacenara todos los grupos en los que se imparte dicho curso
    */
    function updateClass() 
    {

        //Obtiene los select de grupo y curso respectivamente
        selClass = document.getElementById("grupo-numero");
        selCourse = document.getElementById("curso-sigla");
        
        //Obtiene valores de los inputs ocultos
        courses = selClass.options;

        a1 = document.getElementById("a1"); //Lista de números de grupos completa
        a2 = document.getElementById("a2"); //Lista de siglas de cursos completa
        
        //elimina todas las opciones de clase:
        var l = selClass.options.length;
        var r = a2.options.length;
        
        //Remueve todas las opciones de grupo actuales
        for(j = 0; j < l; j = j + 1)
        {
            selClass.options.remove(0);
        }
        
        //Recuerda el curso actual seleccionado
        actualCourse = selCourse.options[selCourse.selectedIndex].text;

        i = 0;
        var tmp2 = document.createElement("option");
        tmp2.text = "Seleccione un Grupo"
        selClass.options.add(tmp2,0);
        tmp2 = document.createElement("option");
        tmp2.text = "BORRAR";
        
        var course_array = [];

        for(c = 0;  c < r; c = c + 1) // Recorre los cursos
        {
            // alert(courses.options.length);
            //Si el curso es el mismo al curso seleccionado, manda el grupo al vector
            if(actualCourse.localeCompare(a2.item(c).text) == 0)
            {
                var tmp = document.createElement("option");               
                tmp.text = a1.options[c].text; //Prestarle atencion a esta linea
                selClass.options.add(tmp,i);
                i = i + 1;               
            }

        }
        
        txtNombre = document.getElementById("nc");
    
        if(selCourse.selectedIndex != 0)
        {           
            txtNombre.value = document.getElementById("a3").options[selCourse.selectedIndex-1].text;          
        }
        else
            txtNombre.value = "";
        
        //Esta parte de la funcion se encarga de corregir el error de PHP, en el que mete valores basura al vector y por lo tanto 
        //impiden que el codigo de curso se agregue correctamente
        var x = document.getElementById("curso-sigla").options;
        l = x.length;
        s = x.selectedIndex;
        
        if(x[0].value == "0") //Realiza el cambio
        {
            var cursos = [];          
            //Recorre todos los cursos y los borra
            for(i = 0; i < l; ++i)
            {
                cursos.push(selCourse.options[0].text);
                selCourse.options.remove(0);                              
            }
            
            //Agarra todos los cursos y los mete otra vez, pero esta vez con el formato correcto para que el codigo de curso
            //se agregue correctamente.
            for(j = 0; j < l; ++j)
            {
                //Agrega el curso. 
                var tmp = document.createElement("option");
                tmp.value = cursos[j]; //Para que phpcake detecte el valor seleccionado y no el indice
                tmp.text = cursos[j]; //Para que el select despliegue el valor respectivo de la opcion y no un valor vacio
                selCourse.options.add(tmp,j);
            }
        }

        //Dado que se borro y se recreo el select de cursos, es necesario recordar cual fue el valor que habia seleccionado el usuario
        selCourse.selectedIndex = s;

        /*Cuando se selecciona otro curso el valor anterior del campo profesor debe borrarse para no generar confusión*/
        selProf = document.getElementById("prof");
        selProf.value = null;  

        /*Cuando se cambia el curso, el id anterior debe borrarse*/
        selID = document.getElementById("grupos-id");
        selID.value = null;    

    }
    /*
        Esta funcion se encarga de salvar el nombre del curso y del profesor en 2 campos de texto bloqueados, de modo que el usuario pueda 
        ver la información del grupo y curso que selecciono
    */
    function save()
    {
        //Referencia los selects de grupo y curso respectivamente
        selClass = document.getElementById("grupo-numero");
        selCourse = document.getElementById("curso-sigla");
        
        //Obtiene el valor del curso y grupo seleccionados actualmente
        Course = selCourse.options[selCourse.selectedIndex].text;
        Group = selClass.options[selClass.selectedIndex].text;
        //Realiza una peticion al servidor mediante la tecnica AJAX, para obtener el nombre del profesor en base al curso y grupo actual
        $.ajax({
    url:"<?php echo \Cake\Routing\Router::url(array('controller'=>'Solicitudes','action'=>'obtenerProfesor'));?>" ,   cache: false,
    type: 'GET',
    contentType: 'application/json; charset=utf-8',
    dataType: 'text',
    async: false,
    data: { curso: Course, grupo: Group, salida:"xdxd"},
    success: function (data) {
       // $('#context').html(data);
        p = data.split(" ");
        
        //Mete en el campo bloqueado la informacion del profesor
        //alert(p[6]);
        //alert((p[7]).split(")")[0]);

        //Si p[6] es null quiere decir que el grupo no tiene profesor asignado
        if (p[6] != null) {
        /*En caso de que el nombre sean dos nombres, ej: Juan Pablo, el apellido quedaría en p[8]*/
            if (p[8] != null){
                if (p[9] != null){ //caso de apellido compuesto de 3 palabras: de la ossa    
                    document.getElementById("prof").value = (p[6] + " " + p[7] + " " + p[8] + " " + p[9]).split(")")[0]; 
                } else {       
                    document.getElementById("prof").value = (p[6] + " " + p[7] + " " + p[8]).split(")")[0]; 
                }
            } else {
                document.getElementById("prof").value = (p[6] + " " + p[7]).split(")")[0]; 
            }
        } else {
            document.getElementById("prof").value = "No hay profesor asignado"; 

        }
        
        /*En caso de que el usuario seleccione un grupo, pero después cambie la opción a Seleccionar Grupo entonces el nombre del profesor debe borrarse para no generar confusión*/
        if (selClass.options[selClass.selectedIndex].text == 'Seleccione un Grupo'){
            document.getElementById("prof").value = null;
        }

    },
    error: function(jqxhr, status, exception)
    {
        alert(exception);

    }
        });
        
        //Ahora que se selecciono un curso, ya no es necesario que aparezca esta opcion
        //if(selClass.options[(selClass.length-1)].text == "Seleccione un Curso")
           // selClass.options.remove((selClass.length-1));
           save2();
    }

    /*
        Esta funcion se encarga de salvar el id auto-incremental del grupo en el campo de texto no visible
    */
    function save2()
    {
        //Referencia los selects de grupo y curso respectivamente
        selClass = document.getElementById("grupo-numero");
        selCourse = document.getElementById("curso-sigla");

        selID = document.getElementById("grupos-id");
      
        //Obtiene el valor del curso y grupo seleccionados actualmente
        Course = selCourse.options[selCourse.selectedIndex].text;
        Group = selClass.options[selClass.selectedIndex].text;
        //Realiza una peticion al servidor mediante la tecnica AJAX, para obtener el nombre del profesor en base al curso y grupo actual
        $.ajax({
    url:"<?php echo \Cake\Routing\Router::url(array('controller'=>'Solicitudes','action'=>'obtenerGrupoID'));?>" ,   cache: false,
    type: 'GET',
    contentType: 'application/json; charset=utf-8',
    dataType: 'text',
    async: false,
    data: { curso: Course, grupo: Group, salida:"xdxd"},
    success: function (data) {
       // $('#context').html(data);
        p = data.split(" ");
        
        //Mete en el campo bloqueado el id del grupo seleccionado
        document.getElementById("grupos-id").value = (p[6] + " " + p[7]).split(")")[0];
    },
    error: function(jqxhr, status, exception)
    {
        alert(exception);

    }
        });

        /*Esta parte es para poner el valor correcto en el campo del id, sin esto el value queda en null*/
        var x = selID.options;

        s = x.selectedIndex;

        var tmp = document.createElement("option");
        tmp.value = (p[6] + " " + p[7]).split(")")[0]; //Para que phpcake detecte el valor seleccionado y no el indice
        tmp.text = (p[6] + " " + p[7]).split(")")[0]; //Para que el select despliegue el valor respectivo de la opcion y no un valor vacio
        selID.options.add(tmp,0);
        selID.selectedIndex = s;

    }

</script>
