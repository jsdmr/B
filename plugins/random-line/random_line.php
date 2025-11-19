<?php
if (!isset($pdo)) {
    require_once __DIR__ . '/../../includes/functions.php';
}

$settings = include __DIR__ . '/settings.php';
$postId = (int)($settings['post_id'] ?? 0);
$interval = (int)($settings['refresh_interval'] ?? 12000);
$fact = $postId ? getRandomFactLine($pdo, $postId) : null;

if (!$fact) {
    return;
}

$line = htmlspecialchars($fact['line'], ENT_QUOTES, 'UTF-8');
$source = htmlspecialchars($fact['title'], ENT_QUOTES, 'UTF-8');
?>
<link rel="stylesheet" href="/plugins/random-line/random_line.css">
<div id="random-line-plugin" data-line="<?= $line ?>" data-source="<?= $source ?>" data-interval="<?= $interval ?>">
    <span class="line"></span>
    <span class="source"></span>
</div>
<script src="/plugins/random-line/random_line.js"></script>
