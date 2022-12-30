<?php
/** @var array $product */
/** @var array $categories */
/** @var array $productPhoto */
//var_dump($productPhoto);
//echo "<pre>";
//var_dump($product);

?>


<form action="" method="post" enctype="multipart/form-data" class="container">
    <h2 class="mt-3">Зміна товару</h2>

    <div class="">
        <label for="name" class="form-label">Назва товару</label>
        <input type="text" class="form-control" value="<?= $product['name'] ?>" name="name"
               aria-label="Пример размера поля ввода">
        <?php if (!empty($errors['name']) and $_POST): ?>
            <div class="text-danger form-text mb-1"><?= $errors['name'] ?></div>
        <?php endif; ?>
    </div>

    <div class="mt-3">
        <label for="id_category" class="form-label">Категорія товару</label>
        <select class="form-select" id="id_category" name="id_category">
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"
                    <?php if ($category['id'] == $product['id_category']): ?>
                        <?= "selected" ?>
                    <?php endif; ?>

                ><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['id_category']) and $_POST): ?>
            <div class="text-danger form-text mb-1"><?= $errors['id_category'] ?></div>
        <?php endif; ?>
    </div>

    <div class="mt-3">
        <label for="count" class="form-label">Кількість товару</label>
        <input type="number" min="0" value="<?= $product['count'] ?>" class="form-control" name="count"
               aria-label="Пример размера поля ввода">
        <?php if (!empty($errors['count']) and $_POST): ?>
            <div class="text-danger form-text mb-1"><?= $errors['count'] ?></div>
        <?php endif; ?>
    </div>

    <div class="mt-3">
        <label for="price" class="form-label">Ціна товару</label>
        <input type="number" min="0" value="<?= $product['price'] ?>" class="form-control" name="price"
               aria-label="Пример размера поля ввода">
        <?php if (!empty($errors['price']) and $_POST): ?>
            <div class="text-danger form-text mb-1"><?= $errors['price'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mt-3">
        <label for="brief_description" class="form-label">Короткий опис товару</label>
        <textarea class="form-control ckeditor" name="brief_description" id="brief_description" cols="30"
                  rows="5"><?= $product['brief_description'] ?></textarea>
        <?php if (!empty($errors['brief_description']) and $_POST): ?>
            <div class="text-danger form-text mb-1"><?= $errors['brief_description'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mt-3">
        <label for="full_description" class="form-label">Повний опис товару</label>
        <textarea class="form-control ckeditor" name="full_description" id="full_description" cols="30"
                  rows="10"><?= $product['full_description'] ?></textarea>
        <?php if (!empty($errors['full_description']) and $_POST): ?>
            <div class="text-danger form-text mb-1"><?= $errors['full_description'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mt-3">
        <label for="visibility" class="form-label">Відображення товару покупцеві</label>
        <select class="form-select" id="visibility" name="visibility">
            <option value="0" <?php if ($product['visibility'] == 0): ?>
                <?= "selected" ?>
            <?php endif; ?>
            >Відображати
            </option>
            <option value="1" <?php if ($product['visibility'] == 1): ?>
                <?= "selected" ?>
            <?php endif; ?>
            >Не відображати
            </option>
        </select>
        <?php if (!empty($errors['visibility']) and $_POST): ?>
            <div class="text-danger form-text mb-1"><?= $errors['visibility'] ?></div>
        <?php endif; ?>
    </div>
    <div class="mt-3">
        <?php if (!empty($productPhoto)): ?>
            <?php foreach ($productPhoto as $photo): ?>
                <?php $filePath = 'files/product/' . $photo['name'] ?>
                <?php if (is_file($filePath)): ?>
                    <img src="<?= '/' . $filePath ?>" class="img-thumbnail col-1 mt-2 mb-1 alt=" ...">
                <?php else: ?>
                    <img src="/files/product/default.png" class="img-thumbnail" alt="...">
                <?php endif; ?>
            <?php endforeach; ?>
            <label for="formFile" class="form-label d-block mb-1">Файли з фотографією для товару</label>
        <?php endif; ?>
        <input class="form-control mt-3 formNewPhotoUpdate" multiple type="file" name="file[]" id="formFile"
               accept=" image/png, image/jpeg">
        <div class="newPhotoUpdateProduct"></div>


    </div>
    <button class="btn btn-primary mt-3" type="submit">Зробити зміну</button>
</form>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script>
    let selectList = document.querySelector("[name = 'id_product']");
    selectList.addEventListener('change', () => {
        var index = +selectList.selectedIndex;
        document.querySelector("[name = 'count']").setAttribute('value', '<' + `?=$products[${index}]['count']?>`)
        alert(document.querySelector("[name = 'count']").textContent)
    })


</script>
<script>
    let textEditors = document.querySelectorAll('.ckeditor');
    for (const textEditor of textEditors) {
        ClassicEditor
            .create(textEditor)
            .catch(error => {
                console.error(error);
            });
    }
</script>


