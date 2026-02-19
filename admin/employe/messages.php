<?php
require_once dirname(__DIR__, 2) . '/includes/header.php';

if(!isset($_SESSION['user_role']) || 
   ($_SESSION['user_role'] != 'employe' && $_SESSION['user_role'] != 'admin')){
    header("Location: " . BASE_URL . "/pages/index.php");
    exit();
}


$fichier = ROOT_PATH . '/data/messages.json';

if(file_exists($fichier)){
    $messages = json_decode(file_get_contents($fichier), true);
} else {
    $messages = [];
}
?>

<h1>Messages reçus</h1>

<?php if(empty($messages)): ?>
<p>Aucun message.</p>
<?php endif; ?>

<?php foreach($messages as $m): ?>
<div style="border:1px solid black; padding:10px; margin:10px;">
    <strong><?= htmlspecialchars($m['titre']) ?></strong><br>
    Email : <?= htmlspecialchars($m['email']) ?><br>
    Date : <?= $m['date'] ?><br><br>
    <?= nl2br(htmlspecialchars($m['description'])) ?>
</div>
<?php endforeach; 

require_once dirname(__DIR__,2) . '/includes/footer.php';
?>