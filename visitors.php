<?php
require_once __DIR__ . '/includes/functions.php';
$faq = [
    ['title' => 'Стоимость билетов', 'text' => 'Взрослый — 350 ₽, студенты и пенсионеры — 200 ₽, дети до 7 лет бесплатно.'],
    ['title' => 'Экскурсионные группы', 'text' => 'Группы до 20 человек обслуживаются по предварительной записи. Стоимость экскурсии — 2000 ₽.'],
    ['title' => 'Фото и видео', 'text' => 'Любительская съемка без вспышки разрешена. Для профессиональной съемки требуется согласование.'],
    ['title' => 'Доступная среда', 'text' => 'В музее есть лифт, тактильные копии экспонатов и тифлокомментарии для незрячих посетителей.'],
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Посетителям</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/partials/simple-header.php'; ?>

<main class="section">
    <div class="container">
        <p class="eyebrow">Посетителям</p>
        <h1>Полезная информация</h1>
        <div class="visitor-grid">
            <article>
                <h3>Режим работы</h3>
                <p>Вт — Вс с 10:00 до 20:00. Понедельник — санитарный день.</p>
            </article>
            <article>
                <h3>Кассы</h3>
                <p>Кассы работают до 19:30. Онлайн-покупка доступна круглосуточно.</p>
            </article>
            <article>
                <h3>Сервисы</h3>
                <p>Камера хранения, кафе, магазин сувениров, бесплатный Wi-Fi.</p>
            </article>
        </div>

        <section class="section">
            <h2>Частые вопросы</h2>
            <div class="faq-list">
                <?php foreach ($faq as $item): ?>
                    <details>
                        <summary><?= htmlspecialchars($item['title']) ?></summary>
                        <p><?= htmlspecialchars($item['text']) ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>

<?php include __DIR__ . '/partials/simple-footer.php'; ?>
<?php include __DIR__ . '/plugins/random-line/random_line.php'; ?>
</body>
</html>
