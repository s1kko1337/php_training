<?php

require_once 'namespaces.php';

echo "Version: " . PHP8\VERSION. "\n";
$page = new PHP8\Page('Home Page', 'Welcome to our photo album!');
PHP8\printer($page);
?>