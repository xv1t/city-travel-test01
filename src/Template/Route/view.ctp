<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Route $route
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Route'), ['action' => 'edit', $route->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Route'), ['action' => 'delete', $route->id], ['confirm' => __('Are you sure you want to delete # {0}?', $route->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Route'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Route'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="route view large-9 medium-8 columns content">
    <h3><?= h($route->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('From') ?></th>
            <td><?= h($route->from) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('To') ?></th>
            <td><?= h($route->to) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('From Type') ?></th>
            <td><?= h($route->from_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('To Type') ?></th>
            <td><?= h($route->to_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($route->id) ?></td>
        </tr>
    </table>
</div>
