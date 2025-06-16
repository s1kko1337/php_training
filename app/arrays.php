<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ARRAYS</h1>
    <hr>
    <?php
        $arr = [];
        $arrAlt = array();
        
        $arr[] = 123;
        $arr[] = 1234;
        
        $arrAlt[10] = 'a12';
        $arrAlt[]  = '1243';
        
        $arrNiggers = array_fill(0,10,'Nigger');
        $arrSteps = range(0,1,0.05);
        $arrTrio['test'] = array_fill(0,2,'biba');


        list($one, $two) = $arr;
        echo $one,$two;
        $x = 'x';
        $y = 'y';
        list($y, $x) = [$x, $y]; 
        echo $x, ' ', $y;   

        echo '<pre>';
        foreach($arrTrio as $n =>$type){
            echo "[$n]" . PHP_EOL;  
            foreach ($type as $test) { 
                echo $test. PHP_EOL;
            }
        }

        //+ = + or  array_merge() +([0]=>1,[1]=>2 + [0]=>2, [1]=> 3 = [0] =>1, [2]=>2)
        //array_diff() diferent
        //array_intersect() union
        // isset($arr[i]) is exist?
        // is_array()?
        // in_array()?
        //array_key_exists()
        //shuffle() - randomize 
        //sort
        /*
            asort
            rsort
            ksort
            krsort
            natsort - естественная  
            array_multisort
        */
        //delete
        /*
            unset(arr[x])
        */
        //array_pad() 
        //array_push/pop()
        //array_unshift()
        //array_shift()
        // array_change_key_case()
        //array_values()  меняет ключи на цифры
        //array_flip()
        $a = 1_000;

        echo count($arrTrio, COUNT_RECURSIVE), '<br>';
        $array = [1, 'hello', 1, 'world', 'hello'];
        $new = array_count_values($array); 
        print_r($new); 
        print_r($arrTrio);
        print_r($arrSteps);
        print_r($arrNiggers);
        print_r($arr);
        print_r($arrAlt);
        echo gettype($a);
        echo '</pre>'; 
        


    ?>
</body>
</html>