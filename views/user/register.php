<?php
/** @var array $errors */
/** @var array $model */
core\Core::getInstance()->pageParams['title'] = 'Реєстрація на сайті';
?>
<h1 class="text-center login-label fs-1 mb-1">Реєстрація</h1>

<form class="need-validation m-auto" novalidate="" style="max-width: 550px" method="post" action="">
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="firstname" class="form-label">Ім'я</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder=""
                   value="<?= $model['firstname'] ?>" required="">
            <div class="invalid-feedback">
                <?php if (!empty($errors['firstname'])): ?>
                    <?= $errors['firstname'] ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-sm-6">
            <label for="lastname" class="form-label">Прізвище</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder=""
                   value="<?= $model['lastname'] ?>" required="">
            <div class="invalid-feedback">
                <?php if (!empty($errors['lastname'])): ?>
                    <?= $errors['lastname'] ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-sm-12">
            <label for="middlename" class="form-label">По-батькові</label>
            <input type="text" class="form-control" id="middlename" name="middlename" placeholder=""
                   value="<?= $model['middlename'] ?>" required="">
            <div class="invalid-feedback">
                <?php if (!empty($errors['middlename'])): ?>
                    <?= $errors['middlename'] ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-12">
            <label for="login" class="form-label">Email</label>
            <input type="email" class="form-control" id="login" name="login" placeholder="you@gmail.com"
                   value="<?= $model['login'] ?>">
            <div class="invalid-feedback">
                <?php if (!empty($errors['login'])): ?>
                    <?= $errors['login'] ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-12">
            <label for="password1" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password1" name="password1"
                   value="<?= $model['password1'] ?>" aria-describedby="">
            <div class="invalid-feedback">
                <?php if (!empty($errors['password'])): ?>
                    <?= $errors['password'] ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-12">
            <label for="password2" class="form-label">Пароль (ще раз)</label>
            <input type="password" class="form-control" id="password2" name="password2"
                   value="<?= $model['password2'] ?>">
            <div class="invalid-feedback">
                <?php if (!empty($errors['password'])): ?>
                    <?= $errors['password'] ?>
                <?php endif; ?>
            </div>
        </div>
        <hr class="my-4">
        <button class="w-100 btn btn-primary btn-lg" type="submit">Зареєструватися</button>
</form>
