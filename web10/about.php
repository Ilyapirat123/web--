<?php
$pageTitle = "О компании - Садоводство и выращивание арбузов";

$companyName = "Садоводство MalGrow";
$founderName = "Илья Малков";
$groupName = "УБ23-08Б";
$description = "Наша компания занимается профессиональным выращиванием арбузов и предлагает широкий спектр садоводческих услуг. Основанная Ильей Малковым из группы УБ23-08Б, мы объединяем традиции и современные технологии для создания лучшего качества продукции.";
$mission = "Создавать экологически чистую продукцию, внедрять инновации в садоводстве и вдохновлять людей на заботу о природе.";
$vision = "Стать лидером на рынке садоводства и выращивания арбузов, создавая уникальные и качественные продукты.";

$services = [
    "Профессиональное выращивание арбузов с использованием органических удобрений.",
    "Создание и обслуживание садов под ключ.",
    "Консультации по садоводству и выращиванию бахчевых культур.",
    "Проведение обучающих семинаров и тренингов.",
];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="style8.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>О компании "<?php echo $companyName; ?>"</h1>
        </header>

        <main>
            <section class="about">
                <h2>О нас</h2>
                <p><?php echo $description; ?></p>
                <p><strong>Миссия:</strong> <?php echo $mission; ?></p>
                <p><strong>Видение:</strong> <?php echo $vision; ?></p>
            </section>

            <section class="services">
                <h2>Наши услуги</h2>
                <ul>
                    <?php foreach ($services as $service): ?>
                        <li><?php echo $service; ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <section class="founder">
                <h2>Об основателе</h2>
                <p>Илья Малков, студент группы <?php echo $groupName; ?>, создал компанию "<?php echo $companyName; ?>" с целью вдохновить людей заботиться о природе и использовать возможности современной агрономии для создания уникальных продуктов, таких как экологически чистые арбузы.</p>
            </section>

            <section class="contacts">
                <h2>Контакты</h2>
                <p>Телефон: +7 (929) 335-81-60</p>
                <p>Email: malkov.ilya.2005@gmail.com</p>
                <p>Адрес: ул. Весны, д. 7, г. Красноярск</p>
            </section>
        </main>

        <footer>
            <p>&copy; <?php echo date("Y"); ?> <?php echo $companyName; ?>. Все права защищены.</p>
        </footer>
    </div>
</body>
</html>
