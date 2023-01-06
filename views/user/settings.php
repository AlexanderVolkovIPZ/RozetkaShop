<?php
/** @var array $errors */
/** @var array $user */

?>
<!--<h1 class="text-center login-label fs-1 mb-3">Налаштування</h1>-->
<!---->
<!--<form class="need-validation m-auto" novalidate="" style="max-width: 550px" method="post" action="" >-->
<!--    <div class="row g-3">-->
<!--        <div class="col-sm-6">-->
<!--            <label for="firstname" class="form-label">Ім'я</label>-->
<!--            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="" value="--><? //= $model['firstname'] ?><!--" required="" >-->
<!--            <div class="invalid-feedback">-->
<!--                --><?php //if (!empty($errors['firstname'])): ?>
<!--                    --><? //= $errors['firstname'] ?>
<!--                --><?php //endif; ?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="col-sm-6">-->
<!--            <label for="lastname" class="form-label">Прізвище</label>-->
<!--            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="" value="--><? //= $model['lastname'] ?><!--" required="" >-->
<!--            <div class="invalid-feedback">-->
<!--                --><?php //if (!empty($errors['lastname'])): ?>
<!--                    --><? //= $errors['lastname'] ?>
<!--                --><?php //endif; ?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="col-sm-12">-->
<!--            <label for="middlename" class="form-label">По-батькові</label>-->
<!--            <input type="text" class="form-control" id="middlename" name="middlename" placeholder="" value="--><? //= $model['middlename'] ?><!--" required="">-->
<!--            <div class="invalid-feedback">-->
<!--                --><?php //if (!empty($errors['middlename'])): ?>
<!--                    --><? //= $errors['middlename'] ?>
<!--                --><?php //endif; ?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="col-12">-->
<!--            <label for="login" class="form-label">Email</label>-->
<!--            <input type="email" class="form-control" id="login" name="login" placeholder="you@gmail.com" value="--><? //= $model['login'] ?><!--">-->
<!--            <div class="invalid-feedback">-->
<!--                --><?php //if (!empty($errors['login'])): ?>
<!--                    --><? //= $errors['login'] ?>
<!--                --><?php //endif; ?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="col-12">-->
<!--            <label for="password1" class="form-label">Пароль</label>-->
<!--            <input type="password" class="form-control" id="password1" name="password1" value="--><? //= $model['password1'] ?><!--" aria-describedby="">-->
<!--            <div class="invalid-feedback">-->
<!--                --><?php //if (!empty($errors['password'])): ?>
<!--                    --><? //= $errors['password'] ?>
<!--                --><?php //endif; ?>
<!--            </div>-->
<!--        </div>-->
<!--        <div class="col-12">-->
<!--            <label for="password2" class="form-label">Пароль (ще раз)</label>-->
<!--            <input type="password" class="form-control" id="password2" name="password2" value="--><? //= $model['password2'] ?><!--">-->
<!--            <div class="invalid-feedback">-->
<!--                --><?php //if (!empty($errors['password'])): ?>
<!--                    --><? //= $errors['password'] ?>
<!--                --><?php //endif; ?>
<!--            </div>-->
<!--        </div>-->
<!--        <hr class="my-4">-->
<!--        <button class="w-100 btn btn-danger btn-lg" type="submit">Видалити аккаунт</button>-->
<!--</form>-->
<!--<script>-->
<div class="accordion accordion-flush mx-auto mt-3 w-100" id="accordionFlushExample" style="max-width: 500px">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                     class="bi bi-person-circle svgUserDates" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                    <path fill-rule="evenodd"
                          d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
                Особисті дані
            </button>
        </h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                 data-bs-parent="#accordionFlushExample">
                <div class="accordion-body row">

                    <div class="col-4">
                        <label class="text-secondary" for="firstNameEdit">Ім'я</label>
                        <div class="firstName mt-2">
                            <span class="firstNameLabel"><?= $user['firstName'] ?></span>
                            <input type="text" name="firstName" id="firstNameEdit" class="w-100 d-none firstNameInput form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="text-secondary" for="middleNameEdit">Прізвище</label>
                        <div class="middleName mt-2">
                            <span class="middleNameLabel"><?= $user['middleName'] ?></span>
                            <input type="text" name="middleName" id="middleNameEdit"
                                   class="w-100 firstNameEdit d-none middleNameInput form-control">
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="lastNameEdit" class=" text-secondary">По-батькові</label>
                        <div class="lastName mt-2">
                            <span class="lastNameLabel"><?= $user['lastName'] ?></span>
                            <input type="text" name="lastName" id="lastNameEdit"
                                   class="w-100 firstNameEdit d-none lastNameInput form-control">
                        </div>
                    </div>
                    <div class="col-3">
                        <a class="btn btn-success mt-3 btnEditUserDates">Редагувати</a>
                    </div>
                    <div class="d-none">
                        <button class="btn btn-primary mt-3 btnCreateChange" type="submit">Змінити</button>
                        <a class="btn btn-danger mt-3 btnNoChange">Відміна</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                     class="bi bi-lock svgUserLogin" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                </svg>
                Логін
            </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
             data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="loginWrapper d-flex align-items-center gx-2">
                        <label for="login" class="fs-6 text-secondary labelLoginEdit" style="">Логін:</label>
                        <input class="w-50 form-control" type="text" id="login" name="loginUserEdit"
                               value="<?= $user['login'] ?>">
                        <button class="btn btn-primary btnEditLogin" type="submit">Змінити</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                     class="bi bi-key svgUserPassword" viewBox="0 0 16 16">
                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
                Пароль
            </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
             data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="d-inline-block">
                        <div class="row g-3 align-items-center justify-content-end">
                            <div class="col-auto text-secondary ">
                                <label for="inputPassword1" class="col-form-label">Пароль:</label>
                            </div>
                            <div class="col-auto">
                        <span class="editPassword1Wrapper">
                        <input type="password" name="password" id="inputPassword1" class="form-control editPassword1"
                               aria-describedby="passwordHelpInline">
                        <a href="#" class="password-control img-edit-password1"></a>
                    </span>
                            </div>
                        </div>
                        <div class="row gx-3 align-items-center mt-2">
                            <div class="col-auto text-secondary">
                                <label for="inputPassword2" class="col-form-label">Пароль ще раз:</label>
                            </div>
                            <div class="col-auto">
                        <span class="editPassword2Wrapper">
                        <input type="password" id="inputPassword2" name="passwordRepeat" class="form-control editPassword2"
                               aria-describedby="passwordHelpInline">
                        <a href="#" class="password-control img-edit-password2" onclick=""></a>
                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button class="btn btn-primary" type="submit">Змінити пароль</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingFour">
            <button class="accordion-button collapsed fs-5" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                     class="bi bi-lock svgUserLogin" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                </svg>
                Дії з акаунтом
            </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
             data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z"/>
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z"/>
                            </svg>
                            При видаленні аккаунту всі дані будуть втрачені!
                        </div>
                    </div>
                    <div class="">
                        <a class="btn btn-danger" href="/user/delete">
                            Видалити акаунт
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
