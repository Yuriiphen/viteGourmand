<?php

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/config/db.php';

session_start();

if(!isset($_SESSION['user_role']) || 
   ($_SESSION['user_role'] != 'employe' && $_SESSION['user_role'] != 'admin')){
    header("Location: " . BASE_URL . "/pages/index.php");
    exit();
}


$id = intval($_GET['id']);

$stmt = $pdo->prepare("DELETE FROM avis WHERE id = ?");
$stmt->execute([$id]);

header("Location: " . BASE_URL . "/admin/employe/gestion_avis.php");
exit();