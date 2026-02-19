<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    require_once __DIR__ . '/../config/db.php';
    require_once __DIR__ . '/../config/config.php';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vite & Gourmand</title>
</head>
<body>

<nav>
    <a href="<?= BASE_URL ?>/pages/index.php">Accueil</a> |
    <a href="<?= BASE_URL ?>/pages/menu.php">Menus</a> |
    <a href="<?= BASE_URL ?>/pages/contact.php">Contact</a>

    <?php if(isset($_SESSION['user_id'])): ?>

        | <a href="mesCommandes.php">Mes commandes</a>

    <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'employe'): ?>

        | <a href="<?= BASE_URL ?>/admin/employe/gestionAvis.php">Gérer les avis</a>
        | <a href="<?= BASE_URL ?>/admin/employe/messages.php">Messages clients</a>

    <?php endif; ?>

        | <a href="<?= BASE_URL ?>/auth/logout.php">Déconnexion</a>

    <?php else: ?>

        | <a href="<?= BASE_URL ?>/auth/login.php">Connexion</a>
        | <a href="<?= BASE_URL ?>/auth/register.php">Inscription</a>

    <?php endif; ?>

</nav>
<hr>
