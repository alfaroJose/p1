<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Curso $curso
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Curso'), ['action' => 'edit', $curso->sigla]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Curso'), ['action' => 'delete', $curso->sigla], ['confirm' => __('Are you sure you want to delete # {0}?', $curso->sigla)]) ?> </li>
        <li><?= $this->Html->link(__('List Cursos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Curso'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cursos view large-9 medium-8 columns content">
    <h3><?= h($curso->sigla) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Sigla') ?></th>
            <td><?= h($curso->sigla) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombre') ?></th>
            <td><?= h($curso->nombre) ?></td>
        </tr>
    </table>
</div>
