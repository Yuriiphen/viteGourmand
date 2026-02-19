<?php
require_once dirname(__DIR__, 2) . '/includes/header.php';

if(!isset($_SESSION['user_role']) || 
   ($_SESSION['user_role'] != 'employe' && $_SESSION['user_role'] != 'admin')){
    header("Location: " . BASE_URL . "/pages/index.php");
    exit();
}


$stmt = $pdo->query("
SELECT avis.*, utilisateurs.prenom
FROM avis
JOIN utilisateurs ON avis.utilisateur_id = utilisateurs.id
WHERE valide = 0
");

$avis = $stmt->fetchAll();
?>

<h1>Validation des avis</h1>

<?php if(empty($avis)): ?>
<p>Aucun avis en attente.</p>
<?php endif; ?>

<?php foreach($avis as $a): ?>
<div style="border:1px solid black; padding:10px; margin:10px;">
    <strong><?= htmlspecialchars($a['prenom']) ?></strong><br>
    Note : <?= $a['note'] ?>/5<br>
    <?= htmlspecialchars($a['commentaire']) ?><br><br>

    <a href="<?= BASE_URL ?>validationAvis.php?id=<?= $a['id'] ?>">Valider</a> |
    <a href="<?= BASE_URL ?>refusAvis.php?id=<?= $a['id'] ?>">Refuser</a>
</div>
<?php endforeach;

require_once dirname(__DIR__,2) . '/includes/footer.php';
?>