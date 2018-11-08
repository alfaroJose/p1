<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contador $contador
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Contador'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="contador form large-9 medium-8 columns content">
    <?= $this->Form->create($contador) ?>
    <fieldset>
        <legend><?= __('Add Contador') ?></legend>
        <?php
            echo $this->Form->control('horas_asistente');
            echo $this->Form->control('horas_estudiante');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
