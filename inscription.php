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

    <link rel="stylesheet" href="style4.css">

   
</head>
<body>

    <div class="form-container">
        <h1>Créer un compte</h1>

        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">S'inscrire</button>
        </form>

        <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
    </div>

</body>
</html>
