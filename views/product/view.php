<?php
/** @var array $product */
/** @var array $rows */
?>

<div class="container">
    <div class="row">
        <h1 class="h1 mb-3 mt-2 fw-normal text-center text-dark"><?= $product['name'] ?></h1>
        <div class="col-12 col-sm-12 col-md-5">
            <div class="text-center rounded-5" >
                <div id="carouselExample" class="carousel slide w-100">
                    <div class="carousel-inner rounded-5" style="">
                        <?php if (!empty($rows)): ?>
                            <?php foreach ($rows as $row): ?>
                                <?php if (is_file("files/product/" . $row['name'])): ?>
                                    <div class="carousel-item active">
                                        <img src="/files/product/<?= $row['name'] ?>"
                                             class="img-thumbnail d-block p-4 w-100 photoProductSlider"
                                             alt="...">
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="carousel-item active">
                                <img src="/files/product/default.jpg"
                                     class="img-thumbnail d-block p-4 w-100 photoProductSlider"
                                     alt="...">
                            </div>
                        <?php endif; ?>

                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                        <span class="text-dark" aria-hidden="true">
<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
</svg>
                        </span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                        <span class="text-dark" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                 class="bi bi-chevron-right" viewBox="0 0 16 16"> <path fill-rule="evenodd"
                                                                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>


                <!--                --><?php //if (is_file($filePath)): ?>
                <!--                    <img src="/-->
                <? //= $filePath ?><!--" alt="" class="card-img-top img-thumbnail">-->
                <!--                --><?php //else: ?>
                <!--                    <img src="/files/product/253279564.jpg" alt="" class="card-img-top img-thumbnail">-->
                <!--                --><?php //endif; ?>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-7 productDescription">
            <?php if ($product['count'] > 0): ?>
                <span class="bg-success bg-opacity-10 text-success px-3 py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle svgProductAvailable"  viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
</svg>
                    <span>Є в наявності</span>

                </span>
            <?php else: ?>
                <span class="bg-danger bg-opacity-10 text-danger px-3 py-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle svgProductNotAvailable" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg>

                    <span>Немає в наявності</span>

                </span>
            <?php endif; ?>
            <div class="fs-4 fw-normal mt-2 d-flex justify-content-between">
                <span>Ціна товару: <span class="priceProduct"><?= $product['price'] ?> ₴</span></span>

                <div>
                    <button href="" class="btn btn-success btnAddProductToBasket">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                        </svg>
                        Придбати</button>
                </div>
            </div>
<!--            <div>-->
<!--                Доступна кількість: --><?//= $product['count'] ?><!-- шт.-->
<!--            </div>-->

            <?php if (empty($product['brief_description'])!=1): ?>
                <div class="fs-4">
                    Короткий опис:
                </div>
                <div class="fs-6">
                    <?= $product['brief_description'] ?>
                </div>
            <?php endif; ?>

            <?php if (empty($product['full_description'])!=1): ?>
                <div class="accordion accordion-flush mb-3" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Повний опис товару
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"><?= $product['full_description'] ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
<!--            <div class="accordion mb-3" id="accordionPanelsStayOpenExample">-->
<!--                <div class="accordion-item">-->
<!--                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">-->
<!--                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">-->
<!--                            Повний опис товару-->
<!--                        </button>-->
<!--                    </h2>-->
<!--                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse hiding" aria-labelledby="panelsStayOpen-headingOne">-->
<!--                        <div class="accordion-body">-->
<!--                            --><?//= $product['full_description'] ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

            <div></div>
            <div></div>
        </div>
    </div>
</div>
