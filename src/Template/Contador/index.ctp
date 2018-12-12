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
                <th scope="col"><?= 'Horas Estudiante ECCI' ?></th>
                <th scope="col"><?= 'Horas Estudiante Docente' ?></th>
                <?php
                $permisoEditar = $this->Seguridad->getPermiso(22);
                if (1 == $permisoEditar){
                    echo '<th scope="col" class="actions">Acciones</th>';
                } 
                ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contador as $contador): ?>
            <tr>
                <td><?= $this->Number->format($contador->horas_asistente) ?></td>
                <td><?= $this->Number->format($contador->horas_estudiante_ecci) ?></td>
                <td><?= $this->Number->format($contador->horas_estudiante_docente) ?></td>
                <?php 
                if (1 == $permisoEditar){
                  echo '<td class="actions">';
                  echo $this->Html->link(__('<span class="typcn typcn-pen" title="Editar"></span>'), ['action' => 'edit', $contador->id],['escape'=>false,'style'=>'font-size:22px;']); 
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