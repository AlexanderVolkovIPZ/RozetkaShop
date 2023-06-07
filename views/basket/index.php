<?php
/** @var array $basket */

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="container">
        <?php if(!empty($basket['products'])):?>
        <table class="table table-striped table-hover  align-middle text-center tableBasket">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Назва товару</th>
                <th>Вартість одиниці</th>
                <th>Кількість</th>
                <th>Загальна вартість</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="bodyBasketTable tableBody">

            <?php foreach ($basket['products'] as $row): ?>

                <tr class="align-items-center <?=$row['product']['id']?>" >
                    <?php if (!empty($row['photo'])): ?>
                        <td><img src="files/product/<?= $row['photo'] ?>" alt="" class="imgBasket" data-set = "<?=$row['product']['id']?>"</td>
                    <?php else: ?>
                        <td><img src="/files/product/default.jpg" alt="" class="imgBasket"></td>
                    <?php endif; ?>
                    <td><?= $row['product']['name'] ?></td>
                    <td><?= $row['product']['price'] ?></td>
                    <td class="">
                        <div class="wrapperBasketProductCount mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                 class="bi bi-dash-lg removeProductCountBasket" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"/>
                            </svg>

                            <input type="text" value="<?=$row['count']?>" class="basketFormInputCountProduct text-center"  data-id = "<?=$row['product']['id']?>">

                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                 class="bi bi-plus-lg addProductCountBasket" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                            </svg>
                        </div>
                    </td>
                    <td><span class="allSumOneProductInBasket" id="<?=$row['product']['id']?>"><?= $row['product']['price'] * $row['count'] ?> ₴</span>
                    </td>
                    <td>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                             class="bi bi-x-lg btnDeleteProductFromBasket"  viewBox="0 0 16 16" data-id = "<?=$row['product']['id']?>">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                        </svg>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Загальна сума</th>
                <th></th>
                <th></th>
                <th></th>
                <th class="allSumBasket"><?=$basket['totalPrice']." ₴"?></th>
                <th></th>
            </tr>
            </tfoot>
        </table>
        <div class="d-flex justify-content-end">
            <a class="btn btn-success" href="basket/order">Оформити замовлення</a>
        </div>
        <?php endif;?>
    </div>
</form>