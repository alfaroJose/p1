<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Posee[]|\Cake\Collection\CollectionInterface $posee
 */
?>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/*Estilo css para los tabs*/
body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    text-align: center;
    display: inline-block;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 12.8px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #fff;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 10px;
    border: 1px solid #ccc;
    border-top: none;
}
/*Termina estilo*/
</style>
</head>

<body>

<script type="text/javascript">
    $(document).ready( function () {//Esta funcion es para cuando se clickea el checkbox de habilitar edicion, en donde habilita o deshabilita los checkboxes
    	$('#checkBoxHabilitar').on('click', function() {
			disabledCheckboxes();
			if($(this).is(':checked')){
				$('#Guardar').removeAttr('disabled');
			}
			else{
				$('#Guardar').prop('disabled', true);
			}
    	});
    } );

    function disabledCheckboxes(){//habilitar/deshabilitar los checkboxes de permisos
    	if($('#checkBoxHabilitar').is(':checked')){
        	$('.checkboxParaPerm').removeAttr('disabled');
        }
	    else{
        	$('.checkboxParaPerm').prop('disabled', true);
        }	
    }

    function poblarMatriz(p){//Se pasa la lista de permisos de la tabla posee
    	for(var i = 0; i < p.length; i++){
            if(p[i].estado == 1){//si su estado es encendido entonces los activa en el checkbox
                switch(p[i].permisos_id){//Basado en el id se busca que boton se debe ponerle check
                    case 1:
                        $('#checkboxConsCursos').prop("checked", true);
                        break;
                    case 2:
                        $('#checkboxElimCursos').prop("checked", true);
                        break;
                    case 3:
                        $('#checkboxInsCursos').prop("checked", true);
                        break;
                    case 4:
                        $('#checkboxModCursos').prop("checked", true);
                        break;
                    case 5:
                        $('#checkboxConsReq').prop("checked", true);
                        break;
                    case 6:
                        $('#checkboxElimReq').prop("checked", true);
                        break;
                    case 7:
                        $('#checkboxInsReq').prop("checked", true);
                        break;
                    case 8:
                        $('#checkboxModReq').prop("checked", true);
                        break;
                    case 9:
                        $('#checkboxConsRondas').prop("checked", true);
                        break;
                    case 12:
                        $('#checkboxModRondas').prop("checked", true);
                        break;
                    case 13:
                        $('#checkboxConsSoli').prop("checked", true);
                        break;
                    case 15:
                        $('#checkboxInsSoli').prop("checked", true);
                        break;
                    case 17:
                        $('#checkboxConsUsuarios').prop("checked", true);
                        break;
                    case 18:
                        $('#checkboxElimUsuarios').prop("checked", true);
                        break;
                    case 19:
                        $('#checkboxInsUsuarios').prop("checked", true);
                        break;
                    case 20:
                        $('#checkboxModUsuarios').prop("checked", true);
                        break;
                    case 21:
                        $('#checkboxIngresoRev').prop("checked", true);
                        break;
                    case 22:
                        $('#checkboxModCont').prop("checked", true);
                        break;
                    case 23:
                        $('#checkboxConsCont').prop("checked", true);
                        break;
                    case 24:
                        $('#checkboxIngresoRep').prop("checked", true);
                        break;
                    case 25:
                        $('#checkboxIngresoImp').prop("checked", true);
                        break;
                }
            }
    	}
    }

    $(document).ready( function () {//Funcion para llenar las lista de permisos para cada rol
    	var tuplas = <?php echo json_encode($posee); ?>;//todas las tuplas que hay en la tabla
        //Se reparten las tuplas entre los roles.
    	var permAdmin = new Array();
    	var permAsis = new Array();
    	var permProf = new Array();
    	var permEst = new Array();;
    	for(var i = 0; i < tuplas.length; i++){
    		if(tuplas[i].roles_id == 1){//si es admin
    			permAdmin.push(tuplas[i]);
    		}
    		else if(tuplas[i].roles_id == 2){//asistente administrativo
    			permAsis.push(tuplas[i]);
    		}
    		else if(tuplas[i].roles_id == 3){//profesor
    			permProf.push(tuplas[i]);
    		}
    		else if(tuplas[i].roles_id == 4){//4 es estudiante
    			permEst.push(tuplas[i]);
    		}
    	}

    	$('#seleccion').change(function() {//Si se selecciona algun elemento del select
    		$('.checkboxParaPerm').prop('checked', false);
    		if(!$('#seleccion').val()){//Si esta con la seleccion vacia no puede editar
    			$('#Guardar').prop('disabled', true);//Se deshabilitan los botones
    			$('#checkBoxHabilitar').prop('disabled', true);
    			$('#checkBoxHabilitar').prop('checked', false);
    			disabledCheckboxes();
    		}
	    	else{//Cualquier otra seleccion que sea valida
	    		$('#checkBoxHabilitar').removeAttr('disabled');//habilita el checkbox de edicion

	    		var permisos = new Array();
				var rolId = $(this).val();//el valor actual de la lista de seleccion
				if(rolId == 1){//admin
					permisos = permAdmin.slice();//copia al array permisos segun rol
				}
				else if(rolId == 2){//asis admin
					permisos = permAsis.slice();
				}
				else if(rolId == 3){//profesor
					permisos = permProf.slice();
				}
				else if(rolId == 4){//estudiante
					permisos = permEst.slice();
				}

	    		if(permisos.length > 0){//Si esta vacio no hay permisos asociados a rol
	    			poblarMatriz(permisos);
	    		}
		    }
		});
    } );
</script>
 
 <!-- Inicia form -->
<?= $this->Form->create(null,['url' => ['action'=>'index']]); ?>
<div class="index large-4 medium-4 medium-offset-4 medium-offset-4 columns">
	<h3>Administrar Roles</h3>

	<!-- Drop-down con roles -->
	<div class="col-lg-3 col-md-3 float-left mr-3" id="wrapper">
		<label for="Seleccion"> <b>Roles</b></label>
		<?= $this->Form->select("Seleccion", $opciones, ["id" => "seleccion", "empty" => true] ); ?>	
	</div>

	<!-- Checkbox para habilitar edicion -->
	<div class="col-md-4 float-right mr-4" id="wrapper">
		<label for="editarPermisos"><b>Habilitar Edición:</b></label>
		<?= $this->Form->checkbox("editarPermisos", ["id" => "checkBoxHabilitar", 'disabled' => 'true']); ?>
	</div>
    
    <br>
    <br>
    <br>
    <br>

    <!-- Aqui se crean los botones para los tabs con los distintos modulos y llaman al metodo implementado de JavaScript switchModule -->
    <div class="tab">
        <button type="button" class="tablinks" onclick="switchModule(event, 'Usuarios')" id="defaultOpen">Usuarios</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Cursos-Grupos')">Cursos-Grupos</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Rondas')">Rondas</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Requisitos')">Requisitos</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Solicitudes')">Solicitudes</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Revisiones')">Revisiones</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Contador')">Contador de horas</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Reportes')">Reportes</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Imprimir')">Imprimir solicitudes</button>
    </div>

    <!-- Aqui se crea el contenido para cada tab -->
    <!-- Se tienen que crear hiddens para que tome los valores de los datos del form incluso cuando estan sin seleccionar -->
    <div id="Usuarios" class="tabcontent">
        <?= $this->Form->hidden("checkboxInsUsuarios", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxModUsuarios", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxElimUsuarios", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxConsUsuarios", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <span onclick="this.parentElement.style.display='none'" class="float-right"><b>X</b></span>

        <label for="checkboxInsUsuarios">Insertar</label>
        <?= $this->Form->checkbox("checkboxInsUsuarios", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxInsUsuarios"]); ?>
        <br>

        <label for="checkboxModUsuarios">Modificar</label>
        <?= $this->Form->checkbox("checkboxModUsuarios", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxModUsuarios"]); ?>
        <br>

        <label for="checkboxElimUsuarios">Eliminar</label>
        <?= $this->Form->checkbox("checkboxElimUsuarios", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxElimUsuarios"]); ?>
        <br>

        <label for="checkboxConsUsuarios">Consultar</label>
        <?= $this->Form->checkbox("checkboxConsUsuarios", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxConsUsuarios"]); ?>
    </div>

    <div id="Cursos-Grupos" class="tabcontent">
        <?= $this->Form->hidden("checkboxModCursos", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxInsCursos", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxElimCursos", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxConsCursos", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <span onclick="this.parentElement.style.display='none'" class="float-right"><b>X</b></span>

        <label for="checkboxInsCursos">Insertar</label>
        <?= $this->Form->checkbox("checkboxInsCursos", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxInsCursos"]); ?>
        <br>

        <label for="checkboxModCursos">Modificar</label>
        <?= $this->Form->checkbox("checkboxModCursos", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxModCursos"]); ?>
        <br>

        <label for="checkboxElimCursos">Eliminar</label>
        <?= $this->Form->checkbox("checkboxElimCursos", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxElimCursos"]); ?>
        <br>

        <label for="checkboxConsCursos">Consultar</label>
        <?= $this->Form->checkbox("checkboxConsCursos", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxConsCursos"]); ?>
    </div>

    <div id="Rondas" class="tabcontent">
        <?= $this->Form->hidden("checkboxModRondas", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxConsRondas", ["disabled" => true, "class" => "checkboxParaPerm"]); ?> 

        <span onclick="this.parentElement.style.display='none'" class="float-right"><b>X</b></span>

        <label for="checkboxModRondas">Modificar</label>
        <?= $this->Form->checkbox("checkboxModRondas", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxModRondas"]); ?>
        <br>

        <label for="checkboxConsRondas">Consultar</label>
        <?= $this->Form->checkbox("checkboxConsRondas", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxConsRondas"]); ?>
    </div>

    <div id="Requisitos" class="tabcontent">
        <?= $this->Form->hidden("checkboxInsReq", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxModReq", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxElimReq", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxConsReq", ["disabled" => true, "class" => "checkboxParaPerm"]); ?> 

        <span onclick="this.parentElement.style.display='none'" class="float-right"><b>X</b></span>

        <label for="checkboxInsReq">Insertar</label>
        <?= $this->Form->checkbox("checkboxInsReq", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxInsReq"]); ?>
        <br>

        <label for="checkboxModReq">Modificar</label>
        <?= $this->Form->checkbox("checkboxModReq", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxModReq"]); ?>
        <br>

        <label for="checkboxElimReq">Eliminar</label>
        <?= $this->Form->checkbox("checkboxElimReq", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxElimReq"]); ?>
        <br>

        <label for="checkboxConsReq">Consultar</label>
        <?= $this->Form->checkbox("checkboxConsReq", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxConsReq"]); ?>

    </div>

    <div id="Solicitudes" class="tabcontent">
        <?= $this->Form->hidden("checkboxConsSoli", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxInsSoli", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <span onclick="this.parentElement.style.display='none'" class="float-right"><b>X</b></span>

        <label for="checkboxInsSoli">Insertar</label>
        <?= $this->Form->checkbox("checkboxInsSoli", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxInsSoli"]); ?>
        <br>

        <label for="checkboxConsSoli">Consultar</label>
        <?= $this->Form->checkbox("checkboxConsSoli", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxConsSoli"]); ?>

    </div>

    <div id="Revisiones" class="tabcontent">
        <?= $this->Form->hidden("checkboxIngresoRev", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <span onclick="this.parentElement.style.display='none'" class="float-right"><b>X</b></span>
        
        <label for="checkboxIngresoRev">Ingresar</label>
        <?= $this->Form->checkbox("checkboxIngresoRev", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxIngresoRev"]); ?>
    </div>

    <div id="Contador" class="tabcontent">
        <?= $this->Form->hidden("checkboxModCont", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxConsCont", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <span onclick="this.parentElement.style.display='none'" class="float-right"><b>X</b></span>

        <label for="checkboxModCont">Modificar</label>
        <?= $this->Form->checkbox("checkboxModCont", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxModCont"]); ?>
        <br>

        <label for="checkboxConsCont">Consultar</label>
        <?= $this->Form->checkbox("checkboxConsCont", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxConsCont"]); ?>
    </div>

    <div id="Reportes" class="tabcontent">
        <?= $this->Form->hidden("checkboxIngresoRep", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <span onclick="this.parentElement.style.display='none'" class="float-right"><b>X</b></span>

        <label for="checkboxModCont">Ingresar</label>
        <?= $this->Form->checkbox("checkboxIngresoRep", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxIngresoRep"]); ?>
        <br>

    </div>

    <div id="Imprimir" class="tabcontent">
        <?= $this->Form->hidden("checkboxIngresoImp", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <span onclick="this.parentElement.style.display='none'" class="float-right"><b>X</b></span>

        <label for="checkboxModCont">Ingresar</label>
        <?= $this->Form->checkbox("checkboxIngresoImp", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxIngresoImp"]); ?>
        <br>

    </div>

    <br>

    <!-- Botones para cancelar los cambios hechos y guardar los cambios -->
    <?= $this->Form->submit('Guardar',['disabled' => true, 'id' => 'Guardar','class'=>'btn btn-info float-right'])?>
    <?= $this->Html->link('Cancelar',['action'=>'index'],['class'=>'btn btn-info float-right mr-3'])?>
</div>
<?= $this->Form->end(); ?>
<!-- Finaliza form -->

<script>
//Script para manejar los tabs basado en los ejemplos de https://www.w3schools.com/howto/howto_js_tabs.asp
function switchModule(evt, nombreModulo) {
    //toma variables basado en el codigo css de arriba
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(nombreModulo).style.display = "block";
    evt.currentTarget.className += " active";
}
document.getElementById("defaultOpen").click();
</script>
</body>