
<?php
require_once dirname(__DIR__) . '/config/db.php';

header('Content-Type: application/json');

$prixMax = $_GET['prixMax'] ?? null;

if ($prixMax) {
    $stmt = $pdo->prepare("SELECT * FROM menus WHERE prix <= ?");
    $stmt->execute([$prixMax]);
} else {
    $stmt = $pdo->query("SELECT * FROM menus");
}

$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($menus);