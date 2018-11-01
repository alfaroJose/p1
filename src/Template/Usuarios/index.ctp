<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Usuario[]|\Cake\Collection\CollectionInterface $usuarios
 */
?>

<div class="usuarios index large-9 medium-8 columns content">
    <h3><?= __('Usuarios') ?></h3>
    <table id="usuarios-grid" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'Nombre'?></th>
                <th scope="col"><?= 'Primer apellido' ?></th>
                <th scope="col"><?= 'Segundo apellido' ?></th>
                <th scope="col"><?= 'Rol' ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= h($usuario->nombre) ?></td>
                <td><?= h($usuario->primer_apellido) ?></td>
                <td><?= h($usuario->segundo_apellido) ?></td>
                <td><?= $usuario->has('role') ? $this->Html->link($usuario->role->tipo, ['controller' => 'Posee', 'action' => 'index', $usuario->role->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<span class="typcn typcn-info-large-outline"></span>'), ['action' => 'view', $usuario->id],['escape'=>false,'style'=>'font-size:22px;']) ?>
                    <?php $edit = $this->Seguridad->getPermiso(20);
                        if (1 == $edit){
                            echo $this->Html->link(__('<span class="typcn typcn-pen"></span>'), ['action' => 'edit', $usuario->id],['escape'=>false,'style'=>'font-size:22px;']) ;             
                        }
                    ?>
                    <?php $delete = $this->Seguridad->getPermiso(18);
                        if (1 == $delete){
                         echo $this->Form->postLink(__('<span class="typcn typcn-trash"></span>'), ['action' => 'delete', $usuario->id], ['confirm' => __('Se va a eliminar al usuario {0}', $usuario->nombre_usuario),'style'=>'font-size:22px;','escape'=>false]);
                        }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>    
    <br>
    <br>
    <?php $permisoAdd = $this->Seguridad->getPermiso(19);
    if(1 == $permisoAdd)
     echo $this->Html->link('Agregar usuario',['action'=>'add'],['class'=>'btn btn-info float-right mr-3']);
     ?>
</div>


<script type="text/javascript">
    $(document).ready( function () {
        $('#usuarios-grid').DataTable(
          {
            /** Configuración del DataTable para cambiar el idioma, se puede personalizar aun más **/
            "language": {
                "lengthMenu": "Mostrar _MENU_ filas por página",
                "zeroRecords": "Sin resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Sin datos disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "sSearch": "Buscar:",
                "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
            }
          }
        );
    } );
</script>