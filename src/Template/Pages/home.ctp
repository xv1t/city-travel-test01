<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Действия') ?></li>
        <li><?= $this->Html->link(__('Маршруты::редакирование'), ['controller' => 'route', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Маршруты таблица задание 1'), ['controller' => 'route', 'action' => 'task1']) ?></li>
    </ul>
</nav>