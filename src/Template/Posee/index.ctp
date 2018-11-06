<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Posee[]|\Cake\Collection\CollectionInterface $posee
 */
?>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
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
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
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
                switch(p[i].permisos_id){
                    case 1:
                        $('#checkboxConsCursos').prop("checked", true);
                        break;
                    case 2:
                        $('#checkboxElimCursos').prop("checked", true);
                        break;
                    case 3:
                        $('#checkboxInsUsuarios').prop("checked", true);
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
                    case 10:
                        $('#checkboxElimRondas').prop("checked", true);
                        break;
                    case 11:
                        $('#checkboxInsRondas').prop("checked", true);
                        break;
                    case 12:
                        $('#checkboxModRondas').prop("checked", true);
                        break;
                    case 13:
                        $('#checkboxConsSoli').prop("checked", true);
                        break;
                    case 14:
                        $('#checkboxElimSoli').prop("checked", true);
                        break;
                    case 15:
                        $('#checkboxInsSoli').prop("checked", true);
                        break;
                    case 16:
                        $('#checkboxModSoli').prop("checked", true);
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
    	var permEst = new Array();

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

    <!-- Se tienen que crear hiddens para que tome los valores incluso cuando estan sin seleccionar -->
    
    <!-- <?= $this->Form->hidden("checkboxInsRondas", ["disabled" => true, "class" => "checkboxParaPerm"]); ?> -->

    <!-- <?= $this->Form->hidden("checkboxConsRondas", ["disabled" => true, "class" => "checkboxParaPerm"]); ?> -->

    <!-- <?= $this->Form->hidden("checkboxElimRondas", ["disabled" => true, "class" => "checkboxParaPerm"]); ?> -->
   
    <!-- <td><?= $this->Form->checkbox("checkboxInsRondas", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxInsRondas"]); ?></td> -->

    <!-- <td><?= $this->Form->checkbox("checkboxElimRondas", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxElimRondas"]); ?></td> -->

    <!-- <td><?= $this->Form->checkbox("checkboxConsRondas", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxConsRondas"]); ?></td> -->



    <?= $this->Form->hidden("checkboxInsReq", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkboxInsSoli", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    
    <?= $this->Form->hidden("checkboxModReq", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkboxModSoli", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    
    
    
    <?= $this->Form->hidden("checkboxElimReq", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkboxElimSoli", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    
    <?= $this->Form->hidden("checkboxConsReq", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkboxConsSoli", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>


        <td><?= $this->Form->checkbox("checkboxInsReq", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxInsReq"]); ?></td>
        <td><?= $this->Form->checkbox("checkboxInsSoli", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxInsSoli"]); ?></td>

	
	
	<td><?= $this->Form->checkbox("checkboxModReq", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxModReq"]); ?></td>
	<td><?= $this->Form->checkbox("checkboxModSoli", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxModSoli"]); ?></td>

	<td><?= $this->Form->checkbox("checkboxElimReq", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxElimReq"]); ?></td>
	<td><?= $this->Form->checkbox("checkboxElimSoli", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxElimSoli"]); ?></td>

	<td><?= $this->Form->checkbox("checkboxConsReq", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxConsReq"]); ?></td>
	<td><?= $this->Form->checkbox("checkboxConsSoli", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxConsSoli"]); ?></td>

    <br>
    <br>
    <br>
    <br>

    <?= $this->Form->end(); ?>

    <div class="tab">
        <button type="button" class="tablinks" onclick="switchModule(event, 'Usuarios')" >Usuarios</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Cursos-Grupos')">Cursos-Grupos</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Rondas')">Rondas</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Requisitos')">Requisitos</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Solicitudes')">Solicitudes</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Revisiones')">Revisiones</button>
        <button type="button" class="tablinks" onclick="switchModule(event, 'Contador de horas')">Contador de horas</button>
    </div>

    <?= $this->Form->create(null,['url' => ['action'=>'index']]); ?>

    <div id="Usuarios" class="tabcontent">
        <?= $this->Form->hidden("checkboxInsUsuarios", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxModUsuarios", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxElimUsuarios", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxConsUsuarios", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <td><?= $this->Form->checkbox("checkboxInsUsuarios", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxInsUsuarios"]); ?></td>
        <td><?= $this->Form->checkbox("checkboxModUsuarios", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxModUsuarios"]); ?></td>
        <td><?= $this->Form->checkbox("checkboxElimUsuarios", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxElimUsuarios"]); ?></td>
        <td><?= $this->Form->checkbox("checkboxConsUsuarios", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxConsUsuarios"]); ?></td>
    </div>

    <div id="Cursos-Grupos" class="tabcontent">
        <?= $this->Form->hidden("checkboxModCursos", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxInsCursos", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxElimCursos", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <?= $this->Form->hidden("checkboxConsCursos", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <td><?= $this->Form->checkbox("checkboxInsCursos", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxInsCursos"]); ?></td>

        <td><?= $this->Form->checkbox("checkboxModCursos", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxModCursos"]); ?></td>

        <td><?= $this->Form->checkbox("checkboxElimCursos", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxElimCursos"]); ?></td>

        <td><?= $this->Form->checkbox("checkboxConsCursos", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxConsCursos"]); ?></td>

    </div>

    <div id="Rondas" class="tabcontent">
        <?= $this->Form->hidden("checkboxModRondas", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>

        <td><?= $this->Form->checkbox("checkboxModRondas", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkboxModRondas"]); ?></td>
    </div>

    <div id="Requisitos" class="tabcontent">

    </div>

    <div id="Solicitudes" class="tabcontent">

    </div>

    <div id="Revisiones" class="tabcontent">

    </div>

    <div id="Contador" class="tabcontent">

    </div>

    <?= $this->Form->end(); ?>

    <?= $this->Html->link('Cancelar',['action'=>'index'],['class'=>'btn btn-info float-right'])?>
    <?= $this->Form->submit('Guardar',['disabled' => true, 'id' => 'Guardar','class'=>'btn btn-info float-right mr-3'])?>
</div>

<script>
function switchModule(evt, nombreModulo) {
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

// Get the element with id="defaultOpen" and click on it
//document.getElementById("defaultOpen").click();
</script>

</body>