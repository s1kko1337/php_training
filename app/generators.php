<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre>
    <?php
        function generator($from = 0, $to = 100) {
            for ($i= $from; $i < $to; $i++) { 
                echo "Value : $i<br />";
                yield $i;
            }
        } 

        function bubbleSort(&$arr)
        {
            $n = sizeof($arr);
            for($i = 0; $i < $n; $i++)
            {
                $swapped = False;
                for ($j = 0; $j < $n - $i - 1; $j++)
                {
                    if ($arr[$j] > $arr[$j+1])
                    {
                        $t = $arr[$j];
                        $arr[$j] = $arr[$j+1];
                        $arr[$j+1] = $t;
                        $swapped = True;
                    }
                }
                if ($swapped == False)
                    break;
            }
        }
        // function &array_sort(array $arr,callable $callback){
        //     foreach ($arr as $val){
        //         yield $callback($val);
        //     }
        // }

        function collect (array &$arr, callable $callback){
            foreach ($arr as &$val){
                yield $callback($val);
            }
        }

        $arr = [1,2,3,4,5];
        $collect = collect($arr, fn(&$e) => $e = $e  * $e);
        foreach ($collect as $val) {
            echo "$val ";
        }
        print_r($arr);

        // foreach(generator(0,10) as $val){
        //     echo 'Value pow : ' . ($val * $val) . '<br />'; 
        // }

        //closure

        //simple anonymus func
        
        $a = 5;
        $func = function () use ($a){
            return $a;
        };
    ?>
    </pre>
</body>
</html>