<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo $grupo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Grupo'), ['action' => 'edit', $grupo->numero]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Grupo'), ['action' => 'delete', $grupo->numero], ['confirm' => __('Are you sure you want to delete # {0}?', $grupo->numero)]) ?> </li>
        <li><?= $this->Html->link(__('List Grupos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grupo'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="grupos view large-9 medium-8 columns content">
    <h3><?= h($grupo->numero) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Año') ?></th>
            <td><?= h($grupo->año) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cursos Sigla') ?></th>
            <td><?= h($grupo->cursos_sigla) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= $grupo->has('usuario') ? $this->Html->link($grupo->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $grupo->usuario->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= $this->Number->format($grupo->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Semestre') ?></th>
            <td><?= $this->Number->format($grupo->semestre) ?></td>
        </tr>
    </table>
</div>
