<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Route[]|\Cake\Collection\CollectionInterface $route
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Добавить маршрут'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Назад'), '/') ?></li>
    </ul>
</nav>
<div class="route index large-9 medium-8 columns content">
    <h3><?= __('Route') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('from') ?></th>
                <th scope="col"><?= $this->Paginator->sort('to') ?></th>
                <th scope="col"><?= $this->Paginator->sort('from_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('to_type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($route as $route): ?>
            <tr>
                <td><?= $this->Number->format($route->id) ?></td>
                <td><?= h($route->from) ?></td>
                <td><?= h($route->to) ?></td>
                <td><?= h($route->from_type) ?></td>
                <td><?= h($route->to_type) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $route->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $route->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $route->id], ['confirm' => __('Are you sure you want to delete # {0}?', $route->id)]) ?>
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
