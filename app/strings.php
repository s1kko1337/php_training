<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php" target="_self" rel="index">back to home</a>
    <?php
        // $tmp = " 210 176    ";
        // $pword = trim($tmp);
        // $loc = setlocale(LC_ALL, 'ru', 'ru_RU', 'rus', 'russian'); 
        // print_r(localeconv()); 
        // echo $pword . PHP_EOL;
        // $pass = hash("md5",$pword);
        // echo $pass;

        // $str = <<<text
        // hello 
        // php
        // text;

        // echo $str . PHP_EOL;
        // $formated_str = nl2br($str);
        // echo $formated_str;
        // print_r(explode(' ','adasdasdashdgsahdg hasgdhgas hgdh asgdhgsadg hasghsaghsgdhgshgdhag',5));
        

        // $arr = [21,01,86,221,654];

        // $tmp = serialize($arr);
        // print_r($tmp);

        // //post

        // //get
        // $var = unserialize($tmp);
        // print_r($var);
       echo '<pre>'; 
        $json  = [
            'name' => 'Иван',
            'surname' => 'Риван',
            'additional_info' => [
                'age' => 22,
                'height' => 176,
                'student' => (int)false
            ]
        ];

        $formatted =  json_encode($json,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        echo $formatted .PHP_EOL;

        $decoded = json_decode($formatted , JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
 
        print_r($decoded);
        echo '</pre>';
        //anti inections htmlspecialchars()
        // delete tags: strip_tags()
    ?>
</body>
</html>
