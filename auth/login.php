<?php
require_once dirname(__DIR__) . '/config/config.php';
require_once ROOT_PATH . '/includes/header.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM utilisateurs WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['mot_de_passe'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['user_role'] = $user['role'];

    if($user['role'] == 'employe'){
        header("Location: " . BASE_URL . "/admin/employe/dashboard.php");
        exit();
    }

    elseif($user['role'] == 'admin'){
        header("Location: " . BASE_URL . "/admin/dashboard.php");
        exit();
    }

    else{
        header("Location: " . BASE_URL . "/pages/index.php");
        exit();
}


    } else {
        $erreur = "Email ou mot de passe incorrect";
    }
}
?>

<h2>Connexion</h2>

<?php if(isset($erreur)) echo "<p style='color:red'>$erreur</p>"; ?>

<form method="POST">
    Email: <input type="email" name="email" required><br>
    Mot de passe: <input type="password" name="password" required><br>
    <button type="submit">Se connecter</button>
</form>
<?php
require_once ROOT_PATH . '/includes/footer.php';
