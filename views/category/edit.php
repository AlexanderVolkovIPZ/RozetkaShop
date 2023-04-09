<?php
/** @var array $category */
/** @var array $model */
/** @var array $errors */
/** @var array $filters*/
/** @var array $categoryFilter*/
die();
?>

<form action="" method="post" enctype="multipart/form-data" class="container">
    <h2 class="mt-3">Зміна категорії</h2>
    <div class="input-group ">
        <span class="input-group-text" id="inputGroup-sizing-default">Назва категорії</span>
        <input type="text" class="form-control" value="<?= $category['name'] ?>" name="name"
               aria-label="Пример размера поля ввода" aria-describedby="inputGroup-sizing-default">
    </div>
    <?php if (!empty($errors['name']) and $_POST): ?>
        <div id="categoryName" class="text-danger form-text mb-3"><?= $errors['name'] ?></div>
    <?php endif; ?>
    <div class="mb-3">
        <?php $filePath = 'files/category/' . $category['photo'] ?>
        <?php if (is_file($filePath)): ?>
            <img src="<?= '/' . $filePath ?>" class="img-thumbnail col-1 mt-2 mb-1 alt=" ...">
        <?php else: ?>
            <img src="/files/category/default.svg" class="img-thumbnail" alt="...">
        <?php endif; ?>
        <label for="formFile" class="form-label w-100">Файл з фотографією для категорії</label>
        <input class="form-control" value="" type="file" name="file" id="formFile" accept="image/svg+xml, image/png">
    </div>

    <?php if(!empty($filters)):?>
        <div class="mt-3 mb-3">
            <?php foreach ($filters as $key=>$value):?>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="filters[]"

                           <?php foreach ($categoryFilter as $keyFilter=>$valueFilter):?>
                                <?php if ($value['id']==$valueFilter['filter_id']): ?>
                                    <?="checked"?>
                                <?endif;?>
                            <?php endforeach;?>
                           value="<?=$value['id']?>" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    <label class="form-check-label" for="flexSwitchCheckDefault"><?=$value['name']?></label>
                </div>
            <?php endforeach;?>
        </div>
    <?php endif;?>


    <button class="btn btn-primary" type="submit">Змінити категорію</button>
</form>
