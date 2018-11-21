<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude[]|\Cake\Collection\CollectionInterface $solicitudes
 */
?>
<div class="solicitudes index large-9 medium-8 columns content">
    <h3><?= __('Grupos Sin Asistente') ?></h3>
    <table id= "grupos-sin-asistente" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'Sigla' ?></th>
                <th scope="col"><?= 'Grupo' ?></th>
                <th scope="col"><?= 'Profesor' ?></th>
                <th scope="col" class="actions"><?= __('Asignar') ?></th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach ($tabla as $grupo): //datos para el index?>
            <tr>
                <td><?= h($grupo['sigla']) ?></td>
                <td><?= h($grupo['grupo']) ?></td>
                <td><?= h($grupo['profesor']) ?></td>
                <td class="actions">
                <?= $this->Html->link(__('<span class="typcn typcn-arrow-right-outline"></span>'), ['action' => 'asignarAsistente',$grupo['sigla'],$grupo['grupo'],$grupo['profesor'], $grupo['id']],['escape'=>false,'style'=>'font-size:22px;']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody> 
    </table>    
    <br>
    <br>
    <?php //Agrega el boton para regresar
         echo $this->Html->link('Regresar', ['action'=>'index'], ['class'=>'btn btn-info float-right mr-3']);
     ?>

</div>
<script type="text/javascript">
    $(document).ready( function () {
        $('#grupos-sin-asistente').DataTable(
          {
            /** Configuración del DataTable para cambiar el idioma, se puede personalizar aun más **/
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
          }
        );
    } );
</script>