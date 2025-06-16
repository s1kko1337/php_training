<!DOCTYPE html>
<html lang="ru">

<head>
    <title>Аутентификация</title>
    <meta charset='utf-8' />
</head>

<body> <?php define('PASSWORD_HASH',     '$2y$10$DTHJ.45VY0IB5NNVfK9HCOAj05f1BCP78.7TvYCSAKuXQzQ7swE8.');
        $errors = [];
        if (!empty($_POST)) {
            if ($_POST['name'] != 'admin') {
                $errors[] = 'Неверный логин';
            }
            if (!password_verify($_POST['password'], PASSWORD_HASH)) {
                $errors[] = 'Неверный пароль';
            }
            if (empty($errors)) {
                echo 'Вы успешно вошли в личный кабинет';
                exit();
            }
        }
        if (!empty($errors)) {
            foreach ($errors as $err) {
                echo "<span style=\"color:red\">$err</span><br>";
            }
        } ?> 
        <form method='post'>
        <input type='text' name='name' value='<?= htmlspecialchars($_POST['name'] ?? ''); ?>' />
        <br />
        <input type='password' name='password' value='<?= htmlspecialchars($_POST['password'] ?? ''); ?>' />
        <br />
        <input type='submit' value='Войти' />
    </form>
</body>

</html>