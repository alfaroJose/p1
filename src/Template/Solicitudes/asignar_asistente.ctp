<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude[]|\Cake\Collection\CollectionInterface $solicitudes
 */
?>

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
                    //debug($reqReprobados);
                    //die();
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

                        $options1 = array("Estudiante ECCI" => 'Estudiante ECCI', 'Estudiante Docente'=>'Estudiante Docente', "Asistente" => 'Asistente');

                        $options2 = array("Estudiante ECCI" => 'Estudiante ECCI', 'Estudiante Docente'=>'Estudiante Docente');

                        ?>
                        <td><?= h($horasA[$i]) ?></td>

                        <td> <?= $this->Form->select('Estado'.$idEstudiante[$i],["Aceptada" => 'Aceptada', "Rechazada - Profesor" => 'Rechazada - Profesor' ], ['required'=>true ,"id" => 'Estado'.$idEstudiante[$i], "empty" => true, 'onclick'=> 'revisarEstado('.$idEstudiante[$i].')'] ); ?></td>

                        <?php

                            if ($reqReprobados[$i] == false){
                                ?>
                                <td> <?= $this->Form->select('TipoHora'.$idEstudiante[$i],[$options1], ["id" => "TipoHora".$idEstudiante[$i], "empty" => true, 'disabled' => true, 'onclick'=> 'revisarTipoHora('.$idEstudiante[$i].')'] ); ?></td>
                               <?php 
                            } else {
                                ?>
                                <td> <?= $this->Form->select('TipoHora'.$idEstudiante[$i],[$options2], ["id" => "TipoHora".$idEstudiante[$i], "empty" => true, 'disabled' => true, 'onclick'=> 'revisarTipoHora('.$idEstudiante[$i].')'] ); ?></td>
                                <?php
                            }
                        ?>

                        
                        
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
            "bPaginate": false, //hide pagination
            "bFilter": false, //hide Search bar
            "bInfo": false, // hide showing entries
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
        if(estado == "Aceptada"){         
            document.getElementById("TipoHora"+id).disabled = false;           
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


<?php 
echo $maxHorasAsistente = $contadorHoras['horas_asistente'] > 20 ? 20 : $contadorHoras['horas_asistente'];
echo $maxHorasEstudianteECCI = $contadorHoras['horas_estudiante_ecci'] > 12 ? 12 : $contadorHoras['horas_estudiante_ecci'];
echo $maxHorasEstudianteDocente = $contadorHoras['horas_estudiante_docente'] > 12 ? 12 : $contadorHoras['horas_estudiante_docente'];
 ?>


<script>

    $(function(){
    $('div[onload]').trigger('onload');
    });

    function revisarTipoHora(id){

        tipo = document.getElementById("TipoHora"+id).value;
        if(tipo == "Estudiante"){
                //document.getElementById("Horas"+id).max = true;
            }
            else if (tipo == "Asistente"){
               document.getElementById("Horas"+id).max = <?php $maxHorasAsistente ?>;
            }
    }
</script>



