<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ronda $ronda
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Rondas'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="rondas form large-9 medium-8 columns content">
    <?= $this->Form->create($ronda) ?>
    <fieldset>
        <legend><?= __('Add Ronda') ?></legend>
        <?php
            echo $this->Form->control('numero');
            echo $this->Form->control('fecha_inicial');
            echo $this->Form->control('fecha_final');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>