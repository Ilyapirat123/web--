<?php
include 'includes/header.php';

if ($_SESSION['user']['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}
?>

<main>
    <h2>Админ панель</h2>
    
    <p>Добро пожаловать в админ панель, <?= htmlspecialchars($_SESSION['user']['username']); ?>!</p>

    <div>
        <h3>Управление услугами</h3>
        <p>Вы можете добавить, редактировать и удалять услуги.</p>
        <a href="services.php" class="btn">Перейти к услугам</a>
    </div>

    <div>
        <h3>Управление пользователями</h3>
        <p>Здесь можно редактировать пользователей.</p>
        <a href="users.php" class="btn">Перейти к пользователям</a>
    </div>
</main>

<?php
include 'includes/footer.php';
?>
