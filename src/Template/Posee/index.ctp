<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Posee[]|\Cake\Collection\CollectionInterface $posee
 */
?>

<?php ;
	$seleccion = 0;
	$opciones = array("A" => "Administrador", "P" => "Profesor", "E" => "Estudiante", "AA" => "Asistente Administrativo"); 
?> 


<div class="index large-4 medium-4 medium-offset-4 medium-offset-4 columns">
	<h3>Administrar Roles</h3>

	<div class="col-lg-3 col-md-3 float-left mr-3" id="wrapper">
		<label for="Seleccion"> <b>Roles</b></label>
		<?= $this->Form->select("Seleccion", $opciones, ["empty" => true ] ); ?>	
	</div>

	<div class="col-md-4 float-right mr-4" id="wrapper">
		<label for="EditarPermisos"><b>Habilitar Edición:</b></label>
		<?= $this->Form->checkbox("EditarPermisos"); ?>
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
			<td><input type="checkbox" name="name" value="1"> </td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
		</tr>
		<tr>
			<td>Modificar</td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
		</tr>
		<tr>
			<td>Eliminar</td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
		</tr>
		<tr>
			<td>Consultar</td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
			<td><input type="checkbox"></td>
		</tr>
		</tbody>
	</table>

	<?= $this->Form->submit("Guardar");?> 
	<?= $this->Form->submit("Cancelar");?>

</div>