<?php
require_once dirname(__DIR__) . '/includes/header.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST['email'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    $fichier = 'messages.json';

    if(file_exists($fichier)){
        $messages = json_decode(file_get_contents($fichier), true);
    } else {
        $messages = [];
    }

    $messages[] = [
        "email" => $email,
        "titre" => $titre,
        "description" => $description,
        "date" => date("Y-m-d H:i:s")
    ];

    file_put_contents($fichier, json_encode($messages, JSON_PRETTY_PRINT));

    echo "<p>Votre message a bien été envoyé à l'entreprise.</p>";
}
?>

<h1>Contact</h1>

<form method="POST">
    Votre email :<br>
    <input type="email" name="email" required><br><br>

    Titre :<br>
    <input type="text" name="titre" required><br><br>

    Description :<br>
    <textarea name="description" required></textarea><br><br>

    <button type="submit">Envoyer</button>
</form>

<?php
require_once dirname(__DIR__) . '/includes/footer.php';
 ?>