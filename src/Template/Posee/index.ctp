<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Posee[]|\Cake\Collection\CollectionInterface $posee
 */
?>

<?php
	$opciones = array("1" => "Administrador","2" => "Asistente Administrativo", "3" => "Profesor", "4" => "Estudiante"); 
?> 

<script type="text/javascript">
    $(document).ready( function () {
    	$('input').on('click', function() {
	    	disabledCheckboxes();
    	});
    } );

    function disabledCheckboxes(){
    	if($('#checkBoxHabilitar').is(':checked')){
        	$('.checkboxParaPerm').removeAttr('disabled');
        }
	    else{
        	$('.checkboxParaPerm').prop('disabled', true);
        }	
    }

    $(document).ready( function () {
    	var tuplas = <?php echo json_encode($posee); ?>;//todas las tuplas que hay en la tabla

    	$('#seleccion').change(function() {//Si se selecciona algun elemento del select
    		if(!$('#seleccion').val()){//Si esta con la seleccion vacia no puede editar
    			$('#checkBoxHabilitar').prop('disabled', true);
    			$('#checkBoxHabilitar').prop('checked', false);
    			disabledCheckboxes();
    		}
	    	else{
	    		$('#checkBoxHabilitar').removeAttr('disabled');
	    	}
    		$('.checkboxParaPerm').prop('checked', false);
    		for(var i = 0; i < tuplas.length; i++){
    			if($(this).val() == tuplas[i].roles_id){
    				if(tuplas[i].permisos_modulo == 'Cursos-Grupos' && tuplas[i].permisos_funcionalidad == 'Insertar'){
    					$('#checkbox1').prop("checked", true);
    				}
    			}
    		}
		});
    } );
</script>

<!-- <?php foreach ($posee as $pos): ?>
    <h1><?php echo $pos; ?></h1>
<?php endforeach; ?> -->
 
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

	<table style="width:100%" class="input-matrix">
		<thead>
		<tr>
			<th></th>
			<th>Usuarios</th>
			<th>Cursos</th>
			<th>Rondas</th>
			<th>Requisitos</th>
			<th>Solicitudes</th>
		</tr>
		</thead>
		<tbody>

		<tr>
			<td>Insertar</td>
			<td><?= $this->Form->checkbox("checkbox1", ["disabled" => true, "class" => "checkboxParaPerm", "id" => "checkbox1"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox2", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox3", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox4", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox5", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
		</tr>
		<tr>
			<td>Modificar</td>
			<td><?= $this->Form->checkbox("checkbox6", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox7", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox8", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox9", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox10", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
		</tr>
		<tr>
			<td>Eliminar</td>
			<td><?= $this->Form->checkbox("checkbox11", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox12", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox13", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox14", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox15", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
		</tr>
		<tr>
			<td>Consultar</td>
			<td><?= $this->Form->checkbox("checkbox16", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox17", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox18", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox19", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
			<td><?= $this->Form->checkbox("checkbox20", ["disabled" => true, "class" => "checkboxParaPerm"]); ?></td>
		</tr>
		</tbody>
	</table>

	<?= $this->Html->link('Cancelar',['action'=>'index'],['class'=>'btn btn-info float-right'])?>
    <?= $this->Form->submit('Guardar',['class'=>'btn btn-info float-right mr-3'])?>
   
</div>