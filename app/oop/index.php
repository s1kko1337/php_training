<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php require_once '../oop/debug.php';
    $logger = new FileLoggerDebug('test.log'); // FileLoggerDebug подходит вместо базового класса FileLogger
    croak($logger, 'Hasta la vista.'); // Функция принимает параметр типа FileLogger
    function croak(FileLogger $l, $msg)
    {
        $l->log($msg);
        exit();
    }
    ?>
</body>

</html>