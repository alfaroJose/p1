<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ronda $ronda
 */
?>

<div class="rondas view large-9 medium-8 columns content">
    <h3><?= h($ronda->numero) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Numero') ?></th>
            <td><?= $this->Number->format($ronda->numero) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Inicial') ?></th>
            <td><?= h($ronda->fecha_inicial) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fecha Final') ?></th>
            <td><?= h($ronda->fecha_final) ?></td>
        </tr>
    </table>
</div>
