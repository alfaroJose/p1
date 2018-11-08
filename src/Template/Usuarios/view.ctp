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
<div class="row">

    <div class="col-md-6">
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
        </table>    
    </div>
    <br>
    <div class="col-md-6">
        <br> 
        <h5><?= "Datos de seguridad" ?></h5>
        <table class>    
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= h($usuario->nombre_usuario) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Correo') ?></th>
            <td><?= h($usuario->correo) ?></td>
        </tr>
            <!--<div class="spacer10"></div>-->
        <tr>
            <th scope="row"><?= __('Rol') ?></th>
            <td><?=h($usuario->role->tipo)?></td>
        </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?php 
            $edit = $this->Seguridad->getPermiso(20);
            $borrar = $this->Seguridad->getPermiso(18);
            if  (1 == $edit){
                echo  $this->Html->link('Modificar usuario',['action'=>'edit', $usuario->id],['class'=>'btn btn-info btn-medium float-right']);
            }
            if (1 == $borrar){
                echo  $this->Form->postlink('Eliminar usuario', array('action' => 'delete', $usuario->id), array('confirm'=>'Se va a eliminar al usuario '. $usuario->nombre_usuario, 'class' => 'btn btn-info btn-medium float-right mr-3'));
            }
        ?>  
        <?= $this->Html->link('Regresar',['action'=>'index'],['class'=>'btn btn-info btn-medium float-right mr-3'])?>
    </div>
</div>

