<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
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
<div class="row">

    <div class="col-md-6">
    <br>
    <h5><?= 'Excel Generado Correctamente' //para la vista?></h5>
    <?= $this->Html->link('Aceptar',['action'=>'index'],['class'=>'btn btn-info btn-medium float-right mr-3'])?>
</div>
<br>
<br>
<br>
<br>
<br>