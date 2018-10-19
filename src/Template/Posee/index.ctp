<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Posee[]|\Cake\Collection\CollectionInterface $posee
 */
?>

<script type="text/javascript">
    $(document).ready( function () {
    	$('#checkBoxHabilitar').on('click', function() {
			disabledCheckboxes();
			if($(this).is(':checked')){
				$('#Guardar').removeAttr('disabled');
			}
			else{
				$('#Guardar').prop('disabled', true);
			}
    	});

    	$('.checkboxParaPerm').on('click')

    } );

    function disabledCheckboxes(){//habilitar/deshabilitar
    	if($('#checkBoxHabilitar').is(':checked')){
        	$('.checkboxParaPerm').removeAttr('disabled');
        }
	    else{
        	$('.checkboxParaPerm').prop('disabled', true);
        }	
    }

    function poblarMatriz(p){//Se pasa la lista de permisos
    	for(var i = 0; i < p.length; i++){
            if(p[i].estado == 1){
                if(p[i].permisos_funcionalidad == 'Insertar'){
                    if(p[i].permisos_modulo == 'Usuarios'){
                        $('#checkbox1').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Cursos-Grupos'){
                        $('#checkbox2').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Rondas'){
                        $('#checkbox3').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Requisitos'){
                        $('#checkbox4').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Solicitudes'){
                        $('#checkbox5').prop("checked", true);
                    }
                }
                else if(p[i].permisos_funcionalidad == 'Modificar'){
                    if(p[i].permisos_modulo == 'Usuarios'){
                        $('#checkbox6').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Cursos-Grupos'){
                        $('#checkbox7').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Rondas'){
                        $('#checkbox8').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Requisitos'){
                        $('#checkbox9').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Solicitudes'){
                        $('#checkbox10').prop("checked", true);
                    }
                }
                else if(p[i].permisos_funcionalidad == 'Eliminar'){
                    if(p[i].permisos_modulo == 'Usuarios'){
                        $('#checkbox11').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Cursos-Grupos'){
                        $('#checkbox12').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Rondas'){
                        $('#checkbox13').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Requisitos'){
                        $('#checkbox14').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Solicitudes'){
                        $('#checkbox15').prop("checked", true);
                    }
                }
                else if(p[i].permisos_funcionalidad == 'Consultar'){
                    if(p[i].permisos_modulo == 'Usuarios'){
                        $('#checkbox16').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Cursos-Grupos'){
                        $('#checkbox17').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Rondas'){
                        $('#checkbox18').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Requisitos'){
                        $('#checkbox19').prop("checked", true);
                    }
                    else if(p[i].permisos_modulo == 'Solicitudes'){
                        $('#checkbox20').prop("checked", true);
                    }
                }
            }
    	}
    }

    $(document).ready( function () {
    	var tuplas = <?php echo json_encode($posee); ?>;//todas las tuplas que hay en la tabla
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
    			$('#Guardar').prop('disabled', true);
    			$('#checkBoxHabilitar').prop('disabled', true);
    			$('#checkBoxHabilitar').prop('checked', false);
    			disabledCheckboxes();
    		}
	    	else{//Cualquier otra seleccion valida
	    		$('#checkBoxHabilitar').removeAttr('disabled');//habilita el checkbox de edicion

	    		var permisos = new Array();
				var rolId = $(this).val();//el valor actual de la lista de seleccion
				if(rolId == 1){//admin
					permisos = permAdmin.slice();//copia al array permisos
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

    <?= $this->Form->hidden("checkbox1", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox2", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox3", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox4", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox5", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox6", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox7", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox8", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox9", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox10", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox11", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox12", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox13", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox14", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox15", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox16", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox17", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox18", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox19", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
    <?= $this->Form->hidden("checkbox20", ["disabled" => true, "class" => "checkboxParaPerm"]); ?>
	
	<table style="width:100%" class="input-matrix">
		<thead>
		<tr>
			<th></th>
			<th>Usuarios</th>
			<th>Cursos-Grupos</th>
			<th>Rondas</th>
			<th>Requisitos</th>
			<th>Solicitudes</th>
		</tr>
		</thead>
		<tbody>

		<tr>
			<td>Insertar</td>
			<td><?= $this->Form->checkbox("checkbox1", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox1"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox2", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox2"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox3", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox3"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox4", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox4"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox5", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox5"]); ?></td>
		</tr>
		<tr>
			<td>Modificar</td>
			<td><?= $this->Form->checkbox("checkbox6", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox6"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox7", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox7"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox8", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox8"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox9", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox9"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox10", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox10"]); ?></td>
		</tr>
		<tr>
			<td>Eliminar</td>
			<td><?= $this->Form->checkbox("checkbox11", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox11"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox12", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox12"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox13", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox13"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox14", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox14"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox15", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox15"]); ?></td>
		</tr>
		<tr>
			<td>Consultar</td>
			<td><?= $this->Form->checkbox("checkbox16", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox16"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox17", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox17"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox18", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox18"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox19", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox19"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox20", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox20"]); ?></td>
		</tr>
		</tbody>
	</table>

    <br>
    <br>

	<?= $this->Html->link('Cancelar',['action'=>'index'],['class'=>'btn btn-info float-right'])?>
    <?= $this->Form->submit('Guardar',['disabled' => true, 'id' => 'Guardar','class'=>'btn btn-info float-right mr-3'])?>

</div>
<?= $this->Form->end(); ?>