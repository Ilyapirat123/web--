<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    die("<div style='text-align: center; margin-top: 50px; font-size: 20px; color: red;'>Доступ запрещён!</div>");
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['id'] !== $id) {
        die("<div style='text-align: center; margin-top: 50px; font-size: 20px; color: red;'>У вас нет прав для редактирования этого пользователя!</div>");
    }
} else {
    $id = $_SESSION['user']['id'];
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();

if (!$user) {
    die("<div style='text-align: center; margin-top: 50px; font-size: 20px; color: red;'>Пользователь не найден!</div>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $user['password'];
    $role = $_POST['role'];

    if ($username !== $user['username']) {
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username AND id != :id");
        $checkStmt->execute(['username' => $username, 'id' => $id]);
        if ($checkStmt->fetchColumn() > 0) {
            die("<div style='text-align: center; margin-top: 50px; font-size: 20px; color: red;'>Логин уже занят!</div>");
        }
    }

    $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id");
    $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role, 'id' => $id]);

    echo "<div style='text-align: center; margin-top: 50px; font-size: 20px; color: green;'>Данные обновлены!</div>";
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование пользователя</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Редактирование пользователя</h1>
        <form method="post">
            <label for="username">Логин:</label>
            <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" placeholder="Логин" required>

            <label for="password">Пароль (оставьте пустым, если не меняете):</label>
            <input type="password" name="password" placeholder="Пароль">

            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <label for="role">Роль:</label>
                <select name="role" required>
                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Пользователь</option>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Администратор</option>
                </select>
            <?php endif; ?>

            <button type="submit">Сохранить</button>
        </form>
    </div>
</body>
</html>
