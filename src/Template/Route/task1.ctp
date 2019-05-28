<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Route[]|\Cake\Collection\CollectionInterface $route
 */
?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Действия') ?></li>
        <li><?= $this->Html->link(__('Назад'), '/') ?></li>
    </ul>
</nav>
<div class="route index large-9 medium-8 columns content">
    <h3>Задание 1</h3>

<table id="table1">
    <thead>
        <tr>
            <th>code_from 
            <th>code_to 
            <th>city_from
            <th>city_to 
            <th>airport_from 
            <th>airport_to
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($data as $datum) {
            echo $this->Html->tag(
                'tr', 
                join([
                    $this->Html->tag('td', $datum[0]),
                    $this->Html->tag('td', $datum[1]),
                    $this->Html->tag('td', $datum[2]),
                    $this->Html->tag('td', $datum[3]),
                    $this->Html->tag('td', $datum[4]),
                    $this->Html->tag('td', $datum[5]),
                ])
                );
        }
        ?>
    </tbody>
</table>
<?php 



echo $this->element('../Route/add2');
?>
<hr>
<h3>Запрос для получения таблицы</h3>
<?php
require 'vendor/jdorn/sql-formatter/lib/SqlFormatter.php';
echo SqlFormatter::format(file_get_contents(APP . '../config/schema/select1.sql'));
?>
<h3>Запрос для выборки всех объектов</h3>
<?php 
echo SqlFormatter::format(file_get_contents(APP . '../config/schema/airobjects.sql'));
?>
    </div>
