<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("<div style='text-align: center; margin-top: 50px; font-size: 20px; color: red;'>Доступ запрещён!</div>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    if ($stmt->fetchColumn() > 0) {
        die("<div style='text-align: center; margin-top: 50px; font-size: 20px; color: red;'>Логин уже существует. Выберите другой.</div>");
    }

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
    $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role]);

    echo "<div style='text-align: center; margin-top: 50px; font-size: 20px; color: green;'>Новый пользователь добавлен!</div>";
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление пользователя</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4CAF50;
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
        input[type="text"], input[type="password"], select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .back-link {
            text-align: center;
            margin-top: 15px;
        }
        .back-link a {
            color: #4CAF50;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Добавление нового пользователя</h1>
        <form method="post">
            <label for="username">Логин:</label>
            <input type="text" name="username" id="username" placeholder="Введите логин" required>

            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" placeholder="Введите пароль" required>

            <label for="role">Роль:</label>
            <select name="role" id="role">
                <option value="user">Пользователь</option>
                <option value="admin">Администратор</option>
            </select>

            <button type="submit">Добавить пользователя</button>
        </form>
        <div class="back-link">
            <a href="admin.php">Вернуться на главную</a>
        </div>
    </div>
</body>
</html>
