<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ronda $ronda
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ronda->numero],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ronda->numero)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Rondas'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="rondas form large-9 medium-8 columns content">
    <?= $this->Form->create($ronda) ?>
    <fieldset>
        <legend><?= __('Edit Ronda') ?></legend>
        <?php
            echo $this->Form->control('fecha_inicial');
            echo $this->Form->control('fecha_final');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
