<?php
/** @var array $products */
/** @var array $rows */
/** @var array $filters */
/** @var array $categoryFilter */
/** @var array $arrayFilterValues */

/** @var array $filterSelected */

use \models\User;

?>
<div class="wrapper d-flex flex-row">
    <?php if (!User::isUserAdmin() && !empty($filters)): ?>
        <div class="d-flex flex-column">
            <div class="filter-list"
                 style="width: 212px; height: 400px; border-right: 1px solid black; padding-right: 10px; overflow-y: scroll">
                <form action="" method="get" enctype="multipart/form-data" name="filters" id="filters">
                    <?php foreach ($filters as $key => $value): ?>
                        <div class="mt-3 fw-bolder text-dark" style="font-size: 14px"><?= $filters[$key]['name'] ?></div>
                        <?php foreach ($arrayFilterValues as $k => $val): ?>
                            <?php if ($filters[$key]['table_name'] == $k): ?>
                                <?php foreach ($arrayFilterValues[$k] as $id => $v): ?>
                                    <div class="form-check">
                                        <input class="form-check-input filter-check" type="checkbox"
                                               value="<?= $v['id'] ?>" id=" <?= $v['value'] ?>"
                                               name="<?= $filters[$key]['table_name'] . '[]' ?>"
                                            <?php if ($filterSelected != null): ?>
                                                <?php foreach ($filterSelected as $key1 => $value1): ?>
                                                    <?php if ($filters[$key]['table_name'] == $key1): ?>
                                                        <?php foreach ($value1 as $key2 => $value2): ?>
                                                            <?php if ($value2 == $v['id']): ?>
                                                                <?= "checked" ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        >
                                        <label class="form-check-label" for=" <?= $v['value'] ?>"
                                               style="font-size: 12px">
                                            <?= $v['value'] ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            <? endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>

                </form>
            </div>
            <div class="text-center" style="margin-left: -25px">
                <input type="submit" class="btn btn-warning mt-3" value="Знайти" name="submitFilter" form="filters">
                <input type="reset" class="btn btn-danger mt-3 btn-reset-filters" value="Скинути" name="resetFilter">
            </div>
        </div>
    <?php endif; ?>
    <div class="row row-cols-1 g-3 mx-2 mt-2 product-list w-100">
        <?php foreach ($products as $product): ?>
            <?php if (User::isUserAdmin() || (!User::isUserAdmin() && $product['visibility'] == 0)): ?>
                <div class="col col-sm-6 col-md-4 col-lg-3
    <?php if (User::isUserAdmin()): ?>
        <?= "col-xl-3 " ?>
    <?php else: ?>
        <?= "col-xl-3" ?>
    <?php endif; ?>
">
                    <div class="card rounded-5">

                        <div class="p-3 text-center pb-0">
                            <?php if (!User::isUserAdmin()): ?>
                                <div class="text-end addToListLikeBlock">
                                    <a href="" class="btnAddToLikeList
<?php if (isset($_SESSION['wish'][$product['id']])): ?>
                                        <?= " d-none" ?>
                                    <?php endif; ?>
" data-id="<?= $product['id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             fill="currentColor"
                                             class="bi bi-heart text-warning fw-bold button btnAddToLikeListIcon"
                                             viewBox="0 0 16 16">
                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                        </svg>
                                    </a>

                                    <a href="" class="btnProductInLikeList
<?php if (empty($_SESSION['wish'][$product['id']])): ?>
    <?= " d-none" ?>
<?php endif; ?>
" data-id="<?= $product['id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                             fill="currentColor"
                                             class="bi bi-heart-fill text-warning button btnProductInLikeListIcon"
                                             viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                  d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                        </svg>
                                    </a>

                                </div>
                            <?php endif; ?>
                            <a href="/product/view/<?= $product['id'] ?>" class="card-link">
                                <?php $filePath = 'files/product/' . $rows[$product['name']][0]['name']; ?>
                                <?php if (is_file($filePath)): ?>
                                    <img src="/<?= $filePath ?>" alt="" class="card-img-top mainPhotoProduct">
                                <?php else: ?>
                                    <img src="/files/product/default.jpg" alt="" class="card-img-top mainPhotoProduct">
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="card-body pt-2">
                            <div class="card-title mb-1 text-dark fw-bold"><?= $product['name'] ?></div>
                            <div class="d-flex justify-content-between ">
                                <div class="price text-dark fw-bolder fs-4">
                                    <?= $product['price'] ?> ₴
                                </div>
                                <?php if (!User::isUserAdmin()): ?>
                                    <div class="customerButtonsCardBody">
                                        <?php if ($product['count'] > 0): ?>
                                            <a href="/?product=add&id=<?= $product['id'] ?> "
                                               data-id="<?= $product['id'] ?>" class="btnProductAddToBasket
<?php if (!empty($_SESSION['basket'][$product['id']])) echo " d-none" ?>
">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                     fill="currentColor"
                                                     class="bi bi-cart2 text-success button btnProductAddToBasketIcon"
                                                     viewBox="0 0 16 16">
                                                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                                </svg>
                                            </a>
                                            <a href="/basket" class="btnProductInBasket
<?php if (empty($_SESSION['basket'][$product['id']])) echo " d-none" ?>
">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                     fill="currentColor"
                                                     class="btnProductInBasketIcon bi bi-cart-check-fill text-success button"
                                                     viewBox="0 0 16 16">
                                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                                </svg>
                                            </a>
                                        <?php else: ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                 fill="currentColor"
                                                 class="bi bi-cart-dash-fill text-secondary button btnProductNoProductIcon disabled"
                                                 viewBox="0 0 16 16">
                                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z"/>
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="adminButtonCardBody">
                                        <a href="/product/edit/<?= $product['id'] ?>" class="updateProduct">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                                                 fill="currentColor"
                                                 class="bi bi-arrow-clockwise text-success btnUpdateProduct"
                                                 viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                      d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                            </svg>
                                        </a>
                                        <a href="/product/delete/<?= $product['id'] ?>" class="deleteProduct">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                 fill="currentColor"
                                                 class="bi bi-x-circle text-danger btnDeleteProduct"
                                                 viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>