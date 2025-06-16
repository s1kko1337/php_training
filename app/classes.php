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

        class Rainbow
        {
            private const COLORS =
            [
                'red' => 'красный',
                'orange' => 'оранжевый',
                'yellow' => 'желтый',
                'green' => 'зеленый',
                'blue' => 'голубой',
                'indigo' => 'синий',
                'violet' => 'фиолетовый'
            ];

            public function __get($key)
            {
                if (array_key_exists($key, Rainbow::COLORS)) {
                    return Rainbow::COLORS[$key];
                } else {
                    return null;
                }
            }
        }

        class Settings
        {
            private array $properties;

            public static function date()
            {
                return date('l \t\h\e jS');
            }
            public function __get($key)
            {
                if (array_key_exists($key, $this->properties)) {
                    return $this->properties[$key];
                } else {
                    return null;
                }
            }

            public function  __set(string $key, mixed $value)
            {
                $this->properties[$key] = $value;
            }

            public function listProperties()
            {
                return $this->properties;
            }
        }
        class Point
        {
            private $x;
            private $y;

            public function __construct(int|float  $x = 0, int|float  $y = 0,)
            {
                $this->x = $x;
                $this->y = $y;
            }

            public function __get($key)
            {
                if ($key == 'distance') {
                    return sqrt($this->getX() ** 2 + $this->getY() ** 2);
                } else {
                    return null;
                }
            }
            public function getX(): int| float
            {
                return $this->x;
            }
            public function getY(): int| float
            {
                return $this->y;
            }

            public function __toString()
            {
                return "({$this->x}, {$this->y})";
            }
        }


        //dynamic methods

        class MinMax
        {
            public function __call($name, $arguments)
            {
                switch ($name) {
                    case 'max':
                        return max($arguments);
                    case 'min':
                        return min($arguments);
                    default:
                        return null;
                }
            }
            public static function __callStatic($name, $arguments)
            {
                switch ($name) {
                    case 'max':
                        return max($arguments);
                    case 'min':
                        return min($arguments);
                    default:
                        return null;
                }
            }
        }
        echo MinMax::max(123, 12, 2, 32) . '<br>';
        $minMax = new MinMax;
        echo $minMax::min(1, 2, 3, 4, 2121) . '<br>';
        class Page
        {
            static $content = 'about <br>';

            public static function header()
            {
                return 'header<br>';
            }

            public static function footer()
            {
                return 'footer<br>';
            }

            public static function render()
            {
                echo self::header(),
                self::$content,
                self::footer();
            }
        }

        class Trees
        {
            private static $count = 0;

            public function __construct()
            {
                self::$count++;
            }
            public function __destruct()
            {
                self::$count--;
            }
            public static function getCount()
            {
                return self::$count;
            }
        }

        $forest = [];
        for ($i = 0; $i < rand(5, 15); $i++) {
            $forest[]  = new Trees;
        }
        print_r($forest);
        echo Trees::getCount();

        $point = new Point(12, 23);
        print_r(get_class_methods($point));
        print_r($point->distance);
        echo '<br>';
        if (method_exists($point, 'distance')) {
            print_r($point::class);
        }

        echo "point = $point";

        $rainbow  = new Rainbow;
        print_r(get_class_methods($rainbow));
        print_r($rainbow->yellow);
        print_r(get_class_vars($rainbow::class));


        // $settings = new Settings;
        // $settings->lang = 'Russian';
        // print_r($settings->listProperties());

        print_r(Settings::date());
        Page::render();
        ?>
    </pre>
</body>

</html>