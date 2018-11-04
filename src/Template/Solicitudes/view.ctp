<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Solicitude $solicitude
 */
?>
<div class="solicitudes view large-9 medium-8 columns content">
    <h3><?= h('Información') ?></h3>
    <table class="table">
            <th scope="row"><?= __('Sigla') ?></th>
            <td><?= h($todo[0][0]) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Curso') ?></th>
            <td><?= h($todo[0][1]) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Profesor') ?></th>
            <td><?= h($todo[0][3]) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Estudiante') ?></th>
            <td><?= h($todo[0][4]) ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Carrera') ?></th>
            <td><?= h($solicitude->carrera) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= h($solicitude->estado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Asistencia Externa') ?></th>
            <td><?= h($solicitude->asistencia_externa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Justificación') ?></th>
            <td><?= h($solicitude->justificación) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Horas Asistente') ?></th>
            <td><?= h($solicitude->horas_asistente) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Horas Estudiante') ?></th>
            <td><?= h($solicitude->horas_estudiante) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Horas Asistente Externa') ?></th>
            <td><?= h($solicitude->horas_asistente_externa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Horas Estudiante Externa') ?></th>
            <td><?= h($solicitude->horas_estudiante_externa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Promedio') ?></th>
            <td><?= $this->Number->format($solicitude->promedio) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cantidad Horas') ?></th>
            <td><?= $this->Number->format($solicitude->cantidad_horas) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cantidad Horas Externa') ?></th>
            <td><?= $this->Number->format($solicitude->cantidad_horas_externa) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Ronda') ?></th>
            <td><?= $this->Number->format($solicitude->ronda) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha') ?></th>
            <td><?= h($solicitude->fecha) ?></td>
        </tr>
    </table>
</div>
<br>
 <?= $this->Html->link('Regresar',['action'=>'index'],['class'=>'btn btn-info btn-medium float-right mr-3'])?>