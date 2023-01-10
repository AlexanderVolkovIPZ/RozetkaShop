<?php
/** @var array $products */
/** @var array $photoProduct */
//echo "<pre>";
//var_dump($photoProduct);
//var_dump($photoProduct);
//var_dump($products);
?>
<div class="row row-cols-1 g-3 mx-2 mt-2 product-list w-100 wishListMainWrapper">
    <?php foreach ($products as $product): ?>
        <div class="col col-sm-6 col-md-3 col-lg-3 col-xl-3 wishSectionWrapper">
            <div class="card rounded-5 ">
                <div class="p-3 text-center pb-0">

                    <div class="text-end addToListLikeBlock ">
                        <a href="" class="btnAddToLikeList d-none" data-id="<?= $product['id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                 class="bi bi-heart text-warning fw-bold button btnAddToLikeListIcon btnWishProductIcon"
                                 viewBox="0 0 16 16">
                                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                            </svg>
                        </a>
                        <a href="" class="btnProductInLikeList wishSection" data-id="<?= $product['id'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                 class="bi bi-heart-fill text-warning button btnProductInLikeListIcon btnWishProductIcon"
                                 viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </a>
                    </div>
                    <a href="/product/view/<?= $product['id'] ?>" class="card-link">
                        <?php $filePath = 'files/product/' .$photoProduct[$product['id']]['name']; ?>
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
                    </div>
                </div>
                <?php ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
