<?php
require_once __DIR__ . '/includes/functions.php';

$category = $_GET['category'] ?? null;
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 6;
$offset = ($page - 1) * $perPage;
$total = 0;
$exhibits = getExhibits($pdo, $category, $perPage, $offset, $total);
$categories = getCategories($pdo);
$totalPages = max(1, (int)ceil($total / $perPage));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все экспонаты — МИИ</title>
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
                <li><a href="/exhibits.php" class="active">Картины</a></li>
                <li><a href="/partners.php">Партнеры</a></li>
                <li><a href="/salon.php">Салон «Губернаторский»</a></li>
                <li><a href="/visitors.php">Посетителям</a></li>
                <li><a href="/index.php#contacts">Контакты</a></li>
            </ul>
        </nav>
    </div>
</header>

<main class="section">
    <div class="container">
        <p class="eyebrow">Коллекции</p>
        <h1>Все экспонаты музея</h1>
        <p>Выберите направление искусства, чтобы увидеть произведения из фонда музея. Фильтр по категориям помогает быстро найти нужный зал.</p>

        <div class="category-filter">
            <a class="filter-chip <?= !$category ? 'active' : '' ?>" href="/exhibits.php">Все</a>
            <?php foreach ($categories as $cat): ?>
                <a class="filter-chip <?= $category === $cat ? 'active' : '' ?>" href="?category=<?= urlencode($cat) ?>"><?= htmlspecialchars($cat) ?></a>
            <?php endforeach; ?>
        </div>

        <?php if ($exhibits): ?>
            <div class="exhibit-grid">
                <?php foreach ($exhibits as $item): ?>
                    <article class="exhibit-card">
                        <a href="/exhibit.php?id=<?= htmlspecialchars($item['id']) ?>">
                            <div class="thumb" style="background-image:url('<?= htmlspecialchars($item['main_image']) ?>');"></div>
                            <div class="exhibit-card__body">
                                <h3><?= htmlspecialchars($item['short_title']) ?></h3>
                                <p class="meta"><?= htmlspecialchars($item['year_created']) ?></p>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>В выбранной категории пока нет экспонатов. Попробуйте другой фильтр.</p>
        <?php endif; ?>

        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <?php
                $params = ['page' => $i];
                if ($category) {
                    $params['category'] = $category;
                }
                $url = '?' . http_build_query($params);
                ?>
                <a class="page-link <?= $page === $i ? 'active' : '' ?>" href="<?= $url ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </div>
</main>

<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <div class="logo">МИИ</div>
            <p>ул. Труда, 64, Екатеринбург</p>
            <a class="phone" href="tel:+73512223344">+7 (351) 222-33-44</a>
        </div>
        <div>
            <h4>Навигация</h4>
            <ul>
                <li><a href="/index.php#about">О музее</a></li>
                <li><a href="/partners.php">Партнеры</a></li>
                <li><a href="/salon.php">Салон</a></li>
                <li><a href="/visitors.php">Посетителям</a></li>
            </ul>
        </div>
    </div>
</footer>
<?php include __DIR__ . '/plugins/random-line/random_line.php'; ?>
</body>
</html>
