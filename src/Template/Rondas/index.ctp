<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ronda[]|\Cake\Collection\CollectionInterface $rondas
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Ronda'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rondas index large-9 medium-8 columns content">
    <h3><?= __('Rondas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('numero') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_inicial') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fecha_final') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rondas as $ronda): ?>
            <tr>
                <td><?= $this->Number->format($ronda->numero) ?></td>
                <td><?= h($ronda->fecha_inicial) ?></td>
                <td><?= h($ronda->fecha_final) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('<span class="typcn typcn-info-large-outline"></span>'), ['action' => 'view', $ronda->numero],['escape'=>false,'style'=>'font-size:22px;']) ?>
                    <?= $this->Html->link(__('<span class="typcn typcn-pen"></span>'), ['action' => 'edit', $ronda->numero],['escape'=>false,'style'=>'font-size:22px;']) ?>
                    <?= $this->Form->postLink(__('<span class="typcn typcn-trash"></span>'), ['action' => 'delete', $ronda->numero], ['confirm' => __('Por favor confirme si desea eliminar la ronda # {0}?', $ronda->numero), 'style'=>'font-size:22px;','escape'=>false]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
