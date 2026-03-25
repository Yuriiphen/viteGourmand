<?php
require_once dirname(__DIR__) . '/includes/header.php';

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("Location: " . BASE_URL . "/pages/menu.php");
    exit();
}

$id = intval($_GET['id']);

$stmt = $pdo->prepare("SELECT * FROM menus WHERE id = ?");
$stmt->execute([$id]);
$menu = $stmt->fetch();

$stmtPlats = $pdo->prepare("
    SELECT plats.nom, plats.categorie
    FROM plats
    JOIN menu_plat ON plats.id = menu_plat.plat_id
    WHERE menu_plat.menu_id = ?
    ORDER BY plats.categorie
");

$stmtPlats->execute([$id]);
$plats = $stmtPlats->fetchAll();


if(!$menu){
    header("Location: " . BASE_URL . "/pages/menu.php");
    exit();
}
?>

<h1><?= htmlspecialchars($menu['titre']) ?></h1>

<p><?= htmlspecialchars($menu['description']) ?></p>
<p>Prix : <?= $menu['prix'] ?> €</p>
<p>Minimum : <?= $menu['nb_personne_min'] ?> personnes</p>
<p>Stock restant : <?= $menu['stock'] ?></p>
<h2>Composition du menu</h2>

<?php
$currentCategorie = '';

foreach($plats as $plat):

    // si on change de catégorie → afficher un titre
    if($plat['categorie'] != $currentCategorie):
        $currentCategorie = $plat['categorie'];

        if($currentCategorie == 'entree') echo "<h3>Entrées</h3>";
        if($currentCategorie == 'plat') echo "<h3>Plats</h3>";
        if($currentCategorie == 'dessert') echo "<h3>Desserts</h3>";
    endif;
?>

<p>• <?= htmlspecialchars($plat['nom']) ?></p>

<?php endforeach; ?>


<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'user'): ?>
    <a href="<?= BASE_URL ?>/pages/commander.php?id=<?= $menu['id'] ?>">Commander ce menu</a><br><br>
<?php else: ?>
    <p><em>Seuls les clients peuvent passer commande.</em></p>
<?php endif; ?>

<a href="<?= BASE_URL ?>/pages/menu.php">Retour aux menus</a>

<?php 


require_once dirname(__DIR__) . '/includes/footer.php';


?>
