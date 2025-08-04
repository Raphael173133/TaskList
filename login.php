<?php
require_once "bdd-crud.php";
session_start();

// Si déjà connecté, on redirige
if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    if (!empty($email) && !empty($password)) {
        $user = get_user_by_email($email);

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit;
        } else {
            $error = "Email ou mot de passe incorrect.";
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
    <title>Connexion</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>

    <div class="form-container">
        <h1>Connexion</h1>

        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <label for="email">Email :</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Mot de passe :</label><br>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Se connecter</button>
        </form>

        <p>Pas encore inscrit ? <a href="inscription.php">Créer un compte</a></p>
    </div>

</body>
</html>
