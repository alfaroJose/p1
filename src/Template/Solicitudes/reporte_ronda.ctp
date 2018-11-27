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

        

        <h4> Generar reporte de asistencias por ronda <h4>
            
        <?php
        //debug ($estudiantesUsuarios);
        //die();

        $numeroRonda = array('1' => '1', '2' => '2', '3' => '3');

        echo $this->Form->control('Ronda', ['templates'=> ['inputContainer'=>'<div class="row col-xs-6 col-sm-6 col-md-6 col-lg-6">{{content}}</div><br>'], 'options' => $numeroRonda, 'type'=> 'select']);

        ?>

        <?= $this->Form->button(__('Generar'),['class'=>'btn btn-info float-left']) ?>

    <?= $this->Form->end() ?>

</div>
