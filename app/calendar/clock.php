<?php
date_default_timezone_set('Europe/Moscow');

$formatter = new IntlDateFormatter('ru_RU', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
$formatter->setPattern('HH:mm:ss EEE dd MMMM yyyy');

echo $formatter->format(new DateTime());
?>
