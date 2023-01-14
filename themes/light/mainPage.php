<?php
/** @var string $title */
/** @var array $rows */
/** @var string $siteName */
/** @var array $product */
$rows = \models\Category::getCategories();

use core\Core;
use \models\User;

if (User::isAuthenticatedUser())
    $user = User::getCarrentAuthenticatedUser();
else
    $user = null;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nosifer&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/themes/light/css/style.css">
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"
    />
    <title><?= $title ?></title>
</head>
<body>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="home" viewBox="0 0 16 16">
        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
    </symbol>
    <symbol id="speedometer2" viewBox="0 0 16 16">
        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
        <path fill-rule="evenodd"
              d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
    </symbol>
    <symbol id="table" viewBox="0 0 16 16">
        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
    </symbol>
    <symbol id="people-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd"
              d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
    </symbol>
    <symbol id="grid" viewBox="0 0 16 16">
        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
    </symbol>
</svg>

<header>
    <div class="py-2 text-bg-dark header w-100 main-header">
        <div class="container justify-content-center">
            <div class="d-flex flex-wrap align-items-center
            <?php if (User::isUserAdmin()) : ?>
            <?= "justify-content-between" ?>
            <?php else: ?>
            <?= "justify-content-center" ?>
            <?php endif; ?>
             ">
                <a class="fs-2 fw-bold labelRozetka flex-shrink-1" href="/">

                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="40" viewBox="0 0 10 40" fill="none">
                        <path d="M41.0255 20.0882C40.9803 31.1355 31.7406 40.0439 20.4225 39.9998C9.10435 39.9557 -0.0450154 30.9591 0.000166623 19.9118C0.0453487 8.86448 9.28508 -0.043938 20.6032 0.000163037C31.9439 0.0442641 41.0707 9.04088 41.0255 20.0882Z"
                              fill="#221F1F"/>
                        <path d="M27.9005 29.9007C25.7318 33.6934 23.0435 36.8025 20.0388 36.7364C18.1638 36.6922 16.3791 36.0087 14.7525 34.9282C15.2721 34.0021 18.5478 29.3715 27.9005 29.9007ZM40.4837 20.0882C40.4385 30.8268 31.4473 39.5147 20.4229 39.4486C9.39847 39.4045 0.542786 30.6504 0.542786 19.9118C0.542786 12.9438 4.11217 7.93834 7.50082 5.24818C11.6576 1.96265 14.4815 4.47641 15.4755 6.39481C15.3625 5.57894 15.0236 3.24158 14.0974 1.56574C16.1306 0.882172 18.3219 0.507313 20.6036 0.529363C31.628 0.595515 40.5289 9.32753 40.4837 20.0882ZM19.4515 8.88652C22.3431 6.96812 27.3357 5.90969 29.9789 9.92289C28.3749 0.749869 21.4395 6.01995 19.4515 8.88652ZM15.4303 17.5524C16.0402 16.8909 16.7406 16.2293 17.5538 15.634C21.1684 12.9218 25.1218 12.2382 26.4095 14.1345C26.9065 14.8622 26.9291 15.8765 26.5451 16.9791C27.8328 14.9063 28.2394 12.9879 27.4487 11.9295C26.1158 10.1654 21.9817 11.3782 18.209 14.6417C17.102 15.5458 16.1758 16.5601 15.4303 17.5524ZM9.12738 19.1841C10.9573 19.5149 12.9453 17.2437 13.5552 14.0684C14.1652 10.8931 13.1938 8.07065 11.3639 7.71784C9.53402 7.38708 7.54601 9.65829 6.93605 12.8336C6.32609 15.9868 7.2975 18.8313 9.12738 19.1841ZM34.5649 15.3473C17.0568 26.7916 4.97063 20.9923 4.97063 20.9923C4.7899 24.9614 11.7705 37.1553 20.084 37.3097C28.4201 37.464 34.5649 15.3473 34.5649 15.3473ZM7.43305 12.8997C7.99783 9.98905 9.71474 7.87219 11.2735 8.1809C12.8323 8.46756 13.6456 11.0695 13.1034 13.9802C12.5386 16.8909 10.8217 19.0077 9.26292 18.699C7.68155 18.4124 6.86827 15.8104 7.43305 12.8997ZM10.7539 15.3694C11.4543 15.5237 12.2223 14.6858 12.4934 13.5171C12.7645 12.3485 12.4031 11.268 11.7028 11.1357C11.2283 11.0254 10.7313 11.3782 10.3699 11.9736C10.6862 12.1279 10.8443 12.5249 10.6862 12.8556C10.5506 13.1643 10.2343 13.3187 9.91806 13.2525C9.78252 14.2889 10.1214 15.215 10.7539 15.3694Z"
                              fill="#05BC52"/>
                    </svg>
                    <span class="label_Rozetka">
                        Rozetka
                    </span>
                </a>

                <?php if (!User::isUserAdmin()) : ?>
                    <form method="get" enctype="multipart/form-data" action="/category/view" name="formSearch"
                          class="input-group m-auto searchProductWrapper" style="max-width: 350px">
                        <input type="text" autocomplete="off" class="form-control searchProduct"
                               placeholder="Я шукаю..."
                               aria-label="Имя пользователя получателя" name="searchName"
                               aria-describedby="button-addon2">
                        <button class="btn btn-success" type="submit" name="findProducts" value="btnLiveSearch"
                                id="button-addon2">Знайти
                        </button>
                    </form>
                    <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small align-items-center gap-3">
                        <li>
                            <a type="button" href="/" class="btn btn-secondary nav-link text-white d-flex ">

                                <svg class="bi d-block mx-auto mb-1 " width="24" height="24">
                                    <use xlink:href="#grid"></use>
                                </svg>
                                <span class="px-1">Каталог</span>
                            </a>
                        </li>
                        <?php if (User::isAuthenticatedUser()) : ?>
                            <li>
                                <a type="button" href="/orders_story/" class="btn btn-dark storyOrders">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="bi bi-card-list" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"></path>
                                        <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"></path>
                                    </svg>
                                </a>
                            </li>

                            <li>
                                <a type="button" href="/wish/" class="btn btn-dark position-relative wishList">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                    </svg>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger wishListCount">
                                        <?php if (isset($_SESSION['wish'])) {
                                            $count = 0;
                                            foreach ($_SESSION['wish'] as $key => $value) {
                                                $count += $value;
                                            }
                                            echo $count;
                                        } else {
                                            echo 0;
                                        }
                                        ?>

                                    </span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a type="button" class="btn btn-dark position-relative basket" href="/basket">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                     class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success countProductsInBasket">
                                    <?php if (isset($_SESSION['basket'])) {
                                        $count = 0;
                                        foreach ($_SESSION['basket'] as $key => $value) {
                                            $count += $value;
                                        }
                                        echo $count;
                                    } else {
                                        echo 0;
                                    }
                                    ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
                <?php if (User::isUserAdmin()) : ?>
                    <div class="d-flex gap-2">
                        <a type="button" class="btn btn-danger mx-2" href="/user/logout">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                <path fill-rule="evenodd"
                                      d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                            </svg>
                            Вийти
                        </a>
                        <div class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow d-block menu-burger-admin">
                            <button class="  navbar-toggler position-absolute d-sm-none collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (!User::isUserAdmin()) : ?>
        <div class="px-3 py-2 border-bottom">
            <div class="container d-flex flex-wrap justify-content-end">
                <div class="text-end">
                    <?php if (User::isAuthenticatedUser()) : ?>
                        <a type="button" class="btn btn-danger" href="/user/logout">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                                <path fill-rule="evenodd"
                                      d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                            </svg>
                            Вийти
                        </a>
                    <?php else: ?>
                        <a type="button" class="btn btn-success" href="/user/login">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"></path>
                                <path fill-rule="evenodd"
                                      d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"></path>
                            </svg>
                            Ввійти
                        </a>
                        <a href="/user/register" type="button" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            Реєстрація
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</header>

<div class="main <?php if (!User::isUserAdmin()) echo "container-fluid" ?> <?php if (User::isUserAdmin()) echo "d-flex" ?>">
    <?php if (User::isUserAdmin()): ?>
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 col-sm-4 col-12 d-md-block bg-light sidebar collapse h-75">
            <div class="position-sticky pt-3 sidebar-sticky">
                <ul class="nav flex-column" style="height: 500px">
                    <li class="nav-item">
                        <a aria-current="page" href="#"
                           class=" nav-link btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                           data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                 class="bi bi-list-ul" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg>
                            <span class="px-1">Категорія</span>

                        </a>
                        <div class="collapse mx-5" id="home-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="/category/add"
                                       class="link-success d-inline-flex text-decoration-none rounded">Додати</a>
                                </li>
                                <li><a href="#"
                                       class="align-items-center link-primary d-inline-flex text-decoration-none rounded collapsed"
                                       data-bs-toggle="collapse" data-bs-target="#select-category-update"
                                       aria-expanded="false">Змінити
                                    </a></li>
                                <div class="collapse mx-4 w-100" id="select-category-update" style="">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        <?php foreach ($rows as $row): ?>
                                            <li><a href="/category/edit/<?= $row['id'] ?>"
                                                   class="link-dark d-inline-flex text-decoration-none rounded"><?= $row['name'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <li><a href="#"
                                       class="align-items-center link-danger d-inline-flex text-decoration-none rounded collapsed"
                                       data-bs-toggle="collapse" data-bs-target="#select-category-delete"
                                       aria-expanded="false">Видалити
                                    </a></li>
                                <div class="collapse mx-4" id="select-category-delete" style="">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        <?php foreach ($rows as $row): ?>
                                            <li><a href="/category/delete/<?= $row['id'] ?>"
                                                   class="link-dark d-inline-flex text-decoration-none rounded"><?= $row['name'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a aria-current="page" href="#"
                           class=" nav-link btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                           data-bs-toggle="collapse" data-bs-target="#tovars" aria-expanded="false">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                 class="bi bi-bag" viewBox="0 0 16 16">
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                            </svg>
                            <span class="px-1">Товари</span>

                        </a>
                        <div class="collapse productDivNav" id="tovars" style="margin-left: 50px">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small w-100">
                                <li><a href="/product/add"
                                       class="link-success d-inline-flex text-decoration-none rounded">Додати в
                                        категорію</a>

                                <li><a href="#"
                                       class="align-items-center link-primary d-inline-flex text-decoration-none rounded collapsed"
                                       data-bs-toggle="collapse" data-bs-target="#select-product-edit"
                                       aria-expanded="false">Оновити/видалити в категорії
                                    </a></li>
                                <div class="collapse mx-4" id="select-product-edit" style="">
                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                        <?php foreach ($rows as $row): ?>
                                            <li><a href="/category/view/<?= $row['id'] ?>"
                                                   class="link-dark d-inline-flex text-decoration-none rounded"><?= $row['name'] ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a aria-current="page" href="#"
                           class=" nav-link btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                           data-bs-toggle="collapse" data-bs-target="#slider" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                 class="bi bi-collection" viewBox="0 0 16 16">
                                <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm1.5.5A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-13z"/>
                            </svg>
                            <span class="px-1">Слайдер</span>
                        </a>
                        <div class="collapse mx-5" id="slider" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                <li><a href="/slider/add"
                                       class="link-success d-inline-flex text-decoration-none rounded">Додати</a></li>
                                <li><a href="/slider/delete"
                                       class="link-danger d-inline-flex text-decoration-none rounded">Видалити</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/order">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-file align-text-bottom" aria-hidden="true">
                                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                <polyline points="13 2 13 9 20 9"></polyline>
                            </svg>
                            Замовлення
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/chart">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-users align-text-bottom" aria-hidden="true">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Користувачі
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user/settings">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                 class="bi bi-gear" viewBox="0 0 16 16">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                            </svg>
                            Налаштування
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php endif; ?>
    <?= $content ?>
</div>

<div class="container footer">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
        </symbol>
        <symbol id="instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
        </symbol>
        <symbol id="twitter" viewBox="0 0 16 16">
            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
        </symbol>
    </svg>
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <span class="mb-3 mb-md-0 text-muted">© 2022 Company, Inc</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-muted" href="#">
                    <svg class="bi" width="24" height="24">
                        <use xlink:href="#twitter"></use>
                    </svg>
                </a></li>
            <li class="ms-3"><a class="text-muted" href="#">
                    <svg class="bi" width="24" height="24">
                        <use xlink:href="#instagram"></use>
                    </svg>
                </a></li>
            <li class="ms-3"><a class="text-muted" href="#">
                    <svg class="bi" width="24" height="24">
                        <use xlink:href="#facebook"></use>
                    </svg>
                </a></li>
        </ul>
    </footer>
</div>

<script src="/themes/light/js/index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
</body>
</html>