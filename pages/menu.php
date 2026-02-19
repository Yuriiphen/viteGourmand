<?php
require_once dirname(__DIR__) . '/includes/header.php';

$stmt = $pdo->query("SELECT * FROM menus");
$menus = $stmt->fetchAll();
?>

<h1>Nos menus</h1>

<?php foreach($menus as $menu): ?>
    <div style="border:1px solid black; padding:10px; margin:10px;">
        <h2><?= htmlspecialchars($menu['titre']) ?></h2>
        <p><?= htmlspecialchars($menu['description']) ?></p>
        <p>Prix : <?= $menu['prix'] ?> €</p>
        <p>Minimum : <?= $menu['nb_personne_min'] ?> personnes</p>
        <p>Stock disponible : <?= $menu['stock'] ?></p>

        <a href="<?= BASE_URL ?>/pages/menuDetail.php?id=<?= $menu['id'] ?>">Voir le détail</a>
    </div>
<?php endforeach; ?>
<?php 
require_once dirname(__DIR__) . '/includes/footer.php';
?>