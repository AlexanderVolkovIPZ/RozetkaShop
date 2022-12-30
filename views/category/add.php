<?php
/** @var array $model */
/** @var array $errors */

?>
<form action="" method="post"  enctype="multipart/form-data" class="container">
    <h2 class="mt-3">Додавання категорії</h2>
    <div class="input-group mb-1">
        <span class="input-group-text" id="inputGroup-sizing-default">Назва категорії</span>
        <input type="text" class="form-control" name="name" aria-label="Пример размера поля ввода" aria-describedby="inputGroup-sizing-default">
    </div>
    <?php if(!empty($errors['name']) and $_POST):?>
        <div id="categoryName" class="text-danger form-text mb-3"><?=$errors['name']?></div>
    <?php endif;?>
    <div class="mb-3">
        <label for="formFile" class="form-label">Файл з фотографією для категорії</label>
        <input class="form-control filesSelectedForCategory" type="file" name="file" id="formFile" accept="image/svg+xml, image/png">
    </div>

    <div class="divSelectedFilesForCategory d-flex flex-wrap">

    </div>

    <button class="btn btn-primary" type="submit">Створити категорію</button>
</form>
