<?php
session_start();
require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    if (empty($username) || empty($password)) {
        $error = "Все поля должны быть заполнены.";
    } else {

        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Пользователь с таким логином уже существует.";
        } else {
       
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insertQuery = "INSERT INTO users (username, password, role) VALUES (?, ?, 'user')";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param('ss', $username, $hashed_password);

            if ($stmt->execute()) {
                header('Location: login.php');
                exit();
            } else {
                $error = "Ошибка регистрации. Попробуйте еще раз.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style5.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1>Садоводство</h1>
            <nav>
                <a href="index.php">Главная</a>
                <a href="login.php">Вход</a>
            </nav>
        </div>
    </header>
    <main class="form-container">
        <h2>Регистрация</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST">
            <label>
                Логин:
                <input type="text" name="username" required>
            </label>
            <label>
                Пароль:
                <input type="password" name="password" required>
            </label>
            <button type="submit" class="btn">Зарегистрироваться</button>
        </form>
        <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
    </main>
    <footer>
        <p>&copy; 2024 Садоводство. Все права защищены.</p>
    </footer>
</body>
</html>
