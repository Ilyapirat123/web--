<?php
include 'includes/db.php';

if (!isset($_GET['id'])) {
    header('Location: services.php');
    exit();
}

$id = $_GET['id'];

$query = "SELECT * FROM services WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: services.php');
    exit();
}

$service = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $service['image_path']; 

    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($image_file_type, $allowed_types)) {
            $error = "Неверный формат файла. Разрешены только изображения формата JPG, JPEG, PNG, GIF.";
        }

        if (!isset($error)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image = $target_file;
            } else {
                $error = "Ошибка при загрузке изображения.";
            }
        }
    }

    if (!isset($error)) {
        $query = "UPDATE services SET title = ?, description = ?, image_path = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssi', $title, $description, $image, $id);

        if ($stmt->execute()) {
            header('Location: services.php');
            exit();
        } else {
            $error = "Ошибка при обновлении услуги. Попробуйте снова.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать услугу - <?= htmlspecialchars($service['title']) ?></title>
    <link rel="stylesheet" href="style4.css">
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
                    <li><a href="login.php">Вход</a></li>
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
    <div class="main-edit-section">
        <h2>Редактировать услугу: <?= htmlspecialchars($service['title']) ?></h2>
        <?php if (isset($error)): ?>
            <p style="color:red"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <label>Название услуги: <input type="text" name="title" value="<?= htmlspecialchars($service['title']) ?>" required></label><br>
            <label>Описание услуги: <textarea name="description" required><?= htmlspecialchars($service['description']) ?></textarea></label><br>
            <label>Изображение услуги: <input type="file" name="image" accept="image/*"></label><br>
            <button type="submit">Сохранить изменения</button>
        </form>
    </div>
</main>

<?php
include 'includes/footer.php';
?>
</body>
</html>
