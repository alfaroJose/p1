<h3>Asignar Asistente</h3>
<h4>
<?= $sigla."&nbsp"."Grupo ".$numGrupo."&nbsp"."Prof: ".$profe?>
</h4>

<div class="solicitudes index large-9 medium-8 columns content">
    <h3><?= __('Tabla de Estudiantes') ?></h3>
    <table id= "tabla-estudiantes" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= 'Nombre' ?></th>
                <th scope="col"><?= 'HE Asignadas' ?></th>
                <th scope="col"><?= 'HA Asignadas' ?></th>

                <th scope="col"><?= 'Estado' ?></th>
                <th scope="col"><?= 'Tipo de horas' ?></th>
                <th scope="col"><?= 'Cantidad' ?></th>

            </tr>
        </thead>
        <tbody>
            
            <?php foreach ($estudiantes as $nombres): //datos para el index?>
            <tr>
            <td><?= h($nombres) ?></td>

                <td> <?= $this->Form->control('', ['label' => 'Promedio', 'pattern'=>"[0-9]{0,2}", 'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-4">{{content}}</div><br>']]);?> </td>
            

            </tr>
            <?php endforeach; ?>
        </tbody> 
    </table>    
    <br>
    <br>
    <?php //Agrega el boton para regresar
         echo $this->Html->link('Regresar', ['action'=>'index'], ['class'=>'btn btn-info float-right mr-3']);
     ?>
</div>

<br>


<div class="col-lg-3 col-md-3 float-left mr-3" id="wrapper">
		<label for="Seleccion"> <b>Selecciones un Estudiante</b></label>
		<?= $this->Form->select("Seleccion", $estudiantes, ["id" => "seleccion", "empty" => true] ); ?>	
</div>
<script type="text/javascript">
    $(document).ready( function () {
        $('#tabla-estudiantes').DataTable(
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




 <?php //Agrega el boton para regresar
         echo $this->Html->link('Regresar', ['action'=>'grupoAsignar'], ['class'=>'btn btn-info float-right mr-3']);
  ?>