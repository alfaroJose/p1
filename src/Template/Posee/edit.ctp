<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Posee $posee
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $posee->permisos_modulo],
                ['confirm' => __('Are you sure you want to delete # {0}?', $posee->permisos_modulo)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Posee'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Roles'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Role'), ['controller' => 'Roles', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="posee form large-9 medium-8 columns content">
    <?= $this->Form->create($posee) ?>
    <fieldset>
        <legend><?= __('Edit Posee') ?></legend>
        <?php
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
