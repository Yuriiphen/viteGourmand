<?php
require_once dirname(__DIR__, 2) . '/includes/header.php';

if(!isset($_SESSION['user_role']) || 
   ($_SESSION['user_role'] != 'employe' && $_SESSION['user_role'] != 'admin')){
    header("Location: " . BASE_URL . "/pages/index.php");
    exit();
}



echo "<h1>Bienvenue ! Tu es connecté</h1>";
echo "<a href='" .BASE_URL . "/pages/mesCommandes.php'>Voir mes commandes</a><br>";
 if($_SESSION['user_role'] == 'employe'){
    echo "<a href='" .BASE_URL . "/admin/employe/employeCommandes.php'>Gérer les commandes</a><br>";
}
echo "<a href='" .BASE_URL . "/auth/logout.php'>Se déconnecter</a><br>";




require_once dirname(__DIR__, 2) . '/includes/footer.php';
