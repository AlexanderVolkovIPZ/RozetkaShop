<?php
/** @var array $category */
?>


<div class="alert alert-danger container mt-3 mx-3 h-25" role="alert">
    <h4 class="alert-heading">Чи дійсно ви бажаєте видалити категорію "<b><?=$category['name']?></b>"?</h4>
    <p>Після видалення категорії, відповідні товари категорії будуть невизначеними!</p>
    <hr>
    <a href="/category/delete/<?=$category['id']?>/confirm" class="btn btn-danger" >Видалити</a>
    <a href="/" class="btn btn-success" >Відмінити</a>
</div>