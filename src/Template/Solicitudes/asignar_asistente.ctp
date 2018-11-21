<h3>Asignar Asistente</h3>
<h4>
<?= $sigla."&nbsp"."Grupo ".$numGrupo."&nbsp"."Prof: ".$profe?>
</h4>
<br>
<div class="solicitudes index large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
        <fieldset>
            <h5><?= __('Tabla de Estudiantes') ?></h5>
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
                    
                    <?php 
                    $i = 0;
                    foreach ($estudiantes as $nombres): //datos para el index?>
                    <tr>
                        <td><?= h($nombres) ?></td>
                        <?php 
                            if($horasE[$i] == []){ //Si es null entonces no tiene horas asignadas
                                $horasE[$i] = 0; 
                            }
                        ?>
                        <td><?= h($horasE[$i]) ?></td>
                        <?php 
                        if($horasA[$i] == []){//Si es null entonces no tiene horas asignadas
                                $horasA[$i] = 0; 
                        }
                        ?>
                        <td><?= h($horasA[$i]) ?></td>
                        <td> <?= $this->Form->select('Estado'.$idEstudiante[$i],["Aceptada - Profesor" => 'Aceptada - Profesor', "Aceptada - Profesor (Inopia)" => 'Aceptada - Profesor (Inopia)', "Rechazada - Profesor" => 'Rechazada - Profesor' ], ['required'=>true ,"id" => 'Estado'.$idEstudiante[$i], "empty" => true, 'onclick'=> 'revisarEstado('.$idEstudiante[$i].')'] ); ?></td>
                        <td> <?= $this->Form->select('TipoHora'.$idEstudiante[$i],["Estudiante" => 'Estudiante', "Asistente" => 'Asistente'], ["id" => "TipoHora".$idEstudiante[$i], "empty" => true, 'disabled' => true] ); ?></td>
                        <td> <?= $this->Form->control('Horas'.$idEstudiante[$i], ['id' => "Horas".$idEstudiante[$i], 'label' => '', 'pattern'=>"[0-9]{1,2}", 'disabled' => true,'templates'=> ['inputContainer'=>'<div class="row col-xs-4 col-sm-4 col-md-4 col-lg-5">{{content}}</div>']]);?> </td>

                    </tr>
                    <?php 
                    $i++;
                    endforeach; ?>
                </tbody> 
            </table> 
        </fieldset>
   
    <br>
    <br>
   
    </div>
        <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
        <?= $this->Html->link('Cancelar', ['action'=>'grupoAsignar'], ['class'=>'btn btn-info float-right mr-3']) ?>
    <br>


     <?= $this->Form->end() ?>


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
<script>

    $(function(){
    $('div[onload]').trigger('onload');
    });

    function revisarEstado(id){

        estado = document.getElementById("Estado"+id).value;
        if(estado == "Aceptada - Profesor" || estado == "Aceptada - Profesor (Inopia)"){
            if(estado == "Aceptada - Profesor (Inopia)"){
               // document.getElementById("TipoHora"+id).value = "Estudiante";
                document.getElementById("TipoHora"+id).disabled = true;
            }
            else{
               // document.getElementById("TipoHora"+id).value = "";
                document.getElementById("TipoHora"+id).disabled = false;
            }
            document.getElementById("Horas"+id).disabled = false;
       }
       else{
            document.getElementById("TipoHora"+id).disabled = true;
            document.getElementById("Horas"+id).disabled = true;
            document.getElementById("TipoHora"+id).value = "";
            document.getElementById("Horas"+id).value = "";
       }
    }
</script>



