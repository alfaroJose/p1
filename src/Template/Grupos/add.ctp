<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo $grupo
 */
?>
<div class="grupos form large-9 medium-8 columns content">
    <?= $this->Form->create($grupo) ?>
    <fieldset>
        <legend><?= __('Agregar Grupo') ?></legend>
         <?php
            echo $this->Form->control('Sigla');
            echo $this->Form->control('Nombre');
            echo $this->Form->control('Grupo');
            echo $this->Form->control('Semestre');
            echo $this->Form->control('Año');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Cancelar')) ?>
    <?= $this->Form->button(__('Agregar')) ?>
    <?= $this->Form->end() ?>
</div>
