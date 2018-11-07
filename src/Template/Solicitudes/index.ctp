<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude[]|\Cake\Collection\CollectionInterface $solicitudes
 */
?>
<div class="solicitudes index large-9 medium-8 columns content">
    <h3><?= __('Solicitudes') ?></h3>
    <table id="solicitudes-grid" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'Sigla' ?></th>
                <th scope="col"><?= 'Nombre' ?></th>
                <th scope="col"><?= 'Grupo' ?></th>
                <th scope="col"><?= 'Profesor' ?></th>
                <th scope="col"><?= 'Estudiante' ?></th>
                <th scope="col"><?= 'Estado' ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            
            <?php foreach ($todo as $solicitude): //datos para el index?>
            <tr>
                <td><?= h($solicitude[0]) ?></td>
                <td><?= h($solicitude[1]) ?></td>
                <td><?= h($solicitude[2]) ?></td>
                <td><?= h($solicitude[3]) ?></td>
                <td><?= h($solicitude[4]) ?></td>
                <td><?= h($solicitude[5]) ?></td>
                <td class="actions">
                <?php if(1 == $rolActual[0]){//Agrega el boton para ir a verificar requisitos solo para el admin
                echo $this->Html->link(__('<span class="typcn typcn-social-instagram-circular"></span>'), ['action' => 'view', $solicitude[6]],['escape'=>false,'style'=>'font-size:22px;']);}
                //debug($todo);
                //die();
                ?>
                <span class="typcn typcn-printer"></span>
                <?= $this->Html->link(__('<span class="typcn typcn-info-large-outline"></span>'), ['action' => 'view', $solicitude[6]],['escape'=>false,'style'=>'font-size:22px;']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody> 
    </table>    
    <br>
    <br>
    <?php //Agrega el boton de nueva solicitud solo al index de estudiante
    if(4 == $rolActual[0] && $estado)
     echo $this->Html->link('Agregar solicitud',['action'=>'add'],['class'=>'btn btn-info float-right mr-3']);
     ?>
</div>
<script type="text/javascript">
    $(document).ready( function () {
        $('#solicitudes-grid').DataTable(
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
