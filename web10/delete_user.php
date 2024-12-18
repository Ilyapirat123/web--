<?php
include 'db.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $userId = intval($_GET['id']); 

    $query = "DELETE FROM users WHERE id = ?";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $userId); 
        if ($stmt->execute()) {
            header("Location: admin_panel.php?message=success");
        } else {
            header("Location: admin_panel.php?message=error");
        }
        $stmt->close();
    } else {
        header("Location: admin_panel.php?message=error");
    }
} else {
    header("Location: admin_panel.php?message=invalid_id");
}

$conn->close();
?>
