<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // setcookie('counter',counter());
    // echo $_COOKIE['counter'];

    // function counter(){
    //     if(!isset($_COOKIE['counter'])){
    //         $_COOKIE['counter'] = 1;
    //     }
    //     else{
    //         $_COOKIE['counter'] += 1;
    //     }
    //     return  $_COOKIE['counter'];
    // }


    session_start();
    $_SESSION['name'] = 'value';
    $_SESSION['arr'] = [1, 2, 3, 4, 5];
    print_r($_SESSION);
    if (isset($_SERVER['HTTP_REFERER'])) {
        echo $_SERVER['HTTP_REFERER'] . '<br>';
        echo $_SERVER['REMOTE_ADDR'] . '<br>';
        echo $_SERVER['HTTP_X_FORWARDED_FOR'] . '<br>';
    }

    if (isset($_SERVER['QUERY_STRING'])) {
        echo urldecode($_SERVER['QUERY_STRING']);
    }
    echo '<a href="another.php">другая страница</a>';

    echo filter_var('127.0.0.1', FILTER_VALIDATE_IP);

    $data = [
        'number' => 5,
        'first'  => 'chapter01',
        'second' => 'ch02',
        'id'     => 2
    ]; // Фильтры 
    $definition = [
        'number' => [
            'filter'  => FILTER_VALIDATE_INT,
            'options' => [
                'min_range' => -10,
                'max_range' => 10
            ]
        ],
        'first' => [
            'filter'  => FILTER_VALIDATE_REGEXP,
            'options' => [
                'regexp' => '/^ch\d+$/'
            ]
        ],
        'second' => [
            'filter'  => FILTER_VALIDATE_REGEXP,
            'options' => [
                'regexp' => '/^ch\d+$/'
            ]
        ],
        'id' => FILTER_VALIDATE_INT
    ];
    $result = filter_var_array($data, $definition);
    echo '<pre>';
    print_r($result);
    echo '<pre>';
    ?>
</body>

</html>