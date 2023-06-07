<?php
/** @var array $products */
/** @var array $categories */
?>

<div class="container" style="overflow-x: scroll">
    <table class="table table-success table-striped table-hover mt-3 table-bordered text-center">
        <thead>
        <tr class="">
            <th>#</th>
            <th>Категорія товару</th>
            <th>Загальна кількість (од.)</th>
            <th>Загальна сума (грн.)</th>
        </tr>
        </thead>
        <tbody class="">

        <?php if (!empty($products)):?>
        <?php $i = 1?>
            <?php foreach ($products as $key=>$value):?>
                <tr class="table-active">
                    <td><?=$i?></td>
                    <td><?=$categories[$value['id_category']]?></td>
                    <td><?=$value['totalCount']?></td>
                    <td><?=$value['totalPrice']?></td>
                </tr>
                <?php $i+=1?>
            <?php endforeach;?>
        <?php else:?>
            <tr class="table-active text-warning">
                <td colspan="3">Товар відсутній на складі!</td>
            </tr>
        <?php endif;?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>