<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tiene[]|\Cake\Collection\CollectionInterface $tiene
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tiene'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requisitos'), ['controller' => 'Requisitos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Requisito'), ['controller' => 'Requisitos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tiene index large-9 medium-8 columns content">
    <h3><?= __('Tiene') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('solicitudes_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('requisitos_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('condicion') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tiene as $tiene): ?>
            <tr>
                <td><?= $tiene->has('solicitude') ? $this->Html->link($tiene->solicitude->id, ['controller' => 'Solicitudes', 'action' => 'view', $tiene->solicitude->id]) : '' ?></td>
                <td><?= $tiene->has('requisito') ? $this->Html->link($tiene->requisito->id, ['controller' => 'Requisitos', 'action' => 'view', $tiene->requisito->id]) : '' ?></td>
                <td><?= h($tiene->condicion) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tiene->solicitudes_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tiene->solicitudes_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tiene->solicitudes_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tiene->solicitudes_id)]) ?>
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
