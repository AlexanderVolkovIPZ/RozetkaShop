<?php
/** @var array $errors */
/** @var array $model */
core\Core::getInstance()->pageParams['title'] = 'Реєстрація на сайті';
?>
<h1 class="text-center login-label fs-1 mb-1">Реєстрація</h1>

<form class="need-validation m-auto" novalidate="" style="max-width: 550px" method="post" action="" >
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="firstname" class="form-label">Ім'я</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" value="<?= $model['firstname'] ?>" required="" >
            <div class="invalid-feedback">
                <?php if (!empty($errors['firstname'])): ?>
                    <?= $errors['firstname'] ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-sm-6">
            <label for="lastname" class="form-label">Прізвище</label>
            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" value="<?= $model['lastname'] ?>" required="" >
            <div class="invalid-feedback">
                <?php if (!empty($errors['lastname'])): ?>
                    <?= $errors['lastname'] ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-sm-12">
            <label for="middlename" class="form-label">По-батькові</label>
            <input type="text" class="form-control" id="middlename" name="middlename" placeholder="" value="<?= $model['middlename'] ?>" required="">
            <div class="invalid-feedback">
                <?php if (!empty($errors['middlename'])): ?>
                    <?= $errors['middlename'] ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-12">
            <label for="login" class="form-label">Email</label>
            <input type="email" class="form-control" id="login" name="login" placeholder="you@gmail.com" value="<?= $model['login'] ?>">
            <div class="invalid-feedback">
                <?php if (!empty($errors['login'])): ?>
                    <?= $errors['login'] ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-12">
            <label for="password1" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password1" name="password1" value="<?= $model['password1'] ?>" aria-describedby="">
            <div class="invalid-feedback">
                <?php if (!empty($errors['password'])): ?>
                    <?= $errors['password'] ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-12">
            <label for="password2" class="form-label">Пароль (ще раз)</label>
            <input type="password" class="form-control" id="password2" name="password2" value="<?= $model['password2'] ?>">
            <div class="invalid-feedback">
                <?php if (!empty($errors['password'])): ?>
                    <?= $errors['password'] ?>
                <?php endif; ?>
            </div>
        </div>
    <hr class="my-4">
    <button class="w-100 btn btn-primary btn-lg" type="submit">Зареєструватися</button>
</form>
<script>
    let firstNameField = document.getElementById('firstname');
    let middleNameField = document.getElementById('middlename');
    let lastNameField = document.getElementById('lastname');
    let loginField = document.getElementById('login');
    let password1Field = document.getElementById('password1');
    let password2Field  = document.getElementById('password2');
    let invalidFeedback = document.querySelectorAll('.invalid-feedback');


    firstNameField.addEventListener('change',()=>{
        if (firstNameField.value === ""){
            firstNameField.classList.add('is-invalid');
            firstNameField.classList.remove('is-valid');

        }else{
            firstNameField.classList.add('is-valid');
            firstNameField.classList.remove('is-invalid');
        }
    })

    middleNameField.addEventListener('change',()=>{
        if (middleNameField.value === ""){
            middleNameField.classList.add('is-invalid');
            middleNameField.classList.remove('is-valid');
        }else{
            middleNameField.classList.add('is-valid');
            middleNameField.classList.remove('is-invalid');
        }
    })

    lastNameField.addEventListener('change',()=>{
        if (lastNameField.value === ""){
            lastNameField.classList.add('is-invalid');
            lastNameField.classList.remove('is-valid');
        }else{
            lastNameField.classList.add('is-valid');
            lastNameField.classList.remove('is-invalid');
        }
    })


    loginField.addEventListener('change',()=>{
        var pattern = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
        if (loginField.value === ""|| pattern.test(loginField.value)===false){
            loginField.classList.add('is-invalid');
            loginField.classList.remove('is-valid');
        }else{
            loginField.classList.add('is-valid');
            loginField.classList.remove('is-invalid');
        }
    })

    password1Field.addEventListener('change',()=>{
        if (password1Field.value === "" || (password2Field.value!=="" && password1Field.value!==password2Field.value)){
            password1Field.classList.add('is-invalid');
            password1Field.classList.remove('is-valid');
        }else{
            password1Field.classList.add('is-valid');
            password1Field.classList.remove('is-invalid');
            if(password1Field.value===password2Field.value){
                password2Field.classList.add('is-valid');
                password2Field.classList.remove('is-invalid');
            }
        }
    })

    password2Field.addEventListener('change',()=>{
        if (password2Field.value === "" || (password1Field.value!=="" && password1Field.value!==password2Field.value)){
            password2Field.classList.add('is-invalid');
            password2Field.classList.remove('is-valid');
        }else{
            password2Field.classList.add('is-valid');
            password2Field.classList.remove('is-invalid');
            if(password1Field.value===password2Field.value){
                password1Field.classList.add('is-valid');
                password1Field.classList.remove('is-invalid');
            }
        }
    })


    for(let i = 0;i<invalidFeedback.length;i++){
        if(invalidFeedback[i].innerText.trim().length!==0){
            // alert(invalidFeedback[i].innerText);
            // alert(invalidFeedback[i].length)
            invalidFeedback[i].previousElementSibling.classList.add('is-invalid');
            invalidFeedback[i].previousElementSibling.classList.remove('is-valid');
        }
    }

</script>





<!--<main class="form-signin w-100 m-auto">-->
<!--    <form action="" method="post">-->
<!--        <div>-->
<!--            <label for="login">Логін:</label>-->
<!--        </div>-->
<!--        <div>-->
<!--            <input type="text" name="login" id="login" value="--><?//= $model['login'] ?><!--">-->
<!--            --><?php //if (!empty($errors['login'])): ?>
<!--                <span class="error">--><?//= $errors['login'] ?><!--</span>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--        <div>-->
<!--            <label for="password1">Пароль:</label>-->
<!--        </div>-->
<!--        <div>-->
<!--            <input type="password" name="password1" id="password1" value="--><?//= $model['password1'] ?><!--">-->
<!--            --><?php //if (!empty($errors['password'])): ?>
<!--                <span class="error">--><?//= $errors['password'] ?><!--</span>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--        <div>-->
<!--            <label for="password2">Пароль(ще раз):</label>-->
<!--        </div>-->
<!--        <div>-->
<!--            <input type="password" name="password2" id="password2" value="--><?//= $model['password2'] ?><!--">-->
<!--        </div>-->
<!--        <div>-->
<!--            <label for="firstname">Ім'я:</label>-->
<!--        </div>-->
<!--        <div>-->
<!--            <input type="text" name="firstname" id="firstname" value="--><?//= $model['firstname'] ?><!--">-->
<!--            --><?php //if (!empty($errors['firstname'])): ?>
<!--                <span class="error">--><?//= $errors['firstname'] ?><!--</span>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--        <div>-->
<!--            <label for="middlename">Прізвище:</label>-->
<!--        </div>-->
<!--        <div>-->
<!--            <input type="text" name="middlename" id="middlename" value="--><?//= $model['middlename'] ?><!--">-->
<!--            --><?php //if (!empty($errors['middlename'])): ?>
<!--                <span class="error">--><?//= $errors['middlename'] ?><!--</span>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--        <div>-->
<!--            <label for="lastname">По-батькові:</label>-->
<!--        </div>-->
<!--        <div>-->
<!--            <input type="text" name="lastname" id="lastname" value="--><?//= $model['lastname'] ?><!--">-->
<!--            --><?php //if (!empty($errors['lastname'])): ?>
<!--                <span class="error">--><?//= $errors['lastname'] ?><!--</span>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--        <button>-->
<!--            Зареєструватися-->
<!--        </button>-->
<!--    </form>-->
<!--</main>-->