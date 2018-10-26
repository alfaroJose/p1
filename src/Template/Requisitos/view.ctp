<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisito $requisito
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Requisito'), ['action' => 'edit', $requisito->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Requisito'), ['action' => 'delete', $requisito->id], ['confirm' => __('Are you sure you want to delete # {0}?', $requisito->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Requisitos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Requisito'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="requisitos view large-9 medium-8 columns content">
    <h3><?= h($requisito->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($requisito->nombre) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo') ?></th>
            <td><?= h($requisito->tipo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($requisito->id) ?></td>
        </tr>
    </table>
</div>