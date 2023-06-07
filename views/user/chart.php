<?php
/** @var array $users */
?>


<div class="container" style="overflow-x: scroll">
    <div style="" class="mt-3">
        <table class="table table-success table-striped table-hover table-bordered">
            <thead>
            <tr>
                <td class="fw-bold align-middle text-center">#</td>
                <td class="align-middle text-center">Ім'я</td>
                <td class="align-middle text-center">Прізвище</td>
                <td class="align-middle text-center">По-батькові</td>
                <td class="align-middle text-center">Логін</td>
                <td class="align-middle text-center">
                    Тип доступу
                </td>
                <td class="align-middle text-center">
                </td>
            </tr>
            </thead>
            <tbody>
            <?php $counter = 1 ?>
            <?php foreach ($users as $user): ?>
                <form action="" method="post">
                    <tr>
                        <td class="fw-bold align-middle text-center"><?= $counter ?></td>
                        <td class="align-middle text-center"><?= $user['firstName'] ?></td>
                        <td class="align-middle text-center"><?= $user['middleName'] ?></td>
                        <td class="align-middle text-center"><?= $user['lastName'] ?></td>
                        <td class="align-middle text-center"><?= $user['login'] ?></td>
                        <td class="align-middle text-center">
                            <select name="user<?= $user['id'] ?>" id="" data-access="<?= $user['id'] ?>">
                                <option value="1">Клієнт</option>
                                <option value="10" <?php if ($user['typeAccess'] == 10) echo "selected" ?>>Адміністратор
                                </option>
                            </select>
                        </td>
                        <td class="align-middle text-center">
                            <a href="#" class="changeUserAccess">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                     class="bi bi-check-lg text-success changeUserAccessIcon" viewBox="0 0 16 16"
                                     style="cursor: pointer">
                                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                </form>
                <?php $counter += 1 ?>
            <?php endforeach; ?>
            <?php ?>
            </tbody>
        </table>
    </div>
</div>

