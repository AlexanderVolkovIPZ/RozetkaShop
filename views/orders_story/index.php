<?php

/** @var array $user */
/** @var array $orders */
use \models\Product;
use \models\PhotoProduct;
?>

<div class="container" style="max-width: 700px">
    <?php foreach ($orders as $order):?>
    <div class="accordion" id="accordion<?=$order['id']?>">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button row" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$order['id']?>" aria-expanded="true" aria-controls="collapseOne">
                    <div class="col-4">Виконаний</div>
                    <div class="col-4"><?=Product::getProductById($order['id_product'])?></div>
                    <div class="col-4">
                        <img style="width: 73px;height: 48px" src="/files/product/<?=PhotoProduct::getProductPhotoByName(Product::getProductById($order['id_product'])['name'])['photo'] ?>" alt="">
                    </div>
<!--                   <table>-->
<!--                       <tr>-->
<!--                           <td>-->
<!--                               <div></div>-->
<!--                               <div></div>-->
<!--                           </td>-->
<!--                           <td>-->
<!--                               <div></div>-->
<!--                               <div></div>-->
<!--                           </td>-->
<!--                           <td></td>-->
<!--                       </tr>-->
<!---->
<!--                   </table>-->
                </button>
            </h2>
            <div id="collapse<?=$order['id']?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>Это тело аккордеона первого элемента.</strong> Оно отображается по умолчанию, пока плагин свертывания не добавит соответствующие классы, которые мы используем для стилизации каждого элемента. Эти классы управляют общим внешним видом, а также отображением и скрытием с помощью переходов CSS. Вы можете изменить все это с помощью собственного CSS или переопределить наши переменные по умолчанию. Также стоит отметить, что практически любой HTML может быть помещен в <code>.accordion-body</code>, хотя переход ограничивает переполнение.
                </div>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>

