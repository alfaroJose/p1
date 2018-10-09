<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ronda[]|\Cake\Collection\CollectionInterface $rondas
 */
?>

<div class="rondas index large-9 medium-8 columns content">
    <h3><?= __('Rondas') ?></h3>
    <table id="rondas-grid" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'Numero' ?></th>
                <th scope="col"><?= 'Fecha Inicio' ?></th>
                <th scope="col"><?= 'Fecha Fin' ?></th>
                <th scope="col" class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rondas as $ronda): ?>
            <tr>
                <td><?= $this->Number->format($ronda->numero) ?></td>
                <td><?= h($ronda->fecha_inicial) ?></td>
                <td><?= h($ronda->fecha_final) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<span class="typcn typcn-pen"></span>'), ['action' => 'edit', $ronda->numero],['escape'=>false,'style'=>'font-size:22px;']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


<script type="text/javascript">
    $(document).ready( function () {
        $('#rondas-grid').DataTable(
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
