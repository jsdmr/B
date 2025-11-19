<?php
require_once __DIR__ . '/includes/functions.php';
$partners = [
    [
        'name' => 'Региональный центр современного искусства',
        'desc' => 'Совместные проекты по популяризации молодых художников и создание интерактивных выставок.',
    ],
    [
        'name' => 'Уральский федеральный университет',
        'desc' => 'Исследовательские программы, лекции и работа с архивами, направленные на цифровизацию коллекций.',
    ],
    [
        'name' => 'Союз дизайнеров России',
        'desc' => 'Создание новой визуальной айдентики залов и разработка сувенирной продукции.',
    ],
    [
        'name' => 'Театр оперы и балета',
        'desc' => 'Кросс-жанровые проекты: выставки костюмов, декораций и музыкально-визуальные перформансы.',
    ],
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Партнеры музея</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/partials/simple-header.php'; ?>

<main class="section">
    <div class="container">
        <p class="eyebrow">Сотрудничество</p>
        <h1>Партнеры музея</h1>
        <p>Наши партнеры помогают реализовывать выставки, исследования и образовательные программы. Мы ценим совместное творчество и открыты к новым инициативам.</p>
        <div class="partner-list">
            <?php foreach ($partners as $partner): ?>
                <article>
                    <h3><?= htmlspecialchars($partner['name']) ?></h3>
                    <p><?= htmlspecialchars($partner['desc']) ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include __DIR__ . '/partials/simple-footer.php'; ?>
<?php include __DIR__ . '/plugins/random-line/random_line.php'; ?>
</body>
</html>
