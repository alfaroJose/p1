<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Posee[]|\Cake\Collection\CollectionInterface $posee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Posee'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="posee index large-9 medium-8 columns content">
    <h3><?= __('Posee') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('permisos_modulo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('permisos_funcionalidad') ?></th>
                <th scope="col"><?= $this->Paginator->sort('roles_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posee as $posee): ?>
            <tr>
                <td><?= h($posee->permisos_modulo) ?></td>
                <td><?= h($posee->permisos_funcionalidad) ?></td>
                <td><?= $posee->has('role') ? $this->Html->link($posee->role->id, ['controller' => 'Roles', 'action' => 'view', $posee->role->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $posee->permisos_modulo]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $posee->permisos_modulo]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $posee->permisos_modulo], ['confirm' => __('Are you sure you want to delete # {0}?', $posee->permisos_modulo)]) ?>
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
