<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    echo '<pre>';
    session_start();
    print_r($_SESSION);
    session_destroy();
    echo '</pre>';
    if (isset($_SERVER['HTTP_REFERER'])) { 
        echo $_SERVER['HTTP_REFERER'] . '<br>';
        echo $_SERVER['REMOTE_ADDR']. '<br>';
        echo $_SERVER['HTTP_X_FORWARDED_FOR']. '<br>'; 
    } 
    echo '<a href="globalarrays.php">другая страница</a>'; 
    $a = -INF / +INF;
    echo is_nan($a);
    ?>
</body>
</html>