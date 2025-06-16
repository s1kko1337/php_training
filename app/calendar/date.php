<?php
session_start();

function makeCalendar(int $year, int $month): array
{
    $wday = date('N', mktime(0, 0, 0, $month, 1, $year));

    $n = 1 - ($wday - 1);

    $cal = [];
    for ($y = 0; $y < 6; $y++) {
        $row = [];
        $notEmpty = false;
        for ($x = 0; $x < 7; $x++, $n++) {
            if (checkdate($month, $n, $year)) {
                $is_current = ($n == date('j') && $month == date('n') && $year == date('Y'));
                $row[] = ['day' => $n, 'current' => $is_current];
                $notEmpty = true;
            } else {
                $row[] = ['day' => "", 'current' => false];
            }
        }
        if (!$notEmpty) break;
        $cal[] = $row;
    }
    return $cal;
}


// function local2utc($localStamp = false){
//     if($localStamp === false) {
//         $localStamp = time();
//     }
//     $tzOffset = date('Z', $localStamp);

//     return $localStamp - $tzOffset;
// }
// function utc2local($gmStamp = false,  $tzOffset = false){
//     if($gmStamp === false) {
//         return time();
//     }
//     if($tzOffset === false){
//         $tzOffset = date('Z', $gmStamp);
//     }
//     else {
//         $tzOffset *= 60 * 60;
//     }

//     return $gmStamp + $tzOffset;
// }

// //example usage

// // $tmp = local2utc(time());
// // echo date($format =  'Y-m-d H:i', utc2local($stampUTC = $tmp,+5));


// $date = new DateTime('2023-01-01 00:00:00', new DateTimeZone('Europe/Moscow'));
// echo $date->format('d.m.Y H:i:s P') . '<br />';


// $date = new DateTime('2023-01-01 0:0:0');
// $nowdate = new DateTime();
// $interval = $nowdate->diff($date);
// echo $date->format('d.m.Y H:i:s') . '<br />';
// echo $nowdate->format('d.m.Y H:i:s') . '<br />';
// echo $interval->format('%Y.%m.%d %H:%S') . '<br />';
// echo '<pre>';
// print_r($interval);
// echo '</pre>';


$nowdate = new DateTime();
$date = $nowdate->sub(new DateInterval('P3Y1M14DT12H19M2S'));
echo $date->format('Y-m-d H:i:s'); 


$errors = [];
$selected_date = $_SESSION['selected_date'] ?? date('Y-m');
list($selected_year, $selected_month) = explode('-', $selected_date);
$cal = makeCalendar(intval($selected_year), intval($selected_month));

$prev_month = date('Y-m', strtotime($selected_date . ' -1 month'));
$next_month = date('Y-m', strtotime($selected_date . ' +1 month'));


if (!empty($_POST)) {
    if (empty($_POST['date'])) {
        $errors['date'] = 'Дата не выбрана';
    }

    if (empty($errors)) {
        $date = $_POST['date'];
        $fDate = explode('-', $date);
        $cal = makeCalendar(intval($fDate[0]), intval($fDate[1]));
        $selected_date = $date;

        $selected_year = $fDate[0];
        $selected_month = $fDate[1];
    }

    if (!empty($_POST['date'])) {
        $_SESSION['selected_date'] = $_POST['date'];
    }
}

$month_names = [
    1 => 'Январь',
    2 => 'Февраль',
    3 => 'Март',
    4 => 'Апрель',
    5 => 'Май',
    6 => 'Июнь',
    7 => 'Июль',
    8 => 'Август',
    9 => 'Сентябрь',
    10 => 'Октябрь',
    11 => 'Ноябрь',
    12 => 'Декабрь'
];

$current_month_name = $month_names[intval($selected_month)];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Календарь</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="loading-screen" id="loading-screen">
        <div class="loading-text">Загрузка магического календаря...</div>
        <div class="loading-bar">
            <div class="loading-progress" id="loading-progress"></div>
        </div>
    </div>

    <div class="calendar-loading" id="calendar-loading">
        <div class="calendar-spinner"></div>
        <div class="calendar-loading-text">Обновление календаря...</div>
    </div>

    <div class="stars" id="stars"></div>

    <div class="clock-box" id="clock"></div>

    <h1 class="title">Календарь</h1>

    <?php if (!empty($errors)): ?>
        <div class="error-message">
            <?php foreach ($errors as $val): ?>
                <?= htmlspecialchars($val) ?><br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <input type="month" name="date" id="date" value="<?= htmlspecialchars($selected_date) ?>">
        <input type="submit" value="Создать календарь!">
    </form>

    <div class="calendar-header">
        <span><?= htmlspecialchars($current_month_name) ?> <?= htmlspecialchars($selected_year) ?></span>
    </div>

    <div class="calendar">
        <table>
            <tr>
                <td>Пн</td>
                <td>Вт</td>
                <td>Ср</td>
                <td>Чт</td>
                <td>Пт</td>
                <td>Сб</td>
                <td>Вс</td>
            </tr>
            <?php foreach ($cal as $row): ?>
                <tr>
                    <?php foreach ($row as $i => $v): ?>
                        <td class="<?= ($i == 5 || $i == 6) ? 'weekend' : '' ?> <?= $v['current'] ? 'current-day' : '' ?>">
                            <?= $v['day'] ? $v['day'] : "&nbsp;" ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <script src="script.js"></script>
</body>

</html>