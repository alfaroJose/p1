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

<div class="reporte index large-9 medium-8 columns content">
	<?= $this->Form->create($solicitude) ?>
    <h3><?= __('Reporte') ?></h3>
    <table id="reporte-grid" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'Curso' ?></th>
                <th scope="col"><?= 'Sigla' ?></th>
                <th scope="col"><?= 'Grupo' ?></th>
                <th scope="col"><?= 'Profesor' ?></th>
                <th scope="col"><?= 'Carné' ?></th>
                <th scope="col"><?= 'Nombre' ?></th>
                <th scope="col"><?= 'Tipo Horas' ?></th>
                <th scope="col"><?= 'Cantidad' ?></th>
                <th scope="col"><?= 'id' ?></th>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todo as $solicitud): ?>
            	<?php //debug($solicitud) ?>
            <tr>
                <td><?= h($solicitud['nombre']) ?></td> 
                <td><?= h($solicitud['sigla']) ?></td>  
                <td><?= h($solicitud['numero']) ?></td>
                <td><?= h($solicitud['profesor']) ?></td>
                <td><?= h($solicitud['nombre_usuario']) ?></td>
                <td><?= h($solicitud['estudiante']) ?></td> 
				<td><?= h($solicitud['tipo_horas']) ?></td>
                <td><?= h($solicitud['cantidad_horas']) ?></td>
                <td><?= h($solicitud['identificador']) ?></td>                          
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    
     <button type="submit" class="btn btn-info float-right">Aceptar</button>
    <?= $this->Html->link('Cancelar', ['controller'=>'Solicitudes','action'=>'index'], ['class'=>'btn btn-info float-right mr-3'])?>
    <?= $this->Form->end() ?>
</div>

<script type="text/javascript">
    $(document).ready( function () {
        $('#reporte-grid').DataTable(
            {
            /** Configuración del DataTable para cambiar el idioma, se puede personalisar aun más **/
            "language": {
                "lengthMenu": "Mostrar _MENU_ filas por página",
                "zeroRecords": "Sin resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Sin datos disponibles",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "sSearch": "Buscar:",
                "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                }
            });
    });
</script>