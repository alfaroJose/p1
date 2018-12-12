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
                <th scope="col"><?= 'Número' ?></th>
                <th scope="col"><?= 'Fecha inicial' ?></th>
                <th scope="col"><?= 'Fecha final' ?></th>
                <?php 
                $edit = $this->Seguridad->getPermiso(12);
                if ( 1 == $edit)
                    echo '<th scope="col" class="actions">Acciones</th>';
                ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rondas as $ronda): ?>
            <tr>
                <td><?= $this->Number->format($ronda->numero) ?></td>
                <td><?= h($ronda->fecha_inicial) ?></td>
                <td><?= h($ronda->fecha_final) ?></td>
                <?php
                if ( 1 == $edit){
                    echo '<td class="actions">';
                    echo $this->Html->link(__('<span class="typcn typcn-pen" title="Editar"></span>'), ['action' => 'edit', $ronda->id],['escape'=>false,'style'=>'font-size:22px;']);
                    echo '</td>';
                }
                ?>
               
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

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