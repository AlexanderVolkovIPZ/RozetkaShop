<?php
/** @var array $users */
?>


<div class="container">
    <table class="table table-success table-striped table-hover">
        <thead>
        <tr>
            <td class="fw-bold">#</td>
            <td>Ім'я</td>
            <td>Прізвище</td>
            <td>По-батькові</td>
            <td>Логін</td>
            <td>
                Тип доступу
            </td>
            <td>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php $counter = 1?>
        <?php foreach ($users as $user): ?>
            <form action="" method="post">
            <tr>
                <td class="fw-bold"><?=$counter?></td>
                <td><?= $user['firstName'] ?></td>
                <td><?= $user['middleName'] ?></td>
                <td><?= $user['lastName'] ?></td>
                <td><?= $user['login'] ?></td>
                <td>
                <select name="user<?=$user['id']?>" id="" data-access="<?=$user['id']?>">
                    <option value="1">Клієнт</option>
                    <option value="10" <?php if ($user['typeAccess'] == 10) echo "selected"?>>Адміністратор</option>
                </select>
                </td>
                <td>
                    <a href="#" class="changeUserAccess">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check-lg text-success changeUserAccessIcon" viewBox="0 0 16 16" style="cursor: pointer">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                    </a>
                </td>
                </tr>
            </form>
            <?php $counter+=1?>
            <?php endforeach; ?>
        <?php ?>
        </tbody>
    </table>
</div>

