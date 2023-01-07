<?php
/** @var array $basket */
/** @var array $user */
/** @var array $towns */
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-xl-9">
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
            <form action="" method="post" enctype="multipart/form-data" id="form" name="form">
                <div>
                    <div class="d-flex justify-content-around row flex-wrap mt-2">
                        <div class="col-5">
                            <label for="orderFirstName" class="text-secondary">Ім'я</label>
                            <input type="text" class="form-control mt-2" id="orderFirstName " name="firstName"
                                   value="<?php if (!empty($user)) echo $user['firstName'] ?>">
                        </div>
                        <div class="col-5">
                            <label for="orderLastName" class="text-secondary">Прізвище</label>
                            <input type="text" class="form-control mt-2" id="orderLastName" name="middleName"
                                   value="<?php if (!empty($user)) echo $user['lastName'] ?>">
                        </div>
                    </div>
                    <div class="d-flex justify-content-around row flex-wrap mt-2">
                        <div class="col-5">
                            <label for="orderMobile" class="text-secondary">Мобільний телефон</label>
                            <input type="text" class="form-control mt-2" id="orderMobile" name="mobile">
                        </div>
                        <div class="col-5">
                            <label for="orderEmail" class="text-secondary">Електронна пошта</label>
                            <input type="text" class="form-control mt-2" id="orderEmail" name="email"
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor"
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


<!--                                                        --><?php //foreach ($basket['products'] as $product): ?>
<!---->
<!--                                                            <div class="d-flex justify-content-between align-items-center mx-5 gap-2 mt-2">-->
<!--                                                                <div class="d-flex align-items-center gap-2">-->
<!--                                                                    <div>-->
<!--                                                                        --><?php //if (!empty($product['photo'])): ?>
<!--                                                                            <img class="rounded-2 imgOrder"-->
<!--                                                                                 src="/files/product/--><?//= $product['photo']?><!--" alt="">-->
<!--                                                                        --><?php //else: ?>
<!--                                                                            <img class="rounded-2 imgOrder" src="/files/product/default.jpg" alt="">-->
<!--                                                                        --><?php //endif; ?>
<!--                                                                    </div>-->
<!--                                                                    <div class="text-center">-->
<!--                                                                        <img src="" alt="">-->
<!--                                                                        <a href="/product/view/-->
<!--                            --><?//= $product['product']['id']; ?><!--"-->
<!--                                                                           class="textValue">-->
<!--                            --><?//= $product['product']['name']; ?><!--</a>-->
<!--                                                                    </div>-->
<!--                                                                </div>-->
<!--                                                                <div class="text-center">-->
<!--                                                                    <div class="text-secondary textLabel">Ціна</div>-->
<!--                                                                    <div class="textValue">-->
<!--                            --><?//= $product['product']['price'] ?><!-- ₴</div>-->
<!--                                                                </div>-->
<!--                                                                <div class="text-center">-->
<!--                                                                    <div class="text-secondary textLabel">Кількість</div>-->
<!--                                                                    <div class="textValue">-->
<!--                            --><?//= $product['count'] ?><!--</div>-->
<!--                                                                </div>-->
<!--                                                                <div class="text-center">-->
<!--                                                                    <div class="text-secondary textLabel">Сума</div>-->
<!--                                                                    <div class="textValue">-->
<!---->
<!--                            --><?//= $product['product']['price'] * $product['count'] ?><!-- ₴-->
<!--                                                                    </div>-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                        --><?php //endforeach; ?>







                            <table class="col-12 align-items-center mx-0">
                                <?php foreach ($basket['products'] as $product): ?>
                                    <tr class="">
                                        <td class="px-4 col-6 py-1">
                                            <div class="d-flex align-items-center text-center gap-4">
                                                <div>
                                                    <?php if (!empty($product['photo'])): ?>
                                                        <img class="rounded-2 imgOrder"
                                                             src="/files/product/<?= $product['photo'] ?>" alt="">
                                                    <?php else: ?>
                                                        <img class="rounded-2 imgOrder" src="/files/product/default.jpg"
                                                             alt="">
                                                    <?php endif; ?>
                                                </div>
                                                <div>
                                                    <a href="/product/view/<?= $product['product']['id']; ?>"
                                                       class="textValue"><?= $product['product']['name']; ?></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center col-2">
                                            <div class="text-secondary textLabel">Ціна</div>
                                            <div class="textValue"><?= $product['product']['price'] ?> ₴</div>
                                        </td>
                                        <td class="text-center col-2">
                                            <div class="text-secondary textLabel">Кількість</div>
                                            <div class="textValue"><?= $product['count'] ?></div>
                                        </td>
                                        <td class="text-center col-2">
                                            <div class="text-secondary textLabel">Сума</div>
                                            <div class="textValue">
                                                <?= $product['product']['price'] * $product['count'] ?> ₴
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>

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
                                <select class="form-select selectTown" name="selectTown"
                                        aria-label="Пример выбора по умолчанию">
                                    <option value="0" selected>Оберіть ваше місто</option>
                                    <?php foreach ($towns as $town): ?>
                                        <option value="<?= $town['id'] ?>"><?= $town['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <div class="border-dark d-flex align-items-center mt-3 border-1 gap-2 col-12">

                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                     class="bi bi-house svgLocation" viewBox="0 0 16 16">
                                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                                </svg>
                                <select class="form-select selectDestination" name="selectDestination"
                                        aria-label="Пример выбора по умолчанию">
                                    <option value="default" selected>Оберіть пункт видачі Rozetka</option>
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
                                    <input class="form-check-input" type="radio" name="typePayment" value="1"
                                           id="flexRadioDefault1"
                                           checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Готівковий розрахунок (при отриманні товару)
                                    </label>
                                </div>
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="radio" name="typePayment" value="2"
                                           id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Безготівковий розрахунок (при отриманні товару)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <?php
        $countProduct = 0;
        foreach ($basket['products'] as $key => $value) {
            $countProduct += $value['count'];
        }
        ?>


        <div class="col-lg-4 col-xl-3">
            <div class="confirmOrderWrapper rounded-4" style="border: 1px solid black">
                <div class="fs-3">
                    Всього
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="text-secondary"><?= $countProduct ?> товари на суму</div>
                    <div><?= $basket['totalPrice'] ?> ₴</div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="text-secondary">Вартість доставки</div>
                    <div>0 ₴</div>
                </div>
                <hr class="my-1">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-secondary">До cплати</div>
                    <div class="fs-4"><?= $basket['totalPrice'] ?> ₴</div>
                </div>
                <hr class="my-1 mb-3">


                <div class="w-100 text-center mb-3">
                    <button type="submit" form="form" class="btn btn-success">Замовлення підтверджую</button>
                </div>


                <div>
                    <div class="text-secondary warningPasspord mb-2">
                        Отримання замовлення від 5 000 ₴ тільки за паспортом (Закон від 06.12.2019 № 361-IX)
                    </div>
                    <div class="orderConditions text-secondary">
                        <div class="mb-1">Підтверджуючи замовлення, я приймаю умови:</div>
                        <ul>
                            <li class="mb-2">положення про збирання та захист персональних даних
                                <a href="" class="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                         class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                </a>

                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="staticBackdropLabel">Положення
                                                    про обробку і захист персональних даних</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Закрыть"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    <div class="fs-5 mb-1">1. Загальні положення та сфера
                                                        застосування.
                                                    </div>
                                                    <div>
                                                        <div>
                                                            1.1. Це Положення про обробку та захист персональних даних
                                                            (надалі – «Положення») розроблене ТОВ «Розетка. УА» (код
                                                            ЄДРПОУ: 37193071, адреса: м. Київ, бул. Дружби Народів, 8-А,
                                                            надалі – «Товариство» та/або «Володілець даних») у
                                                            відповідності до чинного законодавства України, в тому
                                                            числі, але не виключно, Закону України «Про захист
                                                            персональних даних» від 01 червня 2010 року № 2297-VI і
                                                            встановлює порядок отримання, збору, накопичення,
                                                            зберігання, обробки, використання, забезпечення захисту і
                                                            розкриття персональних даних (надалі – «Дані» та/або
                                                            «Персональні дані») за допомогою веб-сайту: rozetka.com.ua
                                                            (надалі – «Сайт») та/або мобільного додатку: “ROZETKA”
                                                            (надалі – «Мобільний додаток» та/або «Мобільний додаток
                                                            “ROZETKA”) та/або пов'язаних з ними послуг та інструментів.
                                                        </div>
                                                        <div>
                                                            1.2. Здійснивши реєстрацію на Сайті rozetka.com.ua або
                                                            авторизацію за допомогою мобільного додатку “ROZETKA”
                                                            (завантажений за допомогою Play Market та App Store), та
                                                            починаючи використання Інтернет-магазину, або при спробі
                                                            оформити замовлення без попередньої реєстрації, Користувач
                                                            (Покупець) надає дозвіл та однозначну згоду на обробку його
                                                            персональних даних на умовах та в порядку, що викладені
                                                            нижче, а також підтверджує ознайомлення з цим Положенням,
                                                            його прийняття та згоду з його змістом.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="fs-5 my-1">2. Склад та зміст персональних даних.</div>
                                                    <div>
                                                        <div>2.1. Під Даними розуміється будь-яка інформація, що прямо
                                                            чи опосередковано відноситься до конкретного Користувача. Це
                                                            може бути:
                                                            ім’я, прізвище, по-батькові (у разі наявності), номер
                                                            телефона, адреса електронної пошти, дата народження,
                                                            наявність дітей, стать, захоплення, наявність домашніх
                                                            тварин, наявність автомобіля та його VIN номер, мову
                                                            спілкування, адреса місця проживання/перебування/доставки,
                                                            інформація про дії Користувача під час використання
                                                            Інтернет-магазину, IP-адреса, дані про пристрої, що
                                                            використовуються Користувачем (тип пристрою, тип браузера,
                                                            операційна система пристрою), історія повідомлень
                                                            (інформація, яка міститься в переписці між Користувачем з
                                                            адміністрацією Інтернет-магазину або зі сторонніми
                                                            продавцями маркетплейсу), історія відгуків чи коментарів,
                                                            інша інформація, за допомогою якої здійснюється комунікація,
                                                            та яка за бажанням Користувача надається ним в реєстраційній
                                                            формі та/або при заповненні власного профілю в
                                                            Інтернет-магазин, при проходженні опитування (шляхом
                                                            заповнення анкети або в інший спосіб), або інформація
                                                            отримана при усній комунікації Користувача і адміністрації
                                                            Сайту, інформація, яка надається при здійсненні оплати в
                                                            Інтернет-магазині (в тому числі під час покупки товарів
                                                            та/або послуг, які пропонуються в Інтернет-магазині в
                                                            кредит/оплату частинами. Зокрема: інформація щодо паспортних
                                                            даних Користувача, ідентифікаційного коду та інше).
                                                        </div>
                                                        <div>
                                                            2.2. Користувачі несуть відповідальність за всю інформацію,
                                                            що розміщується ними в загальнодоступних облікових записах.
                                                            Користувач повинен усвідомити всі ризики, пов'язані з тим,
                                                            що він оприлюднює адресу або інформацію про точне місце
                                                            свого розташування. Якщо Користувач вирішив увійти на
                                                            Он-лайн платформу, використовуючи службу автентифікації
                                                            стороннього оператора, наприклад інформацію Facebook,
                                                            Товариство може отримати додатковий профіль, або іншу
                                                            інформацію, доступ до якої надано такою третьою особою.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>користувальницька угода
                                <a href="" class="" data-bs-toggle="modal" data-bs-target="#userAgreement">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor"
                                         class="bi bi-info-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                </a>

                                <div class="modal fade" id="userAgreement" data-bs-backdrop="static"
                                     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center" id="staticBackdropLabel">Угода
                                                    користувача</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Закрыть"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    <div class="fs-5 mb-1">1. Персональні дані.</div>
                                                    <div>
                                                        У доповнення до Положення, на виконання вимог Закону України
                                                        "Про захист персональних даних" шляхом заповнення на
                                                        Онлайн-платформі заявки для розгляду можливості придбання
                                                        товару в кредит та натискання кнопки «Замовлення
                                                        підтверджую» даю згоду на обробку вказаних у заявці моїх
                                                        персональних даних наступними особами: АТ «ПУМБ» (код ЄДРПОУ
                                                        - 14282829), АТ «ОТП БAНК» (код ЄДРПОУ– 21685166), АТ
                                                        "УКРСИББАНК" (код ЄДРПОУ– 09807750), ТОВ "ФК"ЦФР" (код
                                                        ЄДРПОУ– 35725063), АТ "АЛЬФА-БАНК" (код ЄДРПОУ– 23494714),
                                                        АТ КБ «ПРИВАТБАНК» (код ЄДРПОУ – 14360570), АТ "УНІВЕРСАЛ
                                                        БАНК" (код ЄДРПОУ – 21133352), та іншим фінансовим
                                                        установам, що надають можливість кредитування на Он-лайн
                                                        платформі Rozetka, з метою забезпечення реалізації
                                                        цивільно-правових відносин, надання/отримання та здійснення
                                                        розрахунків за придбані товари/послуги, в тому числі шляхом
                                                        кредитування. Не заперечую щодо перевірки переліченими у цій
                                                        Угоді фінансовими установами інформації у будь-яких бюро
                                                        кредитних історій України з метою з’ясування відомостей, які
                                                        стосуються виконання мною взятих на себе зобов’язань по
                                                        договорам (в т.ч. кредитним), у випадку наявності таких, тим
                                                        самим розуміючи, що об’єм інформації, яка буде перевірятися,
                                                        може включати в себе інформацію, яка стосується банківської
                                                        таємниці, і з’ясування якої буде такою, яка буде повною та
                                                        достатньою для розуміння мого соціального, майнового стану,
                                                        платоспроможності та несення можливої подальшої майнової
                                                        відповідальності, у випадку її необхідності.
                                                    </div>

                                                </div>
                                                <div>
                                                    <div class="fs-5 my-1">2. Чому ми обробляємо персональні дані.</div>

                                                    <div>Термін «персональні дані» використовується в значенні,
                                                        визначеному в Законі України «Про захист персональних даних» та
                                                        становить сукупність відомостей про користуваня, які
                                                        визначаються в Положенні.

                                                        Ми можемо обробляти ваші персональні дані для цілей та з метою,
                                                        визначених в Положенні. При цьому одночасно можуть
                                                        застосовуватися одна або кілька цілей.

                                                        Ми діємо відповідно до цієї Угоди користувача, на підставі
                                                        Положення про обробку і захист персональних даних та на підставі
                                                        чинного законодавства України. Володільцем персональних даних є
                                                        ТОВ «Розетка. УА», що знаходиться за адресою : м. Київ, бул.
                                                        Дружби Народів, 8-А. Ми маємо право зберігати Персональні дані
                                                        стільки, скільки необхідно для реалізації мети, що зазначена у
                                                        даній Угоді користувача та Положенні.
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


