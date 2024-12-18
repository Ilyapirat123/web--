<?php
require_once 'config.php';

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); 
    exit();
}

$sql = "SELECT id, name, description, image_path FROM services";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_service'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image_path = ''; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_path = 'uploads/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }

    $sql = "INSERT INTO services (name, description, image_path) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $description, $image_path);
    $stmt->execute();
    
    header("Location: manage_services.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление услугами</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Управление услугами</h1>
            <nav>
                <a href="admin_panel.php">Панель администратора</a>
                <a href="index.php">Главная</a>
                <a href="logout.php">Выход</a>
            </nav>
        </header>

        <main>
            <h2>Добавить услугу</h2>
            <form action="manage_services.php" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="name">Название услуги:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="description">Описание:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div>
                    <label for="image">Изображение:</label>
                    <input type="file" id="image" name="image">
                </div>
                <button type="submit" name="add_service">Добавить услугу</button>
            </form>

            <h3>Список услуг</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Изображение</th>
                    <th>Действия</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['description']); ?></td>
                        <td>
                            <?php if ($row['image_path']) { ?>
                                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="Image" width="100">
                            <?php } ?>
                        </td>
                        <td>
                            <a href="edit_service.php?id=<?php echo $row['id']; ?>">Редактировать</a>
                            <a href="delete_service.php?id=<?php echo $row['id']; ?>">Удалить</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </main>
    </div>
</body>
</html>
