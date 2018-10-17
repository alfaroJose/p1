<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo[]|\Cake\Collection\CollectionInterface $grupos
 */
?>
<div class="grupos index large-9 medium-8 columns content">
    <h3><?= __('Grupos') ?></h3>
    <table id="grupos-grid" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'Sigla' ?></th>
                <th scope="col"><?= 'Nombre' ?></th>
                <th scope="col"><?= 'Grupo' ?></th>
                <th scope="col"><?= 'Semestre' ?></th>
                <th scope="col"><?= 'Año' ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todo as $grupo): ?>
            <tr>
                <td><?= h($grupo->Cursos['sigla']) ?></td>
                <td><?= h($grupo->Cursos['nombre']) ?></td>
                <td><?= h($grupo->numero) ?></td>
                <td><?= h($grupo->semestre) ?></td>
                <td><?= h($grupo->año) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<span class="typcn typcn-pen"></span>'), ['action' => 'edit', $grupo->id],['escape'=>false,'style'=>'font-size:22px;']) ?>              

                    <?= $this->Form->postLink(__('<span class="typcn typcn-trash"></span>'), ['action' => 'delete', $grupo->id], ['confirm' => __('Por favor confirme si desea eliminar al grupo {0}', $grupo->numero),'style'=>'font-size:22px;','escape'=>false]) ?>



           
                </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <br>
    <?= $this->Html->link('Agregar grupo',['action'=>'add'],['class'=>'btn btn-info float-right'])?>
</div>

<script type="text/javascript">
    $(document).ready( function () {
        $('#grupos-grid').DataTable(
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
          }
        );
    } );
</script>