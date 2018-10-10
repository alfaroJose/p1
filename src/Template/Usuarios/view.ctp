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
tr:nth-child(2n+2) {
    background-color:#0317;
 }
 </style>
<div class="usuarios view large-9 medium-8 columns content">
    <h3><?= 'Datos personales' ?></h3>
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
        <div class="spacer10"></div>
        <tr>
            <th scope="row"><?= __('Segundo Apellido') ?></th>
            <td><?= h($usuario->segundo_apellido) ?></td>
        </tr>
        <div class="spacer10"></div>
        <tr>
            <th scope="row"><?= __('Cédula') ?></th>
            <td><?= h($usuario->cedula) ?></td>
        </tr>
        <div class="spacer10"></div>
        <tr>
            <th scope="row"><?= __('Teléfono') ?></th>
            <td><?= h($usuario->telefono) ?></td>
        </tr>
        <div class="spacer10"></div>
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
        </tr>
    </table>
    <br>
    <?= $this->Html->link('Regresar',['action'=>'index'],['class'=>'btn btn-info float-right'])?>
    <?= $this->Html->link('Eliminar usuario',['action'=>'delete',$usuario->id],['class'=>'btn btn-info float-right mr-3'])?>
    <?= $this->Html->link('Modificar usuario',['action'=>'edit', $usuario->id],['class'=>'btn btn-info float-right mr-3'])?>
</div>
