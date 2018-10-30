<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude[]|\Cake\Collection\CollectionInterface $solicitudes
 */
?>

<div class="index large-4 medium-4 medium-offset-4 medium-offset-4 columns">
    <?php echo "<center>";?>
        <h3>Modificar estado de asistencia de grupo</h3>
        <td class="Opciones">
            <?= $this->Form->control('sigla', ['type' => 'text', 'readonly', 'value' => $sigla, 'label'=>['text'=>'Sigla'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-4">{{content}}</div><br>']]); ?>

            <?= $this->Form->control('numeroGrupo', ['type' => 'text', 'readonly', 'value' => $numGrupo, 'label'=>['text'=>'Número de grupo'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-4">{{content}}</div><br>']]); ?>

            <?= $this->Form->control('semestre', ['type' => 'text', 'readonly', 'value' => $semestre, 'label'=>['text'=>'Semestre'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-4">{{content}}</div><br>']]); ?>

            <?= $this->Form->control('Año', ['type' => 'text', 'readonly', 'value' => $anno, 'label'=>['text'=>'Año'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-4">{{content}}</div><br>']]); ?>
            
            <?= $this->Form->control('SeleccionCarne', ['type' => 'select', 'options' => $opciones, 'label'=>['text'=>'Carné de asistente'], 'templates'=> ['inputContainer'=>'<div class="row col-xs-10 col-sm-10 col-md-10 col-lg-4">{{content}}</div><br>']]); ?>
        </td>
    <?php echo "</center>";?>
    <?= $this->Html->link('Cancelar',['action'=>'index'],['class'=>'btn btn-info float-right'])?>
    <?= $this->Form->submit('Guardar',['disabled' => true, 'id' => 'Guardar','class'=>'btn btn-info float-right mr-3'])?>
</div>