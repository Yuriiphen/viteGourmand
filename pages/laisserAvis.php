<?php
require_once dirname(__DIR__) . '/includes/header.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (!isset($_GET['id'])) {
        header('Location: index.php');
        exit;
    }

    $commande_id = intval($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['commande_id'])) {
        header("Location: " . BASE_URL . "/pages/index.php");
        exit;
    }

    $commande_id = intval($_POST['commande_id']);
    $note = intval($_POST['note']);
    $commentaire = $_POST['commentaire'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO avis (utilisateur_id, commande_id, note, commentaire, valide, date_avis)
            VALUES (?, ?, ?, ?, 0, NOW())";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $commande_id, $note, $commentaire]);

    header("Location: " . BASE_URL . "/auth/login.php");
    exit();
}
?>

<h2>Laisser un avis</h2>

<form method="POST">
    <input type="hidden" name="commande_id" value="<?= $commande_id ?>">

    Note (1 à 5) :
    <input type="number" name="note" min="1" max="5" required><br>

    Commentaire :
    <textarea name="commentaire" required></textarea><br>

    <button type="submit">Envoyer</button>
</form>
<?php
require_once dirname(__DIR__) . '/includes/footer.php';
 ?>