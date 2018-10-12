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
            echo $this->Form->control('numero',['label' => ['text' => 'Numero'],'type' => 'text' ]);
            echo $this->Form->control('semestre',['label' => ['text' => 'Sigla'],'type' => 'text' ]);
            echo $this->Form->control('año',['label' => ['text' => 'Año'],'type' => 'text' ]);
            echo $this->Form->control('cursos_sigla',['label' => ['text' => 'Sigla'],'type' => 'text' ]);
            echo ('<label> Profesor </label>');
            echo $this->Form->select('usuarios_id', $usuarios);
        ?>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>
