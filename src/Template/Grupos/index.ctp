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
                <th scope="col"><?= 'numero' ?></th>
                <th scope="col"><?= $this->Paginator->sort('semestre') ?></th>
                <th scope="col"><?= $this->Paginator->sort('año') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cursos_sigla') ?></th>
                <th scope="col"><?= $this->Paginator->sort('usuarios_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grupos as $grupo): ?>
            <tr>
                <td><?= $this->Number->format($grupo->numero) ?></td>
                <td><?= $this->Number->format($grupo->semestre) ?></td>
                <td><?= h($grupo->año) ?></td>
                <td><?= h($grupo->cursos_sigla) ?></td>
                <td><?= $grupo->has('usuario') ? $this->Html->link($grupo->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $grupo->usuario->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<span class="typcn typcn-document"></span>'), ['action' => 'view', $grupo->numero]) ?>
                    <?= $this->Html->link(__('<span class="typcn typcn-pen"></span>'), ['action' => 'edit', $grupo->numero]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $grupo->numero], ['confirm' => __('Are you sure you want to delete # {0}?', $grupo->numero)]) ?>
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