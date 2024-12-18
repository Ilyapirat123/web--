
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
    <link rel="stylesheet" href="style2.css">
<main>
    <section class="news-section">
        <div class="container">
            <h2>Новости в мире садоводства</h2>
            <div class="news-grid">
                <article class="news-article">
                    <h3>Как подготовить грунт для лучшего урожая?</h3>
                    <p>Подготовка почвы — это один из важнейших этапов для выращивания здоровых и продуктивных растений. Чтобы получить хороший урожай, необходимо правильно подобрать и обработать грунт. Важно следить за его pH, добавлять органические удобрения и регулярно аэрацию. Свежий компост или перегной являются отличным способом улучшить структуру почвы и обеспечить растения всеми необходимыми питательными веществами. Кроме того, улучшение качества почвы способствует увеличению влагоемкости и уменьшению необходимости в частом поливе. В конце концов, здоровая почва — это залог здорового урожая!</p>
                </article>
                
                <article class="news-article">
                    <h3>Почему стоит выбирать органические удобрения?</h3>
                    <p>Органические удобрения — это лучший способ поддержания здоровья почвы. В отличие от синтетических веществ, они обогащают грунт не только питательными веществами, но и полезными микроорганизмами. Компост, перегной, куриный помет и другие натуральные удобрения поддерживают жизнедеятельность почвенных бактерий, улучшая структуру почвы и увеличивая ее способность удерживать влагу. Такие удобрения способствуют экологической безопасности и сохранению природного баланса в саду, что является большим плюсом для тех, кто стремится к экологическому садоводству.</p>
                </article>
                
                <article class="news-article">
                    <h3>Выбор правильных удобрений для вашего огорода</h3>
                    <p>Правильный выбор удобрений зависит от многих факторов, включая тип почвы, растения, которые вы планируете выращивать, и климатические условия. Азотные удобрения способствуют активному росту листьев и стеблей, фосфорные — укрепляют корневую систему, а калийные — повышают устойчивость растений к заболеваниям и стрессу. Важно не только правильно выбрать тип удобрений, но и следить за дозировкой, чтобы не переудобрить растения, что может привести к их повреждению.</p>
                </article>

                <article class="news-article">
                    <h3>Как избавиться от вредителей на даче?</h3>
                    <p>Борьба с вредителями — неотъемлемая часть ухода за садом. Использование химических средств может быть опасным как для растений, так и для экосистемы в целом. Вместо этого рекомендуется использовать натуральные методы борьбы. Например, настой чеснока или табака может эффективно бороться с насекомыми. Также полезно привлекать в сад полезных насекомых, таких как божьи коровки, которые естественным образом контролируют популяции вредителей. Комплексный подход поможет сохранить сад здоровым и экологически чистым.</p>
                </article>

                <article class="news-article">
                    <h3>Советы по выращиванию арбузов в умеренном климате</h3>
                    <p>Арбузы, как правило, растут в жарких и солнечных регионах, но с правильной подготовкой почвы и сорта, они могут успешно расти даже в умеренном климате. Важно выбрать сорта, которые подходят для менее теплых условий. Убедитесь, что ваши растения получают достаточно солнечного света, а также внимательно следите за поливом. Арбузы требуют частого, но умеренного полива, чтобы не загнивать. Почва должна быть легкой и хорошо дренированной, с высоким содержанием органических веществ.</p>
                </article>

                <article class="news-article">
                    <h3>Как организовать полив на даче без лишних затрат</h3>
                    <p>Системы капельного полива — это отличный способ сэкономить воду и время. Такой подход позволяет доставить воду прямо к корням растений, минимизируя потери воды в результате испарения. Существуют готовые решения для установки капельного полива, которые можно настроить в зависимости от потребностей вашего сада или огорода. Это не только экономит деньги на водоснабжении, но и помогает растениям получать оптимальное количество влаги для роста.</p>
                </article>

                <article class="news-article">
                    <h3>Выращивание органических овощей: с чего начать?</h3>
                    <p>Органическое земледелие — это процесс, который требует особого подхода. Начать следует с анализа почвы, выбора экологически чистых семян и организации естественного контроля за вредителями. Мульчирование и компостирование — это важнейшие этапы для создания здоровой экосистемы. Важно также обеспечить растения всем необходимым для их развития, не используя химических препаратов и пестицидов. Органическое земледелие позволяет не только сохранить экологический баланс, но и получить вкусные и здоровые овощи.</p>
                </article>
            </div>
        </div>
    </section>
</main>

<?php
include 'includes/footer.php';
?>
