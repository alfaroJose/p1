<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tiene $tiene
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tiene->solicitudes_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tiene->solicitudes_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tiene'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Solicitudes'), ['controller' => 'Solicitudes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Solicitude'), ['controller' => 'Solicitudes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Requisitos'), ['controller' => 'Requisitos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Requisito'), ['controller' => 'Requisitos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tiene form large-9 medium-8 columns content">
    <?= $this->Form->create($tiene) ?>
    <fieldset>
        <legend><?= __('Edit Tiene') ?></legend>
        <?php
            echo $this->Form->control('condicion');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
