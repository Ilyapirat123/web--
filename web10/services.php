<?php
include 'db.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    $query = "SELECT role FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();
} else {
    $role = null;
}

$query = "SELECT * FROM services";
$result = $conn->query($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'], $_POST['description'], $_FILES['image'])) {
    if ($role === 'admin' || $role === 'user') {
        $title = $_POST['title'];
        $description = $_POST['description'];

        $image = $_FILES['image'];
        $image_name = $image['name'];
        $image_tmp_name = $image['tmp_name'];
        $image_size = $image['size'];
        $image_error = $image['error'];

        if ($image_error === 0) {
            if ($image_size <= 5 * 1024 * 1024) {
                $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));


                $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array($image_ext, $allowed_extensions)) {

                    $image_new_name = uniqid('', true) . '.' . $image_ext;
                    $image_destination = 'uploads/' . $image_new_name;


                    if (move_uploaded_file($image_tmp_name, $image_destination)) {

                        $insertQuery = "INSERT INTO services (title, description, image_path) VALUES (?, ?, ?)";
                        $stmt = $conn->prepare($insertQuery);
                        $stmt->bind_param('sss', $title, $description, $image_destination);
                        $stmt->execute();
                        $stmt->close();
                        

                        header("Location: services.php");
                        exit;
                    } else {
                        echo "Ошибка при загрузке файла.";
                    }
                } else {
                    echo "Недопустимый формат файла. Разрешены только изображения (JPG, JPEG, PNG, GIF).";
                }
            } else {
                echo "Файл слишком большой. Максимальный размер — 5 MB.";
            }
        } else {
            echo "Ошибка при загрузке изображения.";
        }
    } else {
        echo "У вас нет прав для добавления услуги.";
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_service'])) {
    if ($role === 'admin') {
        $service_id = $_POST['delete_service'];


        $query = "SELECT image_path FROM services WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $service_id);
        $stmt->execute();
        $stmt->bind_result($image_path);
        $stmt->fetch();
        $stmt->close();


        $deleteQuery = "DELETE FROM services WHERE id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param('i', $service_id);
        $stmt->execute();
        $stmt->close();


        if ($image_path && file_exists($image_path)) {
            unlink($image_path); 
        }


        header("Location: services.php");
        exit;
    } else {
        echo "У вас нет прав для удаления услуги.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все услуги</title>
    <link rel="stylesheet" href="style3.css"> 
</head>
<body>
<header class="main-header">
    <div class="container">
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="services.php">Наши услуги</a></li>
                <li><a href="news.php">Новости</a></li>
                <li><a href="about.php">Контакты</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="profile.php">Личный кабинет</a></li>
                    <li><a href="logout.php">Выйти</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="login-btn">Вход</a></li>
                    <li><a href="register.php">Регистрация</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <div class="image-bar">

        <img src="1.png" alt="Изображение 1">
        <img src="2.png" alt="Изображение 2">
        <img src="3.png" alt="Изображение 3">
        <img src="4.png" alt="Изображение 4">
        <img src="5.png" alt="Изображение 5">
        <img src="6.png" alt="Изображение 6">
        <img src="7.png" alt="Изображение 7">
        <img src="8.png" alt="Изображение 8">
        <img src="9.png" alt="Изображение 9">
        <img src="10.png" alt="Изображение 10">
        <img src="11.png" alt="Изображение 11">
        <img src="12.png" alt="Изображение 12">
        <img src="13.png" alt="Изображение 13">
        <img src="14.png" alt="Изображение 14">
        <img src="15.png" alt="Изображение 15">
    </div>
</header>

<main>
    <section class="services-section">
        <h2>Все услуги</h2>
        <table class="services-table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Изображение</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($service = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($service['title']) ?></td>
                        <td><?= htmlspecialchars(substr($service['description'], 0, 50)) ?>...</td>
                        <td><img src="<?= htmlspecialchars($service['image_path']) ?>" class="service-image" alt="Изображение услуги"></td>
                        <td><?= $service['created_at'] ?></td>
                        <td>
                            <a href="edit_service.php?id=<?= $service['id'] ?>" class="btn-edit">Редактировать</a>
                            <?php if ($role === 'admin'): ?>
                                <form action="services.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="delete_service" value="<?= $service['id'] ?>">
                                    <button type="submit" class="btn-delete" onclick="return confirm('Вы уверены, что хотите удалить эту услугу?')">Удалить</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        

        <?php if ($role === 'admin' || $role === 'user'): ?>
        <h3>Добавить услугу</h3>
        <form action="services.php" method="POST" enctype="multipart/form-data">
            <label for="title">Название:</label>
            <input type="text" name="title" id="title" required>
            
            <label for="description">Описание:</label>
            <textarea name="description" id="description" required></textarea>
            
            <label for="image">Изображение:</label>
            <input type="file" name="image" id="image" accept="image/*" required>
            
            <button type="submit">Добавить услугу</button>
        </form>
        <?php endif; ?>
    </section>
</main>

<footer class="main-footer">
    <p>© 2024 Все права защищены</p>
</footer>
</body>
</html>
