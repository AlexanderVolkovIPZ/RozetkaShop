<?php

/** @var array $user */

/** @var array $orders */

use \models\Product;
use \models\PhotoProduct;

?>

<div class="container" style="max-width: 700px">
    <?php foreach ($orders as $order): ?>
<!--        --><?php //var_dump($order) ?>
        <div class="accordion accordion-flush mt-2" id="accordionFlush<?= $order['id'] ?>">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed py-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse<?= $order['id'] ?>" aria-expanded="false"
                            aria-controls="flush-collapseOne">
                        <div class="d-flex justify-content-between align-items-center w-100">

                            <div class="d-flex">
                                <div class="rounded-5 stickOrderStory"></div>
                                <div>
                                    <div class="text-secondary labelSecondaryStoryOrder">№<?= $order['id'] ?> від <?= $order['date'] ?></div>
                                    <div class="orderHeaderInform">Виконано</div>
                                </div>
                            </div>


                            <div>
                                <div class="text-secondary labelSecondaryStoryOrder">Сума замовлення
                                </div>
                                <div class="orderHeaderInform"> <?= $order['count'] * Product::getProductById($order['id_product'])['price'] ?></div>


                            </div>
                            <div>
                                <img src="/files/product/<?= PhotoProduct::getProductPhotoByName(Product::getProductById($order['id_product'])['name'])[0]['name']; ?>"
                                     style="width: 73px; height: 48px"></div>
                        </div>
                    </button>
                </h2>
                <div id="flush-collapse<?= $order['id'] ?>" class="accordion-collapse collapse"
                     aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <table class="w-100">
                            <tr>
                                <td class="text-secondary pb-2">Товари Rozetka</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="align-top text-center">
                                    <div class="d-flex align-items-center">
                                        <img src="/files/product/<?= PhotoProduct::getProductPhotoByName(Product::getProductById($order['id_product'])['name'])[0]['name']; ?>"
                                             style="width: 73px; height: 48px">
                                        <a href="/product/view/<?=$order['id_product']?>" class="linkProductOrderStory px-0 mx-0">
                                            <?=Product::getProductById($order['id_product'])['name']?>
                                        </a>
                                    </div>

                                </td>
                                <td class="align-top text-center">
                                    <div class="text-secondary labelSecondaryStoryOrder">Ціна</div>
                                    <div><?=Product::getProductById($order['id_product'])['price']?> ₴</div>
                                </td>
                                <td class="align-top text-center">
                                    <div class="text-secondary labelSecondaryStoryOrder">Кількість</div>
                                    <div><?=$order['count']?></div>
                                </td>
                                <td class="align-top text-center">
                                    <div class="text-secondary labelSecondaryStoryOrder">Сума</div>
                                    <div><?= $order['count'] * Product::getProductById($order['id_product'])['price'] ?> ₴</div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="1" class="text-secondary pt-3 text-start">Оплата</td>
                                <td colspan="3" class="pt-3 text-end"><?=\models\Order::getTypePaymentById($order['typePayment_id'])['name']?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-secondary pt-2 text-start">Доставка</td>
                                <td colspan="2" class="pt-2 text-end">Безкоштовно</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-secondary pt-2 text-start">Всього</td>
                                <td colspan="2" class="pt-2 text-end fs-5"><?= $order['count'] * Product::getProductById($order['id_product'])['price'] ?> ₴</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

