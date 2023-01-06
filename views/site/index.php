<?php
/** @var array $rows */
/** @var array $slider */
use models\User;
use core\Core;
?>
<div class="row">
    <div class="col-2 category-group" style="border-right: 1px solid white; min-width: 150px">
        <div class="text-center d-block">
            <nav class="nav text-start d-inline-block" style="box-sizing: content-box">
                <?php foreach ($rows as $row): ?>

                    <a class="nav-link px-0" href="/category/view/<?= $row['id'] ?>">
                        <img src="/files/category/<?= $row['photo'] ?>" style="width: 20px"/>
                        <?= $row['name'] ?>
                    </a>
                <?php endforeach; ?>
                <a class="nav-link px-0 btnSettings" href="/user/settings">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gear text-dark" viewBox="0 0 16 16">
                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                    </svg>
                    Налаштування
                </a>
            </nav>
        </div>
    </div>

    <div class="col-10 mt-3 slider " id="slider-main">
        <div id="carouselExampleFade" class="carousel slide carousel-fade container-fluid w-auto mx-5"
             data-bs-ride="carousel">
            <div class="carousel-inner rounded-4">
                <?php if(!empty($slider)):?>
                    <?php foreach ($slider as $slide):?>
                    <?php if ($slide['first_image']==1):?>
                            <div class="carousel-item active">
                                <a href="<?=$slide['url']?>">
                                    <img src="/files/discount/<?=$slide['name']?>" class="d-block w-100" alt="...">
                                </a>
                            </div>
                    <?php else:?>
                            <div class="carousel-item">
                                <a href="<?=$slide['url']?>">
                                    <img src="/files/discount/<?=$slide['name']?>" class="d-block w-100" alt="...">
                                </a>
                            </div>
                    <?php endif;?>
                    <?php endforeach;?>
                <?php else: ?>
                    <div class="carousel-item active">
                        <img src="/files/discount/default.jpg" class="d-block w-100" alt="...">
                    </div>
                <?php endif; ?>


            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>
</div>
