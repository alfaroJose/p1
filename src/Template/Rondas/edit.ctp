<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ronda $ronda
 */
?>

<div class="rondas form large-9 medium-8 columns content">
    <?= $this->Form->create($ronda) ?>
    <fieldset>
        <legend><?= __('Editar Ronda') ?></legend>
        <?php
            echo $this->Form->control('fecha_inicial');
            echo $this->Form->control('fecha_final');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right'])?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3 btn-space'])?>
    <?= $this->Form->end() ?>
</div>
