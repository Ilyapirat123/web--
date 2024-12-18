<?php
include 'db.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $sql = "SELECT username, password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($username, $password);

    if ($stmt->num_rows > 0) {
        $stmt->fetch();
    } else {
        die("Пользователь не найден.");
    }
} else {
    die("ID пользователя не передан.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['username'];
    $new_password = $_POST['password'];

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $update_sql = "UPDATE users SET username = ?, password = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $new_username, $hashed_password, $user_id);
    if ($update_stmt->execute()) {
        header('Location: admin_panel.php');
        exit;
    } else {
        echo "Ошибка обновления данных.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать пользователя</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 6px 0;
            text-align: center;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header h1 {
            font-size: 36px;
            font-weight: bold;
        }

        header nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            margin: 0 15px;
            transition: color 0.3s;
        }

        header nav a:hover {
            color: #81c784;
        }

        /* Основное оформление */
        main.form-container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        main h2 {
            text-align: center;
            color: #4CAF50;
            font-size: 28px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            margin-bottom: 15px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #388e3c;
        }

        .error {
            color: #f44336;
            background-color: #ffebee;
            padding: 10px;
            border: 1px solid #f44336;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            font-size: 16px;
        }

        p a {
            color: #4CAF50;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Подвал */
        footer {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>Админ Панель</h1>
        <nav>
            <a href="admin_panel.php">Панель</a>
            <a href="logout.php">Выход</a>
        </nav>
    </div>
</header>

<main class="form-container">
    <h2>Редактировать пользователя</h2>
    <form action="edit_user.php?id=<?php echo $user_id; ?>" method="POST">
        <label for="username">Никнейм:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required><br><br>
        
        <label for="password">Новый пароль:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit">Сохранить изменения</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 Все права защищены</p>
</footer>

</body>
</html>
