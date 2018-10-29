<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Solicitude'), ['action' => 'edit', $solicitude->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Solicitude'), ['action' => 'delete', $solicitude->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solicitude->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Solicitude'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Grupos'), ['controller' => 'Grupos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Grupo'), ['controller' => 'Grupos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="solicitudes view large-9 medium-8 columns content">
    <h3><?= h($solicitude->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Carrera') ?></th>
            <td><?= h($solicitude->carrera) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo Horas') ?></th>
            <td><?= h($solicitude->tipo_horas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($solicitude->estado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Asistencia Externa') ?></th>
            <td><?= h($solicitude->asistencia_externa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Tipo Horas Externa') ?></th>
            <td><?= h($solicitude->tipo_horas_externa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Justificación') ?></th>
            <td><?= h($solicitude->justificación) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Usuario') ?></th>
            <td><?= $solicitude->has('usuario') ? $this->Html->link($solicitude->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $solicitude->usuario->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Grupo') ?></th>
            <td><?= $solicitude->has('grupo') ? $this->Html->link($solicitude->grupo->id, ['controller' => 'Grupos', 'action' => 'view', $solicitude->grupo->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($solicitude->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Promedio') ?></th>
            <td><?= $this->Number->format($solicitude->promedio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cantidad Horas') ?></th>
            <td><?= $this->Number->format($solicitude->cantidad_horas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cantidad Horas Externa') ?></th>
            <td><?= $this->Number->format($solicitude->cantidad_horas_externa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ronda') ?></th>
            <td><?= $this->Number->format($solicitude->ronda) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($solicitude->fecha) ?></td>
        </tr>
    </table>
</div>
