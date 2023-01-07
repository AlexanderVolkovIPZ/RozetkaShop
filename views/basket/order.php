<?php
/** @var array $basket */
/** @var array $user */
//var_dump($basket);
?>
<div class="container">
    <div class="row">
        <div class="col-9">
            <div class="fs-2">
                Оформлення замовлення
            </div>
            <div class="d-flex align-items-center gap-2 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                     class="bi bi-1-circle" viewBox="0 0 16 16">
                    <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383h1.312Z"/>
                </svg>
                <span class="fs-5">
                    Ваші контактні дані
                </span>
            </div>
            <div>
                <div class="d-flex justify-content-around row flex-wrap mt-2">
                    <div class="col-5">
                        <label for="orderFirstName" class="text-secondary">Ім'я</label>
                        <input type="text" class="form-control mt-2" id="orderFirstName"
                               value="<?php if (!empty($user)) echo $user['firstName'] ?>">
                    </div>
                    <div class="col-5">
                        <label for="orderLastName" class="text-secondary">Прізвище</label>
                        <input type="text" class="form-control mt-2" id="orderLastName"
                               value="<?php if (!empty($user)) echo $user['lastName'] ?>">
                    </div>
                </div>
                <div class="d-flex justify-content-around row flex-wrap mt-2">
                    <div class="col-5">
                        <label for="orderMobile" class="text-secondary">Мобільний телефон</label>
                        <input type="text" class="form-control mt-2" id="orderMobile">
                    </div>
                    <div class="col-5">
                        <label for="orderEmail" class="text-secondary">Електронна пошта</label>
                        <input type="text" class="form-control mt-2" id="orderEmail"
                               value="<?php if (!empty($user)) echo $user['login'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="d-flex justify-content-between mt-2 align-items-center">
                        <div class="fs-2">
                            Замовлення
                        </div>
                        <div class="fs-5 col-5 text-end sumOrder">
                            на суму: <?= $basket['totalPrice'] ?> ₴
                        </div>
                    </div>
                    <hr class="my-2">
                    <div>
                        <div class="d-flex align-items-center gap-2 my-2 justify-content-between">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                     class="bi bi-1-circle" viewBox="0 0 16 16">
                                    <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383h1.312Z"/>
                                </svg>
                                <span class="fs-5">Товари продавця Rozetka</span>
                            </div>
                            <div class="redactLink">
                                <a href="/basket">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-box-arrow-in-down-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M6.364 2.5a.5.5 0 0 1 .5-.5H13.5A1.5 1.5 0 0 1 15 3.5v10a1.5 1.5 0 0 1-1.5 1.5h-10A1.5 1.5 0 0 1 2 13.5V6.864a.5.5 0 1 1 1 0V13.5a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5v-10a.5.5 0 0 0-.5-.5H6.864a.5.5 0 0 1-.5-.5z"/>
                                        <path fill-rule="evenodd"
                                              d="M11 10.5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1 0-1h3.793L1.146 1.854a.5.5 0 1 1 .708-.708L10 9.293V5.5a.5.5 0 0 1 1 0v5z"/>
                                    </svg>
                                    <span class="">
                                    Редагувати
                                </span>
                                </a>
                            </div>
                        </div>


                        <?php foreach ($basket['products'] as $product): ?>

                            <div class="d-flex justify-content-between align-items-center mx-5 flex-wrap gap-2 mt-2">
                                <div class="d-flex align-items-center gap-2">
                                    <div>
                                        <?php if (!empty($product['photo'])): ?>
                                            <img class="rounded-2 imgOrder"
                                                 src="/files/product/<?= $product['photo'] ?>" alt="">
                                        <?php else: ?>
                                            <img class="rounded-2 imgOrder" src="/files/product/default.jpg" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="text-center">
                                        <img src="" alt="">
                                        <a href="/product/view/<?= $product['product']['id']; ?>" class="textValue"><?= $product['product']['name']; ?></a>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="text-secondary textLabel">Ціна</div>
                                    <div class="textValue"><?= $product['product']['price'] ?></div>
                                </div>
                                <div class="text-center">
                                    <div class="text-secondary textLabel">Кількість</div>
                                    <div class="textValue"><?= $product['count'] ?></div>
                                </div>
                                <div class="text-center">
                                    <div class="text-secondary textLabel">Сума</div>
                                    <div class="textValue">
                                        <?= $product['product']['price'] * $product['count'] ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <hr class="my-2">
                    <div class="row">
                        <div class="col-12">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                 class="bi bi-2-circle" viewBox="0 0 16 16">
                                <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM6.646 6.24v.07H5.375v-.064c0-1.213.879-2.402 2.637-2.402 1.582 0 2.613.949 2.613 2.215 0 1.002-.6 1.667-1.287 2.43l-.096.107-1.974 2.22v.077h3.498V12H5.422v-.832l2.97-3.293c.434-.475.903-1.008.903-1.705 0-.744-.557-1.236-1.313-1.236-.843 0-1.336.615-1.336 1.306Z"/>
                            </svg>
                            <span class="fs-5">Доставка</span>
                        </div>
                        <div class="border-dark d-flex align-items-center mt-3 border-1 gap-2 col-12">

                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                 class="bi bi-geo-alt svgLocation" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            <select class="form-select" aria-label="Пример выбора по умолчанию">
                                <option selected>Оберіть ваше місто</option>
                                <option value="1">Житомир</option>
                                <option value="2">Київ</option>
                                <option value="3">Дніпро</option>
                                <option value="4">Одеса</option>
                            </select>

                        </div>


                        <div class="border-dark d-flex align-items-center mt-3 border-1 gap-2 col-12">

                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                 class="bi bi-geo-alt svgLocation" viewBox="0 0 16 16">
                                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            <select class="form-select" aria-label="Пример выбора по умолчанию">
                                <option selected>Оберіть пункт видачі Rozetka</option>
                                <option value="1">Житомир</option>
                                <option value="2">Київ</option>
                                <option value="3">Дніпро</option>
                                <option value="4">Одеса</option>
                                <option value="5">Миколаїв</option>
                                <option value="6">Херсон</option>
                                <option value="7">Маріуполь</option>
                                <option value="8">Херсон</option>
                                <option value="9">Запоріжжя</option>
                                <option value="10">Донецьк</option>
                                <option value="11">Луганськ</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                 class="bi bi-3-circle" viewBox="0 0 16 16">
                                <path d="M7.918 8.414h-.879V7.342h.838c.78 0 1.348-.522 1.342-1.237 0-.709-.563-1.195-1.348-1.195-.79 0-1.312.498-1.348 1.055H5.275c.036-1.137.95-2.115 2.625-2.121 1.594-.012 2.608.885 2.637 2.062.023 1.137-.885 1.776-1.482 1.875v.07c.703.07 1.71.64 1.734 1.917.024 1.459-1.277 2.396-2.93 2.396-1.705 0-2.707-.967-2.754-2.144H6.33c.059.597.68 1.06 1.541 1.066.973.006 1.6-.563 1.588-1.354-.006-.779-.621-1.318-1.541-1.318Z"/>
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Z"/>
                            </svg>
                            <span class="fs-5">Оплата</span>
                        </div>
                        <div class="radioTypePayment mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="typePayment" id="flexRadioDefault1"
                                       checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Готівковий розрахунок (при отриманні товару)
                                </label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="typePayment" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Безготівковий розрахунок (при отриманні товару)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            Ітого
        </div>
    </div>
</div>


