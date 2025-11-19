<?php
require_once __DIR__ . '/includes/functions.php';

$id = (int)($_GET['id'] ?? 0);
$exhibit = $id ? getExhibitById($pdo, $id) : null;

if (!$exhibit) {
    http_response_code(404);
    echo '<!DOCTYPE html><html lang="ru"><head><meta charset="UTF-8"><title>Экспонат не найден</title><link rel="stylesheet" href="/assets/css/style.css"></head><body><div class="section"><div class="container"><h1>Экспонат не найден</h1><p>Похоже, что выбранный экспонат отсутствует в базе. Вернитесь к <a href="/exhibits.php">списку экспонатов</a>.</p></div></div></body></html>';
    exit;
}

$images = getExhibitImages($pdo, $exhibit['id']);
$links = getExhibitLinks($pdo, $exhibit['id']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($exhibit['full_title']) ?> — МИИ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container header-grid">
        <div class="logo">МИИ</div>
        <nav>
            <ul>
                <li><a href="/index.php#about">О музее</a></li>
                <li><a href="/exhibits.php">Картины</a></li>
                <li><a href="/partners.php">Партнеры</a></li>
                <li><a href="/salon.php">Салон «Губернаторский»</a></li>
                <li><a href="/visitors.php">Посетителям</a></li>
                <li><a href="/index.php#contacts">Контакты</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <section class="section">
        <div class="container exhibit-detail">
            <div class="hero-image" style="background-image:url('<?= htmlspecialchars($exhibit['main_image']) ?>');"></div>
            <div class="detail-content">
                <p class="eyebrow"><?= htmlspecialchars($exhibit['category']) ?></p>
                <h1><?= htmlspecialchars($exhibit['full_title']) ?></h1>
                <p class="meta">Автор: <strong><?= htmlspecialchars($exhibit['author']) ?></strong> · <?= htmlspecialchars($exhibit['year_created']) ?> · <?= htmlspecialchars($exhibit['country']) ?></p>
                <p><?= nl2br(htmlspecialchars($exhibit['description'])) ?></p>
                <ul class="detail-list">
                    <li><span>Категория</span><strong><?= htmlspecialchars($exhibit['category']) ?></strong></li>
                    <li><span>Автор</span><strong><?= htmlspecialchars($exhibit['author']) ?></strong></li>
                    <li><span>Год</span><strong><?= htmlspecialchars($exhibit['year_created']) ?></strong></li>
                    <li><span>Страна</span><strong><?= htmlspecialchars($exhibit['country']) ?></strong></li>
                </ul>
            </div>
        </div>
    </section>

    <?php if ($images): ?>
        <section class="section alt">
            <div class="container">
                <h2>Дополнительные изображения</h2>
                <div class="gallery-grid">
                    <?php foreach ($images as $image): ?>
                        <img src="<?= htmlspecialchars($image['image_url']) ?>" alt="<?= htmlspecialchars($exhibit['short_title']) ?>">
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($links): ?>
        <section class="section">
            <div class="container">
                <h2>Дополнительные материалы</h2>
                <ul class="external-links">
                    <?php foreach ($links as $link): ?>
                        <li><a href="<?= htmlspecialchars($link['url']) ?>" target="_blank" rel="noopener"><?= htmlspecialchars($link['title']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>
</main>

<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <div class="logo">МИИ</div>
            <p>ул. Труда, 64, Екатеринбург</p>
        </div>
        <div>
            <a class="button ghost" href="/exhibits.php">Назад к экспонатам</a>
        </div>
    </div>
</footer>
<?php include __DIR__ . '/plugins/random-line/random_line.php'; ?>
</body>
</html>
