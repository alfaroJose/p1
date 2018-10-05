<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisito[]|\Cake\Collection\CollectionInterface $requisitos
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Requisito'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="requisitos index large-9 medium-8 columns content">
    <h3><?= __('Requisitos') ?></h3>
    <table id="requisitos-grid" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'Requisito' ?></th>
                <th scope="col"><?= 'Tipo' ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requisitos as $requisito): ?>
            <tr>
                <td><?= h($requisito->nombre) ?></td>
                <td><?= h($requisito->tipo) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<span class="typcn typcn-info-large-outline"></span>'), ['action' => 'view', $requisito->numero],['escape'=>false,'style'=>'font-size:22px;'])?>
                    <?= $this->Html->link(__('<span class="typcn typcn-pen"></span>'), ['action' => 'edit', $requisito->numero],['escape'=>false,'style'=>'font-size:22px;']) ?>
                    <?= $this->Form->postLink(__('<span class="typcn typcn-trash"></span>'), ['action' => 'delete', $requisito->numero], ['confirm' => __(
                        'Desea eliminar el siguiente requisito?
                        Aqui el requisito', $requisito->nombre),'style'=>'font-size:22px;','escape'=>false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready( function () {
        $('#requisitos-grid').DataTable(
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