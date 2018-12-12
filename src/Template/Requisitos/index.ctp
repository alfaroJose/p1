<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Requisito[]|\Cake\Collection\CollectionInterface $requisitos
 */
?>
<div class="requisitos index large-9 medium-8 columns content">
    <h3><?= __('Requisitos') ?></h3>
    <table id="requisitos-grid" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'Requisito' ?></th>
                <th scope="col"><?= 'Tipo' ?></th>
                <th scope="col"><?= 'Categoria' ?></th>
                <?php 
                    $edit = $this->Seguridad->getPermiso(8);
                    $borrar = $this->Seguridad->getPermiso(6);
                    $add = $this->Seguridad->getPermiso(7);
                    if(1 == $borrar || 1 == $edit)
                    echo '<th scope="col" class="actions">Acciones</th>';
                ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($requisitos as $requisito): ?>
            <tr>
                <td><?= h($requisito->nombre) ?></td>
                <td><?= h($requisito->tipo) ?></td>
                <td><?= h($requisito->categoria) ?></td>               
                <?php 
                 if(1 == $borrar || 1 == $edit){
                   echo '<td class="actions">';
                   if(1 == $edit)
                    echo $this->Html->link(__('<span class="typcn typcn-pen" title="Editar"></span>'), ['action' => 'edit', $requisito->id],['escape'=>false,'style'=>'font-size:22px;']);
                   if (1 == $borrar) 
                    echo $this->Form->postLink(__('<span class="typcn typcn-trash" title="Borrar"></span>'), ['action' => 'delete', $requisito->id], ['confirm' => __('Se va a eliminar el siguiente requisito: \n \n{0}', $requisito->nombre),'style'=>'font-size:22px;','escape'=>false]);
                   echo '</td>';

                 }
               
                ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <?php 
        if (1 == $add)
            echo $this->Html->link('Agregar requisito',['action'=>'add'],['class'=>'btn btn-info float-right']);
    ?>
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
            });
    });
</script>