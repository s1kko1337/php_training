<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if (!empty($_POST['doUpload'])) {
            echo '<pre>';
            print_r($_FILES);
            echo '</pre>';
        }
    ?>

    <form action="complex.php" method="post" enctype="multipart/form-data">
        <h3>Выберите тип файлов в вашей системе:</h3> 
        Текст: <input type="file" name="input[a][text]" /> <br>
        Бинарник: <input type="file" name="input[a][binary]" /> <br>
        <input type="submit" name="doUpload" value="Submit">
    </form>
</body>
</html>