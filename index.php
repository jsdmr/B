<?php
require_once __DIR__ . '/includes/functions.php';

$formSuccess = false;
$formError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = [
        'visit_date' => $_POST['visit_date'] ?? '',
        'visit_time' => $_POST['visit_time'] ?? '',
        'name'       => trim($_POST['name'] ?? ''),
        'whatsapp'   => trim($_POST['whatsapp'] ?? ''),
    ];

    if (in_array('', $payload, true)) {
        $formError = 'Пожалуйста, заполните все поля формы.';
    } else {
        $formSuccess = saveVisitRequest($pdo, $payload);
        if (!$formSuccess) {
            $formError = 'Не удалось отправить заявку. Попробуйте еще раз позже.';
        }
    }
}

$featuredExhibits = getFeaturedExhibits($pdo);
$categories = getCategories($pdo);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Музей изобразительных искусств</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-1ycn6Ica999/t1w6NUA9H9g6G7Sk1z1B3Q1Z6G7Gm0+AjPRXUqFVLtZL1YI7Di5urN6LyjHgNsZM3Rp3crIanw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header class="site-header">
    <div class="container header-grid">
        <div class="logo">МИИ</div>
        <nav>
            <ul>
                <li><a href="#about">О музее</a></li>
                <li><a href="/exhibits.php">Картины</a></li>
                <li><a href="/partners.php">Партнеры</a></li>
                <li><a href="/salon.php">Художественный салон «Губернаторский»</a></li>
                <li><a href="/visitors.php">Посетителям</a></li>
                <li><a href="#contacts">Контакты</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <section class="hero">
        <div class="swiper hero-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide" style="background-image:url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1400&q=80');">
                    <div class="slide-caption">
                        <p>Постоянные экспозиции русского искусства</p>
                    </div>
                </div>
                <div class="swiper-slide" style="background-image:url('https://images.unsplash.com/photo-1465311440653-ba9b1d68da18?auto=format&fit=crop&w=1400&q=80');">
                    <div class="slide-caption">
                        <p>Редкие произведения западноевропейских мастеров</p>
                    </div>
                </div>
                <div class="swiper-slide" style="background-image:url('https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?auto=format&fit=crop&w=1400&q=80');">
                    <div class="slide-caption">
                        <p>Временные выставки современного искусства</p>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section id="about" class="section">
        <div class="container two-columns">
            <div>
                <h2>О музее</h2>
                <p>Музей изобразительных искусств — это пространство, где встречаются классика и современность. В фондах хранится более 25 тысяч произведений живописи, скульптуры, графики и декоративно-прикладного искусства. Мы тщательно изучаем каждую историю, связанную с нашими экспонатами, и делимся ими с посетителями.</p>
                <p>Сегодня музей развивает образовательные программы, сотрудничает с художественными школами и реализует цифровые проекты, которые позволяют увидеть мировые шедевры под новым углом.</p>
            </div>
            <img src="https://images.unsplash.com/photo-1529429617124-aee711a70412?auto=format&fit=crop&w=900&q=80" alt="О музее">
        </div>
    </section>

    <section class="section" id="exhibits">
        <div class="container">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">интерактивная подборка</p>
                    <h2>Интересные экспонаты</h2>
                </div>
                <a class="button ghost" href="/exhibits.php">Все экспонаты</a>
            </div>
            <div class="exhibit-grid">
                <?php foreach ($featuredExhibits as $item): ?>
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
        </div>
    </section>

    <section class="section partners-highlight">
        <div class="container two-columns">
            <div>
                <p class="eyebrow">партнеры</p>
                <h2>Мы создаем проекты вместе</h2>
                <p>Кураторские и просветительские программы реализуются совместно с академическими институтами, бизнес-партнерами и художественным салоном «Губернаторский». Мы благодарны каждому, кто поддерживает культуру региона.</p>
                <div class="stacked-links">
                    <a href="/partners.php">Наши партнеры</a>
                    <a href="/salon.php">Художественный салон «Губернаторский»</a>
                </div>
            </div>
            <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=900&q=80" alt="Партнеры">
        </div>
    </section>

    <section id="contacts" class="section contact-section">
        <div class="container contact-grid">
            <div>
                <p class="eyebrow">Наши контакты</p>
                <h2>Планируйте визит</h2>
                <ul class="contact-list">
                    <li><strong>Телефон:</strong> <a href="tel:+73512223344">+7 (351) 222-33-44</a></li>
                    <li><strong>Адрес:</strong> ул. Труда, 64, Екатеринбург</li>
                    <li><strong>Как добраться:</strong> трамвай №3, автобус №26, парковка для посетителей со стороны ул. Карла Либкнехта.</li>
                    <li><strong>Время работы:</strong> ежедневно с 10:00 до 20:00, выходной — понедельник.</li>
                </ul>
            </div>
            <div>
                <p class="eyebrow">Форма заявки</p>
                <?php if ($formSuccess): ?>
                    <div class="form-success">Спасибо! Мы свяжемся с вами для подтверждения визита.</div>
                <?php elseif ($formError): ?>
                    <div class="form-error"><?= htmlspecialchars($formError) ?></div>
                <?php endif; ?>
                <form method="post" class="visit-form">
                    <label>Дата посещения
                        <input type="date" name="visit_date" required>
                    </label>
                    <label>Время посещения
                        <input type="time" name="visit_time" required>
                    </label>
                    <label>Имя
                        <input type="text" name="name" placeholder="Как вас зовут?" required>
                    </label>
                    <label>WhatsApp номер
                        <input type="tel" name="whatsapp" placeholder="+7 (9XX) XXX-XX-XX" required>
                    </label>
                    <button type="submit" class="button">Отправить заявку</button>
                </form>
            </div>
        </div>
    </section>

    <section class="section map-section">
        <div class="container">
            <img src="https://images.unsplash.com/photo-1521292270410-a8c2e04a6f5d?auto=format&fit=crop&w=1400&q=80" alt="Карта" class="map-placeholder">
        </div>
    </section>
</main>

<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <div class="logo">МИИ</div>
            <p>ул. Труда, 64, Екатеринбург</p>
            <a class="phone" href="tel:+73512223344">+7 (351) 222-33-44</a>
            <div class="social">
                <a href="https://vk.com" target="_blank" aria-label="VK"><i class="fa-brands fa-vk"></i></a>
                <a href="https://t.me" target="_blank" aria-label="Telegram"><i class="fa-brands fa-telegram"></i></a>
                <a href="https://youtube.com" target="_blank" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>
        <div>
            <h4>Меню</h4>
            <ul>
                <li><a href="#about">О музее</a></li>
                <li><a href="/exhibits.php">Картины</a></li>
                <li><a href="/partners.php">Партнеры</a></li>
                <li><a href="/salon.php">Салон «Губернаторский»</a></li>
                <li><a href="/visitors.php">Посетителям</a></li>
                <li><a href="#contacts">Контакты</a></li>
            </ul>
        </div>
        <div class="footer-logos">
            <a href="/salon.php">
                <img src="https://dummyimage.com/160x60/ffffff/000000&text=Salon" alt="Салон">
            </a>
            <a href="/partners.php">
                <img src="https://dummyimage.com/160x60/ffffff/000000&text=Partners" alt="Партнеры">
            </a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="/assets/js/main.js"></script>
<?php include __DIR__ . '/plugins/random-line/random_line.php'; ?>
</body>
</html>
