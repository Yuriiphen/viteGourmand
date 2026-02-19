<?php
require_once dirname(__DIR__) . '/includes/header.php';




$stmt = $pdo->query("
SELECT avis.*, utilisateurs.prenom
FROM avis
JOIN utilisateurs ON avis.utilisateur_id = utilisateurs.id
WHERE valide = 1
ORDER BY date_avis DESC
LIMIT 5
");

$avis = $stmt->fetchAll();
?>

<h1>Bienvenue sur Vite & Gourmand</h1>

<p>
Julie et José sont fier de vous présenter leur entreprise de restauration basée à Bordeaux depuis 25ans, en vous proposant différentes prestations pour tous vos événements.
(Repas de Noël, Pâques, repas d'entreprise, mariages...)
</p><br>
<p>
Grace à son expérience, Vite & Gourmand met un point d'honneur à offrir un service de qualité, sérieux et organisé. De la préparattion, jusqu'à la livraison.
</p><br>
<p>
Toujours à l'écoute des ses clients, Vite & Gourmand assure un suivi des commandes et reste disponible pour répondre aux demandes spécifiques, dans le but de proposer une prestation fiable.
</p>

<hr>

<?php if(isset($_SESSION['user_id'])): ?>

    <h3>Espace utilisateur</h3>
    <p>Bonjour <?= htmlspecialchars($_SESSION['prenom']) ?></p>
    
    <a href="<?= BASE_URL ?>/pages/mesCommandes.php">Mes commandes</a><br>
    <a href="<?= BASE_URL ?>/auth/logout.php">Se déconnecter</a>
    <hr>
<?php endif; ?>

<h2>Avis clients</h2>

<?php if(count($avis) == 0): ?>
    <p>Aucun avis pour le moment.</p>
    <?php else: 
     foreach($avis as $a): ?>
        <div style="border:1px solid gray; padding:10px; margin:10px;">
            <strong><?= htmlspecialchars($a['prenom']) ?></strong>
            (<?= htmlspecialchars($a['note']) ?>/5)<br>
            <?= nl2br(htmlspecialchars($a['commentaire'])) ?>
        </div>
    <?php endforeach; 
     endif; 

require_once dirname(__DIR__) . '/includes/footer.php';
 ?>