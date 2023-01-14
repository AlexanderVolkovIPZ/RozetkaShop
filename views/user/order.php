<?php
/** @var array $orders */

use \models\User;
use \models\Product;
use \models\Order;

$counter = 1
?>


<div class="container" style="overflow-x: scroll">
    <table class="table table-danger table-striped table-hover mt-3 table-bordered ordersAdmin">
        <thead>
        <tr class="tHeadOrders">
            <th class="align-middle text-center">#</th>
            <th class="align-middle text-center">Ім'я замовника</th>
            <th class="align-middle text-center">Прізвище замовника</th>
            <th class="align-middle text-center">Електронна пошта замовника</th>
            <th class="align-middle text-center">Номер телефону замовника</th>
            <th class="align-middle text-center">Тип оплати</th>
            <th class="align-middle text-center">Адреса доставки</th>
            <th class="align-middle text-center">Назва товару</th>
            <th class="align-middle text-center"> Кількість товару</th>
            <th class="align-middle text-center">Сума замовлення</th>
            <th class="align-middle text-center"></th>
        </tr>
        </thead>
        <tbody class="tBodyOrders">
        <?php foreach ($orders as $order): ?>
            <?php if ($order['status'] == 0): ?>
                <tr class="" data-order="<?= $order['id'] ?>">
                    <td class="align-middle fw-bolder" data-order="<?= $order['id'] ?>"> <?= $counter ?></td>
                    <?php if ($order['id_user'] == null): ?>
                        <td class="align-middle text-center"><?= $order['firstName'] ?></td>
                        <td class="align-middle text-center"><?= $order['middleName'] ?></td>
                        <td class="align-middle text-center"><?= $order['login'] ?></td>
                    <?php else: ?>
                        <td class="align-middle text-center"><?= User::getUserById($order['id_user'])['firstName'] ?></td>
                        <td class="align-middle text-center"><?= User::getUserById($order['id_user'])['middleName'] ?></td>
                        <td class="align-middle text-center"><?= User::getUserById($order['id_user'])['login'] ?></td>
                    <?php endif; ?>
                    <td class="align-middle text-center"><?= $order['mobile'] ?></td>
                    <td class="align-middle text-center"><?= Order::getTypePaymentById($order['typePayment_id'])['name'] ?></td>
                    <td class="align-middle text-center"><?= Order::getDestinationById($order['id_destination'])['name'] ?></td>

                    <td class="align-middle text-center"><?= Product::getProductById($order['id_product'])['name'] ?></td>
                    <td class="align-middle text-center"><?= $order['count'] ?></td>
                    <td class="align-middle text-center"><?= $order['count'] * Product::getProductById($order['id_product'])['price'] ?>
                        ₴
                    </td>
                    <td class="align-middle text-center">
                        <a href="#" class="changeStatusOrder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                 class="bi bi-check-lg text-success productWasSend" viewBox="0 0 16 16"
                                 style="cursor: pointer">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php $counter += 1 ?>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>

