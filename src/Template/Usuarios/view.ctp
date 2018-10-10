<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>
<style> 
table {
  border-spacing: 10px 20px 10px 20px;

}
table td{
    padding :10px 10px 10px 10px;
}
table tr {
    width: 50px;
}
tr:nth-child(2n+2) {
    background-color:#0317;
}
 </style>
<div class="usuarios form medium-5 medium-5 columns content">
    <div style=" border-width: 1px; border-style: solid; border-color: black;">
        <h5><?= 'Datos personales' ?></h5>
        <br>
    <table class="vertical-table table-striped">      
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($usuario->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Primer Apellido') ?></th>
            <td><?= h($usuario->primer_apellido) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Segundo Apellido') ?></th>
            <td><?= h($usuario->segundo_apellido) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cédula') ?></th>
            <td><?= h($usuario->cedula) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Teléfono') ?></th>
            <td><?= h($usuario->telefono) ?></td>
        </tr>
        </tr>
    </table>    
</div>
    <br>
    <div class="usuarios form large-5 medium-5 columns content">
    <div style=" border-width: 1px; border-style: solid; border-color: black;">
    <table class="vertical-table table-striped">   
    <h5><?= "Datos de seguridad" ?></h5>
    <br>
    <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= h($usuario->id) ?></td>
        </tr>
        <div class="spacer10"></div>
        <tr>
            <th scope="row"><?= __('Correo') ?></th>
            <td><?= h($usuario->correo) ?></td>
        </tr>
        <div class="spacer10"></div>
        <tr>
            <th scope="row"><?= __('Rol') ?></th>
            <td><?= $usuario->has('role') ? $this->Html->link($usuario->role->tipo, ['controller' => 'Roles', 'action' => 'view', $usuario->role->tipo]) : '' ?></td>
            </table>
</div>
<br>
    <?= $this->Html->link('Regresar',['action'=>'index'],['class'=>'btn btn-info btn-medium float-center mr-3'])?>
    <?= $this->Html->link('Eliminar usuario',['action'=>'delete',$usuario->id],['class'=>'btn btn-info btn-medium float-center mr-3'])?>
    <?= $this->Html->link('Modificar usuario',['action'=>'edit', $usuario->id],['class'=>'btn btn-info btn-medium float-center mr-3'])?>

