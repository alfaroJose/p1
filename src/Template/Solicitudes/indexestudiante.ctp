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
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todo as $solicitude): ?>
            <tr>
                <?php
                /*
                $username = $this->request->getSession()->read('id');
                $idActual = $this->Solicitude->getIDEstudiante($username);
                $datosSolicitudes = $this->Solicitude->getIndexValuesEstudiante($idActual[0]);
                */
                //debug($idActual[0]);
                //die();

                //debug($datosSolicitudes);
                //die();


                ?>
                <!--<td><?= $this->Number->format($solicitude->id) ?></td>
                <td><?= h($solicitude->carrera) ?></td>
                <td><?= $this->Number->format($solicitude->promedio) ?></td>
                <td><?= $this->Number->format($solicitude->cantidad_horas) ?></td>
                <td><?= h($solicitude->tipo_horas) ?></td>-->
                <td><?= h($solicitude[0]) ?></td>
                <td><?= h($solicitude[1]) ?></td>
                <td><?= h($solicitude[2]) ?></td>
                <td><?= h($solicitude[3]) ?></td>
                <td><?= h($solicitude[4]) ?></td>
                <td><?= h($solicitude[5]) ?></td>

                <td class="actions">
                <span class="typcn typcn-printer"></span>
                <?= $this->Html->link(__('<span class="typcn typcn-info-large-outline"></span>'), ['action' => 'view', $solicitude->id],['escape'=>false,'style'=>'font-size:22px;']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $solicitude->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $solicitude->id], ['confirm' => __('Are you sure you want to delete # {0}?', $solicitude->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <br>
    
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
