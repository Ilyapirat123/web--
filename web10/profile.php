<?php
require_once 'config.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<p style='color: red;'>Ошибка: пользователь не найден.</p>";
    exit(); 
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {

        $new_username = $_POST['username'];


        $new_password = password_hash($_POST['password'], PASSWORD_BCRYPT);


        $update_sql = "UPDATE users SET username = ?, password = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssi", $new_username, $new_password, $user_id);
        $update_stmt->execute();


        $_SESSION['username'] = $new_username;

        header("Location: profile.php"); 
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <link rel="stylesheet" href="style6.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Добро пожаловать в профиль, <?php echo htmlspecialchars($user['username']); ?>!</h1>
            <nav>
                <a href="index.php">Главная</a>
                <a href="services.php">Услуги</a>
                <a href="logout.php">Выход</a>
            </nav>
        </header>

        <main>
            <h2>Информация о вашем профиле</h2>
            <form method="POST" action="profile.php">
                <div>
                    <label for="username">Логин:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <div>
                    <label for="password">Новый пароль:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="update_profile">Обновить профиль</button>
            </form>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <h3>Панель администратора</h3>
                <ul>
                    <li><a href="admin_panel.php">Управление пользователями</a></li>
                </ul>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>
