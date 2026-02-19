


<?php
require_once dirname(__DIR__) . '/includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe)
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $email, $password]);

    echo "Compte créé ! <a href='" .  BASE_URL . "/pages/login.php'>Se connecter</a>";
}
?>

<h2>Inscription</h2>
<form method="POST">
    Nom: <input type="text" name="nom" required><br>
    Prénom: <input type="text" name="prenom" required><br>
    Email: <input type="email" name="email" required><br>
    Mot de passe: <input type="password" name="password" required><br>
    <button type="submit">Créer mon compte</button>
</form>
<?php 
require_once dirname(__DIR__) . '/includes/footer.php'; 
?>