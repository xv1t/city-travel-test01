<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Route $route
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Route'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="route form large-9 medium-8 columns content">
    <?= $this->Form->create($route) ?>
    <fieldset>
        <legend><?= __('Add Route') ?></legend>
        <?php
            echo $this->Form->control('from');
            echo $this->Form->control('to');
            echo $this->Form->control('from_type');
            echo $this->Form->control('to_type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
