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
                <th scope="col"><?= 'Curso' ?></th>
                <th scope="col"><?= 'Grupo' ?></th>
                <th scope="col"><?= 'Semestre' ?></th>
                <th scope="col"><?= 'Año' ?></th>
                <?php
                 $permisoEdit = $this->Seguridad->getPermiso(4);
                 $permisoDelete = $this->Seguridad->getPermiso(2);
                 $permisoAdd = $this->Seguridad->getPermiso(3);
                 if (1 == $permisoEdit || 1 == $permisoDelete){
                    echo '<th scope="col" class="actions">Acciones</th>';
                }
                ?>
                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todo as $grupo): ?>
                <?php ?>
            <tr>
                <td><?= h($grupo->Cursos['sigla']) ?></td>
                <td><?= h($grupo->Cursos['nombre']) ?></td>
                <td><?= h($grupo->numero) ?></td>
                <td><?= h($grupo->semestre) ?></td>
                <td><?= h($grupo->año) ?></td>
                <?php 
                if (1 == $permisoEdit || 1 == $permisoDelete){
                    echo '<td class="actions">';

                    if (1 == $permisoEdit)
                        echo $this->Html->link(__('<span class="typcn typcn-pen"></span>'), ['action' => 'edit', $grupo->id, $grupo->Cursos['id'], $grupo->Usuarios['id']],['escape'=>false,'style'=>'font-size:22px;']);              
                    if (1 == $permisoDelete){
                        echo $this->Form->postLink(__('<span class="typcn typcn-trash"></span>'), ['action' => 'delete', $grupo->id], ['confirm' => __('Por favor confirme si desea eliminar al grupo {0}', $grupo->numero),'style'=>'font-size:22px;','escape'=>false]);
                    }
                   echo '</td>';
                }
                
                ?>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <br>
    <?php
    if (1 == $permisoAdd){
        echo $this->Html->link(__('Agregar curso'),['action'=>'addCurso',$grupo->id, $grupo->Cursos['id'], $grupo->Usuarios['id']],['class'=>'btn btn-info float-right']);
        echo $this->Html->link('Agregar grupo',['action'=>'add',$grupo->id, $grupo->Cursos['id'], $grupo->Usuarios['id']],['class'=>'btn btn-info float-right mr-3']);
    }
        ?>
         <button id="butExcel" class="btn btn-info float-right mr-3">Cargar Archivo</button>

        <div id="Subir archivo" class="modal">
            <div class="modal-content">
                <div class="files form large-9 medium-8 columns content">
                    <?= $this->Form->create(null, ['type' => 'file', 'url' => '/Grupos/uploadFile']) ?>
                <fieldset>
                <legend><?= __('Seleccione el archivo') ?></legend>
                <?php
                    echo $this->Form->control('file', ['label'=>['text'=>''], 'type' => 'file']);
                ?>
            </fieldset>
            <button type="submit" class="btn btn-info float-right">Aceptar</button>
            <button id="butCanc" type="reset" class="btn btn-secondary float-right mr-3">Cancelar</button>
        
            <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
 
</div>

<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    /* Fondo del modal */
    .modal {
        display: none; 
        position: fixed;
        z-index: 1;
        padding-top: 100px; /*Posición del modal */
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: auto; /* En caso de ser necesario se puede hacer scroll */
        background-color: rgb(0,0,0); /* Color del fondo */
        background-color: rgba(0,0,0,0.4); /* Color con transparencia */
    }

    /* Contenido del modal */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>

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

    // Recupera el modal
var modal = document.getElementById('Subir archivo');

// Recupera el botón que abre el modal
var btn = document.getElementById("butExcel");

// Recupera el botón que cierra el modal
var span = document.getElementById("butCanc");

// Cuando se hace click, se abre el modal
btn.onclick = function() {
    modal.style.display = "block";
}

// Cuando se hace click se cierra el modal
span.onclick = function() {
    modal.style.display = "none";
}

// Cuando se hace click fuera del modal este se cierra
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>