<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Posee $posee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Posee'), ['action' => 'edit', $posee->permisos_modulo]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Posee'), ['action' => 'delete', $posee->permisos_modulo], ['confirm' => __('Are you sure you want to delete # {0}?', $posee->permisos_modulo)]) ?> </li>
        <li><?= $this->Html->link(__('List Posee'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Posee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="posee view large-9 medium-8 columns content">
    <h3><?= h($posee->permisos_modulo) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Permisos Modulo') ?></th>
            <td><?= h($posee->permisos_modulo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Permisos Funcionalidad') ?></th>
            <td><?= h($posee->permisos_funcionalidad) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $posee->has('role') ? $this->Html->link($posee->role->id, ['controller' => 'Roles', 'action' => 'view', $posee->role->id]) : '' ?></td>
        </tr>
    </table>
</div>
