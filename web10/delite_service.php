<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

if (isset($_GET['id'])) {
    $service_id = $_GET['id'];

    $query = "DELETE FROM services WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $service_id);

    if ($stmt->execute()) {
        header('Location: admin.php');
        exit();
    } else {
        echo "Ошибка удаления услуги.";
    }
} else {
    header('Location: admin.php');
    exit();
}
?>
