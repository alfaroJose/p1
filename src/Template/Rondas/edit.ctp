<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ronda $ronda
 */
?>

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
