<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contador $contador
 */
?>
<div class="contador form large-9 medium-8 columns content">
    <?= $this->Form->create($contador) ?>
    <fieldset>
        <legend><?= __('Editar Contador') ?></legend>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 40%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            echo $this->Form->control('horas_asistente', ['pattern'=>"[0-9]", 'label'=>['text'=>'Horas Asistente'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
            echo $this->Form->control('horas_estudiante_ecci', ['pattern'=>"[0-9]", 'label'=>['text'=>'Horas Estudiante ECCI'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
            echo $this->Form->control('horas_estudiante_docente', ['pattern'=>"[0-9]", 'label'=>['text'=>'Horas Estudiante Docente'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-10">{{content}}</div><br>']]);
        ?>
        </div>
    </fieldset>
    <br>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right'])?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3'])?>
    <?= $this->Form->end() ?>
</div>
