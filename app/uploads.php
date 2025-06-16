<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(empty($_POST['upload'])){
            echo '<pre> $_FILES consists:' .
                print_r($_FILES, true) . 
                '/<pre>';
        }

        echo ini_get('upload_max_filesize');
        if ($_FILES['filename']['size'] > 3 * 1_024 * 1_024) { 
              exit('Размер файла превышает три мегабайта');
        }
        if (move_uploaded_file($_FILES['filename']['tmp_name'],'temp/'.$_FILES['filename']['name'])){
           echo 'Файл успешно загружен <br />';
        } 
        else {
           echo 'Ошибка загрузки файла <br />';
        } 
    ?>

    <form action="uploads.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file">
        <input type="submit" value="submit">
    </form>
</body>
</html>