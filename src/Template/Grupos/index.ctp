<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo[]|\Cake\Collection\CollectionInterface $grupos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Grupo'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="grupos index large-9 medium-8 columns content">
    <h3><?= __('Grupos') ?></h3>
    <table id="grupos-grid" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'Sigla' ?></th>
                <th scope="col"><?= 'Nombre' ?></th>
                <th scope="col"><?= 'Grupo' ?></th>
                <th scope="col"><?= 'Semestre' ?></th>
                <th scope="col"><?= 'Año' ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grupos as $grupo): ?>
            <tr>
                <td><?= h($usuario->nombre) ?></td>
                <td><?= h($usuario->primer_apellido) ?></td>
                <td><?= h($usuario->segundo_apellido) ?></td>
                <td><?= $usuario->has('role') ? $this->Html->link($usuario->role->id, ['controller' => 'Roles', 'action' => 'view', $usuario->role->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<span class="typcn typcn-info-large-outline"></span>'), ['action' => 'view', $usuario->id],['escape'=>false,'style'=>'font-size:22px;']) ?>
                    <?= $this->Html->link(__('<span class="typcn typcn-pen"></span>'), ['action' => 'edit', $usuario->id],['escape'=>false,'style'=>'font-size:22px;']) ?>              

                    <?= $this->Form->postLink(__('<span class="typcn typcn-trash"></span>'), ['action' => 'delete', $usuario->id], ['confirm' => __('Por favor confirme si desea eliminar la matrícula nº {0}', $usuario->id),'style'=>'font-size:22px;','escape'=>false]) ?>

</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready( function () {
        $('#grupos-grid').DataTable(
          {
            /** Configuración del DataTable para cambiar el idioma, se puede personalisar aun más **/
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