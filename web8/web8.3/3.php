<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .success, .error {
            text-align: center;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Регистрация</h2>
        <form method="POST" action="">
            <label for="fio">ФИО:</label>
            <input type="text" id="fio" name="fio" required>

            <label for="login">Логин:</label>
            <input type="text" id="login" name="login" required>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>

            <label for="dob">Дата рождения:</label>
            <input type="date" id="dob" name="dob" required>

            <button type="submit">Зарегистрироваться</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fio = htmlspecialchars(trim($_POST['fio']));
            $login = htmlspecialchars(trim($_POST['login']));
            $password = htmlspecialchars(trim($_POST['password']));
            $dob = htmlspecialchars(trim($_POST['dob']));

            if (strlen($login) < 5) {
                echo "<div class='error'>Логин должен содержать не менее 5 символов.</div>";
            } elseif (strlen($password) < 6) {
                echo "<div class='error'>Пароль должен содержать не менее 6 символов.</div>";
            } else {
                echo "<div class='success'>Регистрация прошла успешно!</div>";
            }
        }
        ?>
    </div>
</body>
</html>
