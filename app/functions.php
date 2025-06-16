<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Functions</h1>
    <hr>
    <?php
        $GLOBAL_ARRAY = [
            'test' => 1
        ];
        //default
        function print_array(string $item, string $key) : void{
            echo "$key: $item" . PHP_EOL;   
        } 
        echo '<pre>';
        function default_function(int|float &$test): int|float{
            global $GLOBAL_ARRAY;
            $a = &$GLOBALS['GLOBAL_ARRAY']['test'];
            static $s = 0;
            //эвивалентны

            return $s += $a += $test;
        }
        function factorial(int $a){
            if($a <= 1) return 1;
            return $a* factorial($a - 1);
        }        

        //satatic
        $test_value = 1.24;
        echo default_function(test: $test_value),PHP_EOL;
        echo default_function(test: $test_value),PHP_EOL;
        echo default_function(test: $test_value),PHP_EOL;
        echo default_function(test: $test_value),PHP_EOL;
        echo $test_value;

        $extensions = [
            'langs'=>[
                'php' => 'PHP',
                'py' => 'Python',
                'rb' => 'Ruby',
                'js' => 'JavaScript'
            ],
            'databases' => [
                'PostgreSQL' => 'sql',
                'MySQL' => 'sql',
                'SQLite' => 'sql',
                'ClickHouse' => 'sql',
                'MongoDB' => 'js',
                'Redis' => 'own'
            ] 
            ];

        function cube(int|float $num) : int|float{
            return $num ** 3;
        }

        $anime_array = [
            'bleach',
            'magic battle'
        ];
        $hero_array = [
            'ichigo',
            'panda'
        ];
        function test(string $anime, string $hero) : string{
            return "$anime : $hero" . PHP_EOL;
        }

        function is_odd(int|float $num) : bool {
            return (bool) ($num % 2.0 !== 0);
        }

        function multiple ($carry,$num) {
            return $carry * $num;
        }
        $input_array = [1,2,3,4,5];
        echo '<br>';
        function oddSquare(array $carry, int $item){
            if($item & 1){
                $carry [] = $item **= 2;
            }
            return $carry;
        };

        function walk(array $arr, callable $callback){
            foreach ($arr as $key => $val){
                $callback($key,$val);
            }
        }

        // walk($anime_array, 'print_array');
        // print_r(array_reduce([1,2,3,4,5],'oddSquare',[]));
        // echo '<br>';
        // print_r(array_reduce($input_array, 'multiple', $input_array[0]));
        // $odds = array_filter([1, 2, 3, 4, 5], 'is_odd');
        // foreach( array_map('cube',$odds)as $num){
        //     echo"number <br> : $num";
        // }
        // print_r(array_map('test',$anime_array, $hero_array));
        // $test_array = [1,2,3,4.5,5,6];
        // print_r(array_filter($test_array,'is_odd'));
        // $res = array_map('cube',$test_array);
        // print_r($res);
        
        // array_walk_recursive($extensions, 'print_array', false); 
        // print_r($GLOBAL_ARRAY);
        // echo factorial(5);
        print_r(array_reduce(
            [1,2,3,4,5],
            function (array $carry, int $item) : array
            {
                if($item & 1){
                    $carry[] = $item * $item;
                }
                return $carry;
            },
            []
        ));
        echo '</pre>';
    ?>
</body>
</html>