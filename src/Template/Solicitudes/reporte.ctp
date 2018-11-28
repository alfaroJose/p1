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




        

        <h4> Generar reporte de asistencias por estudiante <h4>
            
        <?php
        //debug ($estudiantesUsuarios);
        //die();
        echo $this->Form->control('Carné', ['templates'=> ['inputContainer'=>'<div class="row col-xs-6 col-sm-6 col-md-6 col-lg-6">{{content}}</div><br>'], 'options' => $carnet/*, 'default'=>$uno*/]);

        ?>

        <?= $this->Form->button(__('Generar reporte Estudiante'),['class'=>'btn btn-info float-left']) ?>
        <br>
        <br>
        <br>

<div>

        <h4> Generar reporte de asistencias por ronda </h4>
            
        <?php
        //debug ($estudiantesUsuarios);
        //die();

        $numeroRonda = array('1' => '1', '2' => '2', '3' => '3');

        echo $this->Form->control('Ronda', ['templates'=> ['inputContainer'=>'<div class="row col-xs-6 col-sm-6 col-md-6 col-lg-6">{{content}}</div><br>'], 'options' => $numeroRonda, 'type'=> 'select']);

        ?>

        <?= $this->Html->link('Generar reporte por rondas',['action'=>'generaRonda'],['class'=>'btn btn-info btn-medium float-left mr-3']) ?>

        <br>
        <br>
        <br>
    </div>

    <div>



        <h4> Generar reporte histórico de asistencias </h4>

        <?= $this->Html->link('Generar reporte Completo',['action'=>'generatodo'],['class'=>'btn btn-info btn-medium float-left mr-3'])// $this->Html->link('Generar reporte por rondas',['action'=>'reporteRonda'],['class'=>'btn btn-info btn-medium float-right mr-3'])?>



</div>
        <?= $this->Html->link('Regresar', ['controller'=>'Solicitudes','action'=>'index'], ['class'=>'btn btn-info float-right mr-3'])?>

    <?= $this->Form->end() ?>

</div>
