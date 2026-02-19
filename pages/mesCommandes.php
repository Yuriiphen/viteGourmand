<?php
require_once dirname(__DIR__) . '/includes/header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "
SELECT commandes.*, menus.titre 
FROM commandes
JOIN menus ON commandes.menu_id = menus.id
WHERE utilisateur_id = ?
ORDER BY date_commande DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$commandes = $stmt->fetchAll();
?>

<h1>Mes commandes</h1>

<?php if(empty($commandes)): ?>
    <p>Vous n'avez aucune commande.</p>
<?php else: ?>

<table border="2" cellpadding="5">
<tr>
    <th>Menu</th>
    <th>Nombre de personnes</th>
    <th>Date</th>
    <th>Statut</th>
</tr>

<?php foreach($commandes as $c): ?>
    <tr>
        <td><?= htmlspecialchars($c['titre']) ?></td>
        <td><?= $c['nb_personnes'] ?></td>
        <td><?= $c['date_commande'] ?></td>
        <td><?= $c['statut'] ?></td>
        <td>
            <a href="laisserAvis.php?id=<?= $c['id'] ?>">Laisser un avis</a>
        </td>
    </tr>
<?php endforeach; ?>


</table>

<?php endif;
require_once dirname(__DIR__) . '/includes/footer.php';
?>