<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contador[]|\Cake\Collection\CollectionInterface $contador
 */
?>
<div class="contador index large-9 medium-8 columns content">
    <h3><?= __('Contador') ?></h3>
    <table id="contador-grid" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'Horas Asistente' ?></th>
                <th scope="col"><?= 'Horas Estudiante' ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contador as $contador): ?>
            <tr>
                <td><?= $this->Number->format($contador->horas_asistente) ?></td>
                <td><?= $this->Number->format($contador->horas_estudiante) ?></td>
                <td class="actions">
                <?= $this->Html->link(__('<span class="typcn typcn-pen"></span>'), ['action' => 'edit', $contador->id],['escape'=>false,'style'=>'font-size:22px;']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    $(document).ready( function () {
        $('#contador-grid').DataTable(
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