<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $report
 */
?>
<style> 
table th, td{
    border: 1px solid #ddd;
    text-align: left;
    padding :10px;
}
tr:nth-child(even) {background-color:  #eaecee };
</style>

<div class="reporte index large-9 medium-8 columns content">
    <?= $this->Form->create($solicitude) ?>


        <?= $this->Html->link('Generar reporte por rondas',['action'=>'index'],['class'=>'btn btn-info btn-medium float-right mr-3'])?>

        <?= $this->Html->link('Generar reporte Completo',['action'=>'generatodo'],['class'=>'btn btn-info btn-medium float-right mr-3'])?>

        

        <h4> Generar reporte de asistencias por estudiante <h4>
            
        <?php
        //debug ($estudiantesUsuarios);
        //die();
        echo $this->Form->control('Carné', ['templates'=> ['inputContainer'=>'<div class="row col-xs-6 col-sm-6 col-md-6 col-lg-6">{{content}}</div><br>'], 'options' => $carnet/*, 'default'=>$uno*/]);

        ?>

        <?= $this->Form->button(__('Generar'),['class'=>'btn btn-info float-left']) ?>

    <?= $this->Form->end() ?>

</div>
