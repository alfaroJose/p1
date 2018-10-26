<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude[]|\Cake\Collection\CollectionInterface $solicitudes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Solicitude'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grupos'), ['controller' => 'Grupos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grupo'), ['controller' => 'Grupos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solicitudes index large-9 medium-8 columns content">
    <h3><?= __('Solicitudes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('carrera') ?></th>
                <th scope="col"><?= $this->Paginator->sort('promedio') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cantidad_horas') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipo_horas') ?></th>
                <th scope="col"><?= $this->Paginator->sort('estado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asistencia_externa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cantidad_horas_externa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('tipo_horas_externa') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha') ?></th>
                <th scope="col"><?= $this->Paginator->sort('justificación') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ronda') ?></th>
                <th scope="col"><?= $this->Paginator->sort('usuarios_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('grupos_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitude): ?>
            <tr>
                <td><?= $this->Number->format($solicitude->id) ?></td>
                <td><?= h($solicitude->carrera) ?></td>
                <td><?= $this->Number->format($solicitude->promedio) ?></td>
                <td><?= $this->Number->format($solicitude->cantidad_horas) ?></td>
                <td><?= h($solicitude->tipo_horas) ?></td>
                <td><?= h($solicitude->estado) ?></td>
                <td><?= h($solicitude->asistencia_externa) ?></td>
                <td><?= $this->Number->format($solicitude->cantidad_horas_externa) ?></td>
                <td><?= h($solicitude->tipo_horas_externa) ?></td>
                <td><?= h($solicitude->fecha) ?></td>
                <td><?= h($solicitude->justificación) ?></td>
                <td><?= $this->Number->format($solicitude->ronda) ?></td>
                <td><?= $solicitude->has('usuario') ? $this->Html->link($solicitude->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $solicitude->usuario->id]) : '' ?></td>
                <td><?= $solicitude->has('grupo') ? $this->Html->link($solicitude->grupo->id, ['controller' => 'Grupos', 'action' => 'view', $solicitude->grupo->id]) : '' ?></td>
                <td class="actions">
                <?= $this->Html->link_('<span class="typcn typcn-printer"></span>'), ['action' =>'Generate', $solicitude->id] ?>
                <?= $this->Html->link(__('<span class="typcn typcn-info-large-outline"></span>'), ['action' => 'view', $solicitude->id],['escape'=>false,'style'=>'font-size:22px;']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $solicitude->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $solicitude->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solicitude->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
<script type="text/javascript">
    $(document).ready( function () {
        $('#solicitudes-grid').DataTable(
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