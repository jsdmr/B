<?php
require_once __DIR__ . '/db.php';

function getFeaturedExhibits(PDO $pdo, int $limit = 6): array
{
    $stmt = $pdo->prepare('SELECT * FROM exhibits WHERE is_featured = 1 ORDER BY year_created LIMIT :limit');
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getCategories(PDO $pdo): array
{
    $stmt = $pdo->query('SELECT DISTINCT category FROM exhibits ORDER BY category');
    return array_filter(array_column($stmt->fetchAll(), 'category'));
}

function getExhibits(PDO $pdo, ?string $category, int $limit, int $offset, int &$total): array
{
    if ($category) {
        $countStmt = $pdo->prepare('SELECT COUNT(*) as cnt FROM exhibits WHERE category = :cat');
        $countStmt->execute(['cat' => $category]);
        $total = (int) $countStmt->fetchColumn();

        $stmt = $pdo->prepare('SELECT * FROM exhibits WHERE category = :cat ORDER BY year_created LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':cat', $category);
    } else {
        $countStmt = $pdo->query('SELECT COUNT(*) FROM exhibits');
        $total = (int) $countStmt->fetchColumn();

        $stmt = $pdo->prepare('SELECT * FROM exhibits ORDER BY year_created LIMIT :limit OFFSET :offset');
    }

    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getExhibitById(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare('SELECT * FROM exhibits WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $exhibit = $stmt->fetch();
    return $exhibit ?: null;
}

function getExhibitImages(PDO $pdo, int $exhibitId): array
{
    $stmt = $pdo->prepare('SELECT * FROM exhibit_images WHERE exhibit_id = :id');
    $stmt->execute(['id' => $exhibitId]);
    return $stmt->fetchAll();
}

function getExhibitLinks(PDO $pdo, int $exhibitId): array
{
    $stmt = $pdo->prepare('SELECT * FROM exhibit_links WHERE exhibit_id = :id');
    $stmt->execute(['id' => $exhibitId]);
    return $stmt->fetchAll();
}

function saveVisitRequest(PDO $pdo, array $payload): bool
{
    $stmt = $pdo->prepare('INSERT INTO visit_requests (visit_date, visit_time, name, whatsapp) VALUES (:visit_date, :visit_time, :name, :whatsapp)');
    return $stmt->execute([
        'visit_date' => $payload['visit_date'],
        'visit_time' => $payload['visit_time'],
        'name'       => $payload['name'],
        'whatsapp'   => $payload['whatsapp'],
    ]);
}

function getRandomFactLine(PDO $pdo, int $postId): ?array
{
    $stmt = $pdo->prepare('SELECT title, content FROM facts_posts WHERE id = :id');
    $stmt->execute(['id' => $postId]);
    $post = $stmt->fetch();
    if (!$post) {
        return null;
    }
    $lines = preg_split('/\r?\n/', trim($post['content']));
    $lines = array_values(array_filter(array_map('trim', $lines)));
    if (!$lines) {
        return null;
    }
    $line = $lines[array_rand($lines)];
    return ['title' => $post['title'], 'line' => $line];
}
