<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ronda $ronda
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ronda'), ['action' => 'edit', $ronda->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ronda'), ['action' => 'delete', $ronda->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ronda->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rondas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ronda'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rondas view large-9 medium-8 columns content">
    <h3><?= h($ronda->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ronda->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= $this->Number->format($ronda->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Inicial') ?></th>
            <td><?= h($ronda->fecha_inicial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Final') ?></th>
            <td><?= h($ronda->fecha_final) ?></td>
        </tr>
    </table>
</div>
