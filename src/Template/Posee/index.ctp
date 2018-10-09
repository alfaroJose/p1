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
			<td><?= $this->Form->checkbox("checkbox1"); ?></td>
			<td><?= $this->Form->checkbox("checkbox2"); ?></td>
			<td><?= $this->Form->checkbox("checkbox3"); ?></td>
			<td><?= $this->Form->checkbox("checkbox4"); ?></td>
			<td><?= $this->Form->checkbox("checkbox5"); ?></td>
		</tr>
		<tr>
			<td>Modificar</td>
			<td><?= $this->Form->checkbox("checkbox6"); ?></td>
			<td><?= $this->Form->checkbox("checkbox7"); ?></td>
			<td><?= $this->Form->checkbox("checkbox8"); ?></td>
			<td><?= $this->Form->checkbox("checkbox9"); ?></td>
			<td><?= $this->Form->checkbox("checkbox10"); ?></td>
		</tr>
		<tr>
			<td>Eliminar</td>
			<td><?= $this->Form->checkbox("checkbox11"); ?></td>
			<td><?= $this->Form->checkbox("checkbox12"); ?></td>
			<td><?= $this->Form->checkbox("checkbox13"); ?></td>
			<td><?= $this->Form->checkbox("checkbox14"); ?></td>
			<td><?= $this->Form->checkbox("checkbox15"); ?></td>
		</tr>
		<tr>
			<td>Consultar</td>
			<td><?= $this->Form->checkbox("checkbox16"); ?></td>
			<td><?= $this->Form->checkbox("checkbox17"); ?></td>
			<td><?= $this->Form->checkbox("checkbox18"); ?></td>
			<td><?= $this->Form->checkbox("checkbox19"); ?></td>
			<td><?= $this->Form->checkbox("checkbox20"); ?></td>
		</tr>
		</tbody>
	</table>

	<?= $this->Html->link('Cancelar',['action'=>'index'],['class'=>'btn btn-info float-right'])?>
    <?= $this->Form->submit('Guardar',['action'=>'index', 'class'=>'btn btn-info float-right mr-3'])?>

</div>