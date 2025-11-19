<?php
require_once __DIR__ . '/includes/functions.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Художественный салон «Губернаторский»</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<?php include __DIR__ . '/partials/simple-header.php'; ?>

<main class="section">
    <div class="container two-columns">
        <div>
            <p class="eyebrow">Художественный салон</p>
            <h1>«Губернаторский»</h1>
            <p>Салон объединяет лучших мастеров декоративно-прикладного искусства региона. Здесь можно приобрести авторскую керамику, текстиль, графику и украшения, созданные специально для музея.</p>
            <ul class="contact-list">
                <li><strong>Адрес:</strong> проспект Ленина, 20</li>
                <li><strong>Часы работы:</strong> ежедневно с 11:00 до 21:00</li>
                <li><strong>Телефон:</strong> +7 (351) 400-55-22</li>
            </ul>
        </div>
        <img src="https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?auto=format&fit=crop&w=900&q=80" alt="Салон Губернаторский">
    </div>
</main>

<section class="section partners-highlight">
    <div class="container">
        <h2>Программы салона</h2>
        <div class="partner-list">
            <article>
                <h3>Камерные выставки</h3>
                <p>Каждый месяц в салоне проходит выставка одного автора или небольшой творческой группы.</p>
            </article>
            <article>
                <h3>Салонные беседы</h3>
                <p>Теплые встречи с художниками, коллекционерами и искусствоведами в формате открытых бесед.</p>
            </article>
            <article>
                <h3>Образовательные курсы</h3>
                <p>Мастер-классы по каллиграфии, созданию фарфора, авторской керамике и текстилю.</p>
            </article>
        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/simple-footer.php'; ?>
<?php include __DIR__ . '/plugins/random-line/random_line.php'; ?>
</body>
</html>
