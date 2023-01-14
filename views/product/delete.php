<?php
/** @var array $product */
?>
<div class="alert alert-danger container mt-3 mx-3 h-25" role="alert">
    <h4 class="alert-heading">Чи дійсно ви бажаєте видалити товар "<b><?= $product['name'] ?></b>"?</h4>
    <p>Після видалення товару, відповідні фото товару будуть видалені!</p>
    <hr>
    <a href="/product/delete/<?= $product['id'] ?>/confirm" class="btn btn-danger">Видалити</a>
    <a href="/" class="btn btn-success">Відмінити</a>
</div>