<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario $usuario
 */
?>

<style> 
table th, td{
    border: 1px solid #ddd;
    text-align: left;
    padding :10px;
}
tr:nth-child(even) {background-color:  #eaecee };
</style>

<div class="usuarios form medium-9 medium-8 columns content">
    <br>
    <h5><?= 'Datos personales' ?></h5>
    <table class>
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
            <th scope="row"><?= __('Tipo de identificacion') ?></th>
            <td><?= h($usuario->tipo_identificacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Identificación') ?></th>
            <td><?= h($usuario->identificacion) ?></td>
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
    <table class>    
    <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= h($usuario->nombre_usuario) ?></td>
        </tr>
        <div class="spacer10"></div>
        <tr>
            <th scope="row"><?= __('Correo') ?></th>
            <td><?= h($usuario->correo) ?></td>
        </tr>
        <div class="spacer10"></div>
        <tr>
            <th scope="row"><?= __('Rol') ?></th>
            <td><?= $usuario->has('role') ? $this->Html->link($usuario->role->tipo, ['controller' => 'Posee', 'action' => 'index', $usuario->role->tipo]) : '' ?></td>
            </table>
</div>
<br>
<?php 
 $edit = $this->Seguridad->getPermiso(20);
 $borrar = $this->Seguridad->getPermiso(18);
 if  (1 == $edit)
    echo  $this->Html->link('Modificar usuario',['action'=>'edit', $usuario->id],['class'=>'btn btn-info btn-medium float-right']);
 if (1 == $borrar)
    echo  $this->Form->postlink('Eliminar usuario', array('action' => 'delete', $usuario->id), array('confirm'=>'Se va a eliminar al usuario '. $usuario->nombre_usuario, 'class' => 'btn btn-info btn-medium float-right mr-3')) ;

?>
   

    <?= $this->Html->link('Regresar',['action'=>'index'],['class'=>'btn btn-info btn-medium float-right mr-3'])?>