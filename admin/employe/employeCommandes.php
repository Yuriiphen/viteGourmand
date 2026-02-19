<?php
require_once dirname(__DIR__, 2) . '/includes/header.php';

if(!isset($_SESSION['user_role']) || 
   ($_SESSION['user_role'] != 'employe' && $_SESSION['user_role'] != 'admin')){
    header("Location: " . BASE_URL . "/pages/index.php");
    exit();
}


$sql = "
SELECT commandes.*, menus.titre, utilisateurs.nom, utilisateurs.prenom
FROM commandes
JOIN menus ON commandes.menu_id = menus.id
JOIN utilisateurs ON commandes.utilisateur_id = utilisateurs.id
ORDER BY date_commande DESC
";

$stmt = $pdo->query($sql);
$commandes = $stmt->fetchAll();
?>

<h1>Gestion des commandes</h1>

<table border="1" cellpadding="5">
<tr>
    <th>Client</th>
    <th>Menu</th>
    <th>Personnes</th>
    <th>Date</th>
    <th>Statut</th>
    <th>Action</th>
</tr>

<?php foreach($commandes as $c): ?>
<tr>
    <td><?= htmlspecialchars($c['prenom'].' '.$c['nom']) ?></td>
    <td><?= htmlspecialchars($c['titre']) ?></td>
    <td><?= $c['nb_personnes'] ?></td>
    <td><?= $c['date_commande'] ?></td>
    <td><?= $c['statut'] ?></td>
    <td>
        <a href="<?= BASE_URL ?>statutCommandes.php?id=<?= $c['id'] ?>&s=accepte">Accepter</a>
        <a href="<?= BASE_URL ?>statutCommandes.php?id=<?= $c['id'] ?>&s=livre">Livré</a>
    </td>
</tr>
<?php endforeach; ?>

</table>
<?php
require_once dirname(__DIR__,2) . '/includes/footer.php';