<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $solicitude->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $solicitude->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Usuarios'), ['controller' => 'Usuarios', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Usuario'), ['controller' => 'Usuarios', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Grupos'), ['controller' => 'Grupos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Grupo'), ['controller' => 'Grupos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="solicitudes form large-9 medium-8 columns content">
    <?= $this->Form->create($solicitude) ?>
    <fieldset>
        <legend><?= __('Edit Solicitude') ?></legend>
        <?php
            echo $this->Form->control('carrera');
            echo $this->Form->control('promedio');
            echo $this->Form->control('cantidad_horas');
            echo $this->Form->control('estado');
            echo $this->Form->control('asistencia_externa');
            echo $this->Form->control('cantidad_horas_externa');
            echo $this->Form->control('tipo_horas_externa');
            echo $this->Form->control('fecha');
            echo $this->Form->control('justificación');
            echo $this->Form->control('ronda');
            echo $this->Form->control('usuarios_id', ['options' => $usuarios]);
            echo $this->Form->control('grupos_id', ['options' => $grupos]);
            echo $this->Form->control('horas_asistente');
            echo $this->Form->control('horas_estudiante');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
