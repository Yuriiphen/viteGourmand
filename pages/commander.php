<?php
require_once dirname(__DIR__) . '/includes/header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: " . BASE_URL . "/auth/login.php");
    exit();
}
if(!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'utilisateur'){
    header("Location: " . BASE_URL . "/pages/index.php");
    exit();
}

$menu_id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM menus WHERE id=?");
$stmt->execute([$menu_id]);
$menu = $stmt->fetch();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nb_personnes = $_POST['nb_personnes'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO commandes (utilisateur_id, menu_id, nb_personnes)
            VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $menu_id, $nb_personnes]);

    echo "<h2>Commande enregistrée</h2>";
    exit();
}
?>

<h1>Commander : <?= htmlspecialchars($menu['titre']) ?></h1>

<form method="POST">
    Nombre de personnes :
    <input type="number" name="nb_personnes" min="1" max="10" required>
    <button type="submit">Valider la commande</button>
</form>

<?php
require_once dirname(__DIR__) . '/includes/footer.php';
?>