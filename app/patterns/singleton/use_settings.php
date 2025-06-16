<?php

require_once 'settings.php';

echo '<pre>';
try {
    Settings::get()->items_per_page = 20;
    echo Settings::get()->items_per_page;
} catch (\Throwable $th) {
    print_r($th);
}
echo '</pre>';