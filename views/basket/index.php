<?php
/** @var array $basket */
var_dump($basket['products']);
?>

<div class="container">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Назва товару</th>
            <th>Вартість одиниці</th>
            <th>Кількість</th>
            <th>Загальна кількість</th>
        </tr>
        </thead>
        <?php foreach ($basket['products'] as $row):?>
        <tr>
            <td><?=$row['product']['name']?></td>
            <td><?=$row['product']['price']?></td>
            <td><?=$row['product']['count']?></td>
            <td><?=$row['product']['price']*$row['count']?></td>
        </tr>
        <?php endforeach; ?>
        <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </tfoot>


    </table>
</div>