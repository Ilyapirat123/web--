<?php
require_once 'config.php';

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); 
    exit();
}

$sql = "SELECT id, username, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="style7.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Панель администратора</h1>
            <nav>
                <a href="index.php">Главная</a>
                <a href="logout.php">Выход</a>
            </nav>
        </header>

        <main>
            <h2>Управление пользователями</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Логин</th>
                    <th>Роль</th>
                    <th>Действия</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['id']; ?>">Редактировать</a>
                            <a href="delete_user.php?id=<?php echo $row['id']; ?>">Удалить</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </main>
    </div>
</body>
</html>
