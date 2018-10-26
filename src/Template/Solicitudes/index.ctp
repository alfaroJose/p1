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
                <th scope="col"><?= 'id' ?></th>
                <th scope="col"><?= 'carrera' ?></th>
                <th scope="col"><?= 'promedio' ?></th>
                <th scope="col"><?= 'cantidad_horas' ?></th>
                <th scope="col"><?= 'tipo_horas' ?></th>
                <th scope="col"><?= 'estado' ?></th>
                <th scope="col"><?= 'asistencia_externa' ?></th>
                <th scope="col"><?= 'cantidad_horas_externa' ?></th>
                <th scope="col"><?= 'tipo_horas_externa' ?></th>
                <th scope="col"><?= 'fecha' ?></th>
                <th scope="col"><?= 'justificación' ?></th>
                <th scope="col"><?= 'ronda' ?></th>
                <th scope="col"><?= 'usuarios_id' ?></th>
                <th scope="col"><?= 'grupos_id' ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitude): ?>
            <tr>
                <td><?= $this->Number->format($solicitude->id) ?></td>
                <td><?= h($solicitude->carrera) ?></td>
                <td><?= $this->Number->format($solicitude->promedio) ?></td>
                <td><?= $this->Number->format($solicitude->cantidad_horas) ?></td>
                <td><?= h($solicitude->tipo_horas) ?></td>
                <td><?= h($solicitude->estado) ?></td>
                <td><?= h($solicitude->asistencia_externa) ?></td>
                <td><?= $this->Number->format($solicitude->cantidad_horas_externa) ?></td>
                <td><?= h($solicitude->tipo_horas_externa) ?></td>
                <td><?= h($solicitude->fecha) ?></td>
                <td><?= h($solicitude->justificación) ?></td>
                <td><?= $this->Number->format($solicitude->ronda) ?></td>
                <td><?= $solicitude->has('usuario') ? $this->Html->link($solicitude->usuario->id, ['controller' => 'Usuarios', 'action' => 'view', $solicitude->usuario->id]) : '' ?></td>
                <td><?= $solicitude->has('grupo') ? $this->Html->link($solicitude->grupo->id, ['controller' => 'Grupos', 'action' => 'view', $solicitude->grupo->id]) : '' ?></td>
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