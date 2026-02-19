<?php
require_once dirname(__DIR__, 2) . '/includes/header.php';

if(!isset($_SESSION['user_role']) || 
   ($_SESSION['user_role'] != 'employe' && $_SESSION['user_role'] != 'admin')){
    header("Location: " . BASE_URL . "/pages/index.php");
    exit();
}


$id = $_GET['id'];
$statut = $_GET['s'];

$autorises = ['accepte','preparation','livre'];

if(!in_array($statut, $autorises)){
    die("Statut invalide");
}

$sql = "UPDATE commandes SET statut=? WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$statut, $id]);

header("Location: " . BASE_URL . "/admin/employe/employeCommandes.php");
exit();
require_once dirname(__DIR__,2) . '/includes/footer.php';
?>