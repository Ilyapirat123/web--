<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Садоводство</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <nav class="main-nav">
                <ul>
                    <li><a href="about.php">О компании</a></li>
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
        <section class="hero">
            <div class="hero-content">
                <h1>Лидер в области садоводства</h1>
                <div class="image-button-wrapper">
                    <a href="services.php" class="btn">Наши услуги</a> 
                    
                </div>
            </div>
        </section>
        <section class="news-section">
            <div class="container">
                <h2>Новости</h2>
                <div class="news-grid">
                    <article>
                        <h3>Сезон посадки арбузов</h3>
                        <p>Как подготовить грунт для лучшего урожая? Советы от наших экспертов.</p>
                        <a href="news.php#news1">Подробнее</a> 
                    </article>
                    <article>
                        <h3>Органические удобрения</h3>
                        <p>Почему стоит выбирать органические удобрения?</p>
                        <a href="news.php#news2">Подробнее</a> 
                    </article>
                </div>
            </div>
        </section>
    </main>
    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2024 Садоводство. Все права защищены.</p>
        </div>
    </footer>
</body>
</html>
