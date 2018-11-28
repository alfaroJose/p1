<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisito $requisito
 */
 ?>

<div class="requisitos form large-9 medium-8 columns content">
    <?= $this->Form->create($requisito) ?>
    <fieldset>
        <legend><?= __('Editar Requisito') ?></legend>
        <?php
            echo $this->Form->control('nombre', ['label' => 'Descripción', 'type'=> 'textarea']);
            echo $this->Form->control('tipo', ['options' =>["Obligatorio" => 'Obligatorio', "Obligatorio Inopia" => 'Obligatorio Inopia'], 'value' => $requisito['tipo']]);
            echo $this->Form->control('categoria', ['options' =>["Horas Asistente" => 'Horas Asistente', "Horas Estudiante" => 'Horas Estudiante', "General" => 'General'], 'value'=> $requisito['categoria']]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right'])?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3 btn-space'])?>
    <?= $this->Form->end() ?>
</div>
