<?php
/** @var string|null $error */
core\Core::getInstance()->pageParams['title'] = 'Вхід на сайт';
?>
<h1 class="text-center login-label fs-1 mb-3">Авторизація</h1>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger d-flex align-items-center m-auto mb-3" role="alert" style="max-width: 350px">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
             class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16 ">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div class="">
            <?= $error ?>
        </div>
    </div>
<?php endif; ?>

<main class="form-signing w-100 m-auto" style="max-width: 350px;">
    <form action="" method="post">
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" name="login" placeholder="name@example.com">
            <label for="floatingInput">Електронна пошта</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
            <label for="floatingPassword">Пароль</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Увійти</button>
    </form>
</main>
