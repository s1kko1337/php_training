<?php
require_once 'serio.php';
require_once 'translatable.php';


enum Rainbow
{
    use Serio, Translatable;

    case Red;
    case Оrange;
    case Yellow;
    case Green;
    case Blue;
    case Indigo;
    case Violet;
}

echo '<pre>';

echo 'Количество цветов: ' . Rainbow::size() . '<br />' . PHP_EOL;
foreach (Rainbow::cases() as $object) {
    echo $object->russian() . '<br />' . PHP_EOL;
}

echo '</pre>';
