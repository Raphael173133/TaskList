<?php
require_once "bdd-crud.php";
session_start();

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    // Affiche pour debug si besoin
    // var_dump($_POST); exit;

    if (!empty($email) && !empty($password)) {
        $user_id = create_user($email, $password);
        if ($user_id !== null) {
            $_SESSION["user_id"] = $user_id;
            header("Location: index.php");
            exit;
        } else {
            $error = "Erreur : cet email est déjà utilisé.";
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Créer un compte</h1>

    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST">
        <label>Email :</label><br>
        <input type="email" name="email" required><br><br>

        <label>Mot de passe :</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>

    <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
</body>
</html>
