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
 </style>
<div class="usuarios form medium-9 medium-8 columns content">
    <br>
    <h5><?= 'Datos personales' ?></h5>
    <div style=" padding-left: 75px; width: 40%; border-style: solid; border-width: 1px; border-color: black;">

    <table class="vertical-table">      
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
    <div class="usuarios form large-9 medium-8 columns content">
    <br> 
    <h5><?= "Datos de seguridad" ?></h5>
    <div style=" padding-left: 75px; width: 40%; border-style: solid; border-width: 1px; border-color: black;">
    <table class="vertical-table">    
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
            <td><?= $usuario->has('role') ? $this->Html->link($usuario->role->tipo, ['controller' => 'Posee', 'action' => 'view', $usuario->role->tipo]) : '' ?></td>
            </table>
</div>
<br>
    <?= $this->Html->link('Modificar usuario',['action'=>'edit', $usuario->id],['class'=>'btn btn-info btn-medium float-right'])?>
    <?= $this->Html->link('Eliminar usuario',['action'=>'delete',$usuario->id],['class'=>'btn btn-info btn-medium float-right mr-3'])?>
    <?= $this->Html->link('Regresar',['action'=>'index'],['class'=>'btn btn-info btn-medium float-right mr-3'])?>

    

