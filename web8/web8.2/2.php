<!DOCTYPE html>
<html>
<head>
    <title>Календарь</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }
        .calendar-container {
            text-align: center;
            width: 90%;
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        form {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        td {
            font-size: 14px;
        }
        td.weekend {
            background-color: #ffe5e5;
        }
        td.holiday {
            background-color: #ffcccc;
            font-weight: bold;
        }
        caption {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="calendar-container">
        <form method="get">
            <label for="month">Месяц:</label>
            <input type="number" id="month" name="month" min="1" max="12" required>
            <label for="year">Год:</label>
            <input type="number" id="year" name="year" min="1900" max="2100" required>
            <button type="submit">Показать календарь</button>
        </form>
        <?php
        function generateCalendar($month = null, $year = null, $holidays = []) {
            if ($month === null || $year === null) {
                $month = date('n');
                $year = date('Y');
            }

            $daysOfWeek = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
            $months = [
                1 => 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
            ];

            $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
            $daysInMonth = date('t', $firstDayOfMonth);
            $startDay = date('N', $firstDayOfMonth);

            echo "<table>";
            echo "<caption>" . $months[$month] . " $year</caption>";
            echo "<tr>";
            foreach ($daysOfWeek as $day) {
                echo "<th>$day</th>";
            }
            echo "</tr>";

            $currentDay = 1;
            echo "<tr>";
            for ($i = 1; $i < $startDay; $i++) {
                echo "<td></td>";
            }

            while ($currentDay <= $daysInMonth) {
                $currentDate = sprintf('%04d-%02d-%02d', $year, $month, $currentDay);
                $isHoliday = in_array($currentDate, $holidays);
                $dayOfWeek = date('N', strtotime($currentDate));

                $classes = "";
                if ($dayOfWeek == 6 || $dayOfWeek == 7) {
                    $classes .= "weekend ";
                }
                if ($isHoliday) {
                    $classes .= "holiday";
                }

                echo "<td class='$classes'>$currentDay</td>";

                if ($startDay % 7 == 0) {
                    echo "</tr><tr>";
                }

                $currentDay++;
                $startDay++;
            }

            while ($startDay % 7 != 1) {
                echo "<td></td>";
                $startDay++;
            }

            echo "</tr>";
            echo "</table>";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $month = isset($_GET['month']) ? (int)$_GET['month'] : null;
            $year = isset($_GET['year']) ? (int)$_GET['year'] : null;

            $holidays = [
                "$year-01-01", 
                "$year-01-07", 
                "$year-02-23", 
                "$year-03-08", 
                "$year-05-01", 
                "$year-05-09", 
                "$year-06-12", 
                "$year-11-04", 
            ];

            generateCalendar($month, $year, $holidays);
        }
        ?>
    </div>
</body>
</html>
