
<?php
require_once dirname(__DIR__) . '/config/db.php';

header('Content-type: application/json');

$stmt = $pdo->query("SELECT * FROM menus");
$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($menus);