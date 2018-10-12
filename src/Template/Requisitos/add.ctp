<?php
$tipoRequisitos = array("Obligatorio", "Obligatorio inopia");
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisito $requisito
 */
?>
<div class="requisitos form large-9 medium-8 columns content">
    <?= $this->Form->create($requisito) ?>
    <fieldset>
        <legend><?= __('Agregar Requisito') ?></legend>
        <?php
            echo $this->Form->control('nombre',['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'label' => 'Descripcion', 'type'=> 'textarea']);
            echo $this->Form->control('tipo', ['templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>'],'options' => $tipoRequisitos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right'])?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3 btn-space'])?>
    <?= $this->Form->end() ?>
</div>