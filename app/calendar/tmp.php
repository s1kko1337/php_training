
<?php
session_start();

// Исправленная функция makeCalendar
function makeCalendar(int $year, int $month): array
{
    // Получаем день недели для первого числа месяца (1 - понедельник, 7 - воскресенье)
    $wday = date('N', mktime(0, 0, 0, $month, 1, $year));
    
    // Вычисляем смещение для начала календаря
    $n = 1 - ($wday - 1); // Начинаем с первого дня месяца, смещенного на нужное количество дней
    
    $cal = [];
    for ($y = 0; $y < 6; $y++) {
        $row = [];
        $notEmpty = false;
        for ($x = 0; $x < 7; $x++, $n++) {
            if (checkdate($month, $n, $year)) {
                // Проверяем, является ли день текущим
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

// Инициализация переменных
$errors = [];
$selected_date = $_SESSION['selected_date'] ?? date('Y-m');
list($selected_year, $selected_month) = explode('-', $selected_date);
$cal = makeCalendar(intval($selected_year), intval($selected_month));

// Вычисляем предыдущий и следующий месяцы
$prev_month = date('Y-m', strtotime($selected_date . ' -1 month'));
$next_month = date('Y-m', strtotime($selected_date . ' +1 month'));

// Обработка формы
if (!empty($_POST)) {
    if (empty($_POST['date'])) {
        $errors['date'] = 'Дата не выбрана';
    }

    if (empty($errors)) {
        $date = $_POST['date'];
        $fDate = explode('-', $date);
        $cal = makeCalendar(intval($fDate[0]), intval($fDate[1]));
        $selected_date = $date;
    }

    if (!empty($_POST['date'])) {
        $_SESSION['selected_date'] = $_POST['date'];
    }
}

// Получаем название месяца на русском
$month_names = [
    1 => 'Январь', 2 => 'Февраль', 3 => 'Март', 4 => 'Апрель',
    5 => 'Май', 6 => 'Июнь', 7 => 'Июль', 8 => 'Август',
    9 => 'Сентябрь', 10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'
];
$current_month_name = $month_names[intval($selected_month)];
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фэнтезийный Календарь</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        :root {
            --main-bg: #0a0a1a;
            --calendar-bg: #1a1a2a;
            --border-color: #4a2080;
            --text-color: #8a60da;
            --highlight-color: #ff6a5a;
            --day-color: #60a0ff;
            --weekend-color: #ff5a7a;
            --header-color: #ffd700;
            --button-bg: #4a2080;
            --button-hover: #6a40a0;
            --current-day-bg: #2a4060;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Press Start 2P', cursive;
            background-color: var(--main-bg);
            color: var(--text-color);
            margin: 0 auto;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
            background-image: 
                radial-gradient(#2a1a4a 1px, transparent 1px),
                radial-gradient(#2a1a4a 1px, transparent 1px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            overflow-x: hidden;
            position: relative;
        }

        /* Загрузочный экран */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--main-bg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-text {
            font-size: 24px;
            color: var(--text-color);
            margin-bottom: 20px;
            animation: pulse 1.5s infinite;
        }

        .loading-bar {
            width: 200px;
            height: 20px;
            background-color: var(--calendar-bg);
            border: 4px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .loading-progress {
            height: 100%;
            width: 0%;
            background-color: var(--highlight-color);
            transition: width 0.5s;
        }

        /* Часы */
        .clock-box {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px;
            border: 4px solid var(--border-color);
            background-color: var(--calendar-bg);
            color: var(--highlight-color);
            font-size: 14px;
            box-shadow: 0 0 10px rgba(138, 96, 218, 0.5);
            animation: float 3s ease-in-out infinite;
            text-shadow: 2px 2px 0 #000;
        }

        /* Заголовок */
        .title {
            margin-top: 80px;
            font-size: 28px;
            color: var(--header-color);
            text-shadow: 3px 3px 0 #000;
            margin-bottom: 20px;
            letter-spacing: 2px;
            animation: pulse 3s infinite;
        }

        /* Форма */
        form {
            margin: 20px 0;
            padding: 20px;
            background-color: var(--calendar-bg);
            border: 4px solid var(--border-color);
            display: flex;
            flex-direction: column;
            gap: 15px;
            box-shadow: 0 0 20px rgba(74, 32, 128, 0.6);
            max-width: 600px;
            width: 90%;
            position: relative;
            overflow: hidden;
        }

        form::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--highlight-color), var(--text-color), var(--highlight-color));
            animation: rainbow 3s linear infinite;
            background-size: 200% 100%;
        }

        input[type="month"] {
            font-family: 'Press Start 2P', cursive;
            padding: 10px;
            background-color: var(--main-bg);
            color: var(--text-color);
            border: 2px solid var(--border-color);
            outline: none;
        }

        input[type="submit"] {
            font-family: 'Press Start 2P', cursive;
            padding: 12px;
            background-color: var(--button-bg);
            color: var(--header-color);
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 0 #2a1040;
            position: relative;
            top: 0;
        }

        input[type="submit"]:hover {
            background-color: var(--button-hover);
        }

        input[type="submit"]:active {
            top: 4px;
            box-shadow: 0 0 0 #2a1040;
        }

        /* Навигация по месяцам */
        .calendar-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            max-width: 600px;
            margin: 10px auto;
        }

        .calendar-nav a {
            text-decoration: none;
            color: var(--text-color);
            background-color: var(--button-bg);
            padding: 8px 12px;
            border: 2px solid var(--border-color);
            transition: all 0.3s;
            font-size: 12px;
        }

        .calendar-nav a:hover {
            background-color: var(--button-hover);
            transform: scale(1.05);
        }

        .calendar-nav span {
            font-size: 16px;
            color: var(--header-color);
            text-shadow: 2px 2px 0 #000;
        }

        /* Календарь */
        .calendar {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            background-color: var(--calendar-bg);
            border: 4px solid var(--border-color);
            padding: 10px;
            box-shadow: 0 0 20px rgba(74, 32, 128, 0.6);
            position: relative;
            overflow: hidden;
        }

        .calendar::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--highlight-color), var(--text-color), var(--highlight-color));
            animation: rainbow 3s linear infinite;
            background-size: 200% 100%;
        }

        .calendar table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 4px;
        }

        .calendar td {
            text-align: center;
            padding: 10px;
            border: 2px solid var(--border-color);
            background-color: var(--main-bg);
            position: relative;
            transition: all 0.3s;
        }

        .calendar tr:first-child td {
            background-color: var(--button-bg);
            color: var(--header-color);
            font-weight: bold;
            border-color: var(--button-hover);
        }

        .calendar td:hover:not(:empty) {
            transform: scale(1.05);
            box-shadow: 0 0 10px var(--text-color);
            z-index: 1;
        }

        .calendar td:not(:empty) {
            cursor: pointer;
        }

        .calendar td.weekend {
            color: var(--weekend-color);
        }

        .calendar td.current-day {
            background-color: var(--current-day-bg);
            color: var(--highlight-color);
            border-color: var(--highlight-color);
            animation: pulse 2s infinite;
        }

        /* Анимации */
        @keyframes float {
            0% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                opacity: 0.6;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0.6;
            }
        }

        @keyframes rainbow {
            0% {
                background-position: 0% 50%;
            }
            100% {
                background-position: 200% 50%;
            }
        }

        /* Декоративные элементы */
        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .error-message {
            color: var(--highlight-color);
            margin: 10px 0;
            padding: 10px;
            border: 2px solid var(--highlight-color);
            background-color: rgba(255, 106, 90, 0.2);
            text-align: center;
            width: 90%;
            max-width: 600px;
        }

        /* Адаптивность */
        @media (max-width: 480px) {
            .calendar td {
                padding: 8px 4px;
                font-size: 10px;
            }
            
            .clock-box {
                font-size: 10px;
                padding: 8px;
                top: 10px;
                left: 10px;
            }
            
            .title {
                font-size: 18px;
                margin-top: 60px;
            }
            
            .loading-text {
                font-size: 16px;
            }
            
            form {
                padding: 15px;
            }
            
            input[type="month"],
            input[type="submit"] {
                padding: 8px;
                font-size: 10px;
            }
            
            .calendar-nav {
                font-size: 10px;
            }
            
            .calendar-nav span {
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <!-- Загрузочный экран -->
    <div class="loading-screen" id="loading-screen">
        <div class="loading-text">Загрузка магического календаря...</div>
        <div class="loading-bar">
            <div class="loading-progress" id="loading-progress"></div>
        </div>
    </div>

    <!-- Звездное небо -->
    <div class="stars" id="stars"></div>

    <!-- Часы -->
    <div class="clock-box" id="clock"></div>

    <!-- Заголовок -->
    <h1 class="title">Магический Календарь</h1>

    <!-- Вывод ошибок -->
    <?php if (!empty($errors)): ?>
        <div class="error-message">
            <?php foreach ($errors as $val): ?>
                <?= htmlspecialchars($val) ?><br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Форма выбора месяца -->
    <form method="post">
        <input type="month" name="date" id="date" value="<?= htmlspecialchars($selected_date) ?>">
        <input type="submit" value="Создать календарь!">
    </form>

    <!-- Навигация по месяцам -->
    <div class="calendar-nav">
        <a href="?date=<?= htmlspecialchars($prev_month) ?>">← Предыдущий</a>
        <span><?= htmlspecialchars($current_month_name) ?> <?= htmlspecialchars($selected_year) ?></span>
        <a href="?date=<?= htmlspecialchars($next_month) ?>">Следующий →</a>
    </div>

    <!-- Календарь -->
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

    <script>
        // Создание звезд
        function createStars() {
            const starsContainer = document.getElementById('stars');
            const starCount = 100;
            
            for (let i = 0; i < starCount; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                
                // Случайное положение
                const x = Math.random() * 100;
                const y = Math.random() * 100;
                
                // Случайный размер и прозрачность
                const size = Math.random() * 2 + 1;
                const opacity = Math.random() * 0.5 + 0.3;
                const duration = Math.random() * 3 + 2;
                
                star.style.left = `${x}%`;
                star.style.top = `${y}%`;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                star.style.opacity = opacity;
                star.style.setProperty('--duration', `${duration}s`);
                star.style.setProperty('--opacity', opacity);
                
                starsContainer.appendChild(star);
            }
        }

        // Обновление часов
        function updateClock() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    document.getElementById("clock").innerText = xhr.responseText;
                }
            };
            xhr.open('GET', 'clock.php', true);
            xhr.send();
        }

        // Имитация загрузки
        function simulateLoading() {
            const progressBar = document.getElementById('loading-progress');
            const loadingScreen = document.getElementById('loading-screen');
            let progress = 0;
            
            const interval = setInterval(() => {
                progress += Math.random() * 10;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    
                    // Скрываем экран загрузки
                    setTimeout(() => {
                        loadingScreen.style.opacity = '0';
                        setTimeout(() => {
                            loadingScreen.style.display = 'none';
                        }, 500);
                    }, 500);
                }
                
                progressBar.style.width = `${progress}%`;
            }, 200);
        }

        // Инициализация
        document.addEventListener('DOMContentLoaded', function() {
            createStars();
            simulateLoading();
            setInterval(updateClock, 1000);
            updateClock();
        });
    </script>
</body>

</html>