<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    define('START_TIME', microtime(true)); 
        echo '<pre>';
        // function makeHex(string $str) : string {
        //     for ($i=0; $i < strlen($str); $i++) { 
        //         $hex[] = sprintf('%02X', ord($str[$i]));
        //     }
        //     return join(' ', $hex);
        // }
        // $f = fopen('constants.php','rb') or die("Can't open file");
        // $f1 = fopen('constants.php','rt') or die("Can't open file");
        // echo makeHex(fgets($f,100)) .'<br />'. PHP_EOL ;
        // echo makeHex(fgets($f1,100)) .'<br />'. PHP_EOL ;
        // while (!feof($f)){
        //     echo $st = fgets($f);
        // }
        // echo basename('/aboba/babq/rt.txt');
        // echo basename('/aboba/babq/rt.txt', '.txt');
        // $tmpname = tempnam() . getmypid();
        // file manipulation
        // copy()
        // rename()
        // unlink ()
        // echo file_get_contents('info.php');
        // echo file_get_contents('class.php');
        // $file = file('test.txt');

        // fclose(fopen($file, 'a+b'));

        // $f = fopen($file, 'r + b') or die('error');

        // flock($f, LOCK_EX);
        // fwrite($f, 'hello');
        // fclose($f);
        // $f = fopen($file, 'r + b') or die('error');
        // fgets($f);
        echo getcwd(). PHP_EOL;
        // chdir()
        // mkdir('data', 0777);
        // chdir(getcwd() . '/data');
        // mkdir('dataset/bin', 0777, true);
        // echo getcwd() . PHP_EOL;
        // chdir('..');
        // chdir('..');
        function readDeirREcursive(int $level = 1) : void {
            $dir = opendir('.');
            if (!$dir) return;

            while (($file = readdir($dir)) !== false) {
                if ($file == '.' || $file == '..') continue;
                if (!is_dir($file)) continue;
                
                for ($i = 0; $i < $level; $i++){
                    echo ' ';
                };
                echo $file . PHP_EOL;

                if(!chdir($file)) continue;

                chdir('..');

                flush();
            }
            closedir($dir);

        }
        chdir($_SERVER['DOCUMENT_ROOT']);
        // readDeirREcursive(); 
        //glob() filter catalog
        // rmdir()
        $cat = dir('.');

        $file_count = 0;
        $dir_count = 0; 

        while (($file = $cat->read()) !== false) {
            if((is_dir($file)) === true) $dir_count ++;
            else $file_count ++;
        }

        $dir_count = $dir_count - 2; 
        echo $file_count . PHP_EOL . $dir_count . PHP_EOL;

        $cat->rewind(); 

        while (($file = $cat->read()) !== false) {
            echo $file . '<br>';
        }
        $cat->close();
    printf('Время работы скрипта: %.5f с', microtime(true) - START_TIME); 
    ?>
</body>
</html>