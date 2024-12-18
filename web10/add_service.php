<?php
include 'includes/header.php';
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;

    if (empty($title)) {
        $error = "Название услуги обязательно для заполнения.";
    }

    if (!isset($error)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($image_file_type, $allowed_types)) {
            $error = "Неверный формат файла. Разрешены только изображения формата JPG, JPEG, PNG, GIF.";
        } elseif (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $error = "Ошибка при загрузке изображения.";
        }

        if (!isset($error)) {
            $query = "INSERT INTO services (title, description, image_path) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sss', $title, $description, $target_file);

            if ($stmt->execute()) {
                header('Location: services.php');
                exit();
            } else {
                $error = "Ошибка при добавлении услуги. Попробуйте снова.";
            }
        }
    }
}
?>

<main>
    <h2>Добавить услугу</h2>
    <?php if (isset($error)): ?>
        <p style="color:red"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <label>Название услуги: <input type="text" name="title" required></label><br>
        <label>Описание услуги: <textarea name="description" required></textarea></label><br>
        <label>Изображение услуги: <input type="file" name="image" accept="image/*" required></label><br>
        <button type="submit">Добавить услугу</button>
    </form>
</main>

<?php
include 'includes/footer.php';
?>
