<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tiene $tiene
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tiene'), ['action' => 'edit', $tiene->solicitudes_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tiene'), ['action' => 'delete', $tiene->solicitudes_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tiene->solicitudes_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tiene'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tiene'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Requisitos'), ['controller' => 'Requisitos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Requisito'), ['controller' => 'Requisitos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tiene view large-9 medium-8 columns content">
    <h3><?= h($tiene->solicitudes_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Solicitude') ?></th>
            <td><?= $tiene->has('solicitude') ? $this->Html->link($tiene->solicitude->id, ['controller' => 'Solicitudes', 'action' => 'view', $tiene->solicitude->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Requisito') ?></th>
            <td><?= $tiene->has('requisito') ? $this->Html->link($tiene->requisito->id, ['controller' => 'Requisitos', 'action' => 'view', $tiene->requisito->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condicion') ?></th>
            <td><?= h($tiene->condicion) ?></td>
        </tr>
    </table>
</div>
