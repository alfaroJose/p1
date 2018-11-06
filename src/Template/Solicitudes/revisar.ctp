<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
 */
?>
<div class="solicitudes form large-9 medium-8 columns content">
    <?= $this->Form->create($solicitude) ?>
    <fieldset>
        <legend><?= __('Revisar Solicitud') ?></legend>
        <br>
        <h5> Datos del estudiante </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
        //debug($datosRequisitosEstudiante);
        //die();
            echo $this->Form->control('primer_apellido', ['readonly', 'value'=> $datosSolicitud[0][2] ]);
            echo $this->Form->control('segundo_apellido', ['readonly', 'value'=> $datosSolicitud[0][3] ]);
            echo $this->Form->control('nombre', ['readonly', 'value'=> $datosSolicitud[0][1] ]);
            echo $this->Form->control('identificacion', ['label'=>['text'=>'Identificación'], 'readonly', 'value'=> $datosSolicitud[0][7] ]);
            echo $this->Form->control('carne', ['label'=>['text'=>'Carné'], 'readonly', 'value'=> $datosSolicitud[0][6] ]);
            echo $this->Form->control('telefono', ['label'=>['text'=>'Teléfono'], 'readonly', 'value'=> $datosSolicitud[0][5] ]);
            echo $this->Form->control('correo', ['readonly', 'value'=> $datosSolicitud[0][4] ]);
            echo $this->Form->control('carrera', ['readonly', 'value'=> $datosSolicitud[0][21] ]);
            echo $this->Form->control('horas_estudiante', ['label'=>['text'=>'Solicita horas estudiante'], 'readonly', 'value'=> $datosSolicitud[0][33] ]);
            echo $this->Form->control('horas_asistente', ['label'=>['text'=>'Solicita horas asistente'], 'readonly', 'value'=> $datosSolicitud[0][32] ]);
        ?>
        </div>

        <br>
        <h5> ¿Tiene o va a solicitar asistencia en otra Unidad Académica u oficina de la Universidad? </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            echo $this->Form->control('horas_estudiante_externa', ['label'=>['text'=>'Horas estudiante'], 'readonly', 'value'=> $datosSolicitud[0][35] ]);
            echo $this->Form->control('horas_asistente_externa', ['label'=>['text'=>'Horas asistente'], 'readonly', 'value'=> $datosSolicitud[0][34] ]);
            echo $this->Form->control('cantidad_horas_externa', ['label'=>['text'=>'Cantidad de horas'], 'readonly', 'value'=> $datosSolicitud[0][26] ]);
        ?>
        </div>

        <br>
        <h5> Curso solicitado </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">
        <?php
            echo $this->Form->control('sigla', ['readonly', 'value'=> $datosSolicitud[0][43] ]);
            echo $this->Form->control('grupo', ['readonly', 'value'=> $datosSolicitud[0][37] ]);
            echo $this->Form->control('curso', ['readonly', 'value'=> $datosSolicitud[0][44] ]);
            echo $this->Form->control('docente', ['readonly', 'value'=> $datosSolicitud[0][11] ]);
        ?>
        </div>

        <br>
        <h5> Requisitos </h5>
        <div style="padding-top: 15px; padding-bottom: 10px; padding-left: 75px; width: 80%; border-style: solid; border-width: 1px; border-color: black; border-radius: 25px">

        <style> 
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            text-align: left;
            padding: 8px;
        }
        </style>

        <table id="requisitos-asistente" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= 'Horas Asistente' ?></th>
                    <th scope="col"><?= 'Tipo' ?></th>
                    <th scope="col" class="actions"><?= __('Cumple el requisito?') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datosRequisitosAsistente as $asistente): ?>
                <tr>
                    <td><?= h($asistente['nombre']) ?></td>
                    <td><?= h($asistente['tipo']) ?></td>
                    <td class="actions">
                    <?php
                        if ($asistente['tipo'] == 'Obligatorio') {
                            echo $this->Form->radio($asistente['id'], ['Sí ', 'No ']);
                        } else {
                            echo $this->Form->radio($asistente['id'], ['Sí ', 'No ', 'Inopia ']);
                        }
                    ?>    
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

            <thead>
                <tr>
                    <th scope="col"><?= 'Horas Estudiante' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datosRequisitosEstudiante as $estudiante): ?>
                <tr>
                    <td><?= h($estudiante['nombre']) ?></td>
                    <td><?= h($estudiante['tipo']) ?></td>
                    <td class="actions">
                    <?php
                        if ($estudiante['tipo'] == 'Obligatorio') {
                            echo $this->Form->radio($estudiante['id'], ['Sí ', 'No ']);
                        } else {
                            echo $this->Form->radio($estudiante['id'], ['Sí ', 'No ', 'Inopia ']);
                        }
                    ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

            <thead>
                <tr>
                    <th scope="col"><?= 'Generales' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datosRequisitosGeneral as $general): ?>
                <tr>
                    <td><?= h($general['nombre']) ?></td>
                    <td><?= h($general['tipo']) ?></td>
                    <td class="actions">
                    <?php
                        if ($general['tipo'] == 'Obligatorio') {
                            echo $this->Form->radio($general['id'], ['Sí ', 'No ']);
                        } else {
                            echo $this->Form->radio($general['id'], ['Sí ', 'No ', 'Inopia ']);
                        }
                    ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

    </fieldset>
    <br>
    <?= $this->Form->button(__('Aceptar'),['class'=>'btn btn-info float-right']) ?>
    <?= $this->Html->link(__('Cancelar'),['action'=>'index'],['class'=>'btn btn-info float-right mr-3']) ?>
    <?= $this->Form->end() ?>
</div>
