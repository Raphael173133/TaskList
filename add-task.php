<?php
require_once "bdd-crud.php";
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"] ?? '';
    $description = $_POST["description"] ?? '';
    $user_id = $_SESSION["user_id"];

    if (!empty($name)) {
        $task_id = add_task($name, $description, $user_id);

        if ($task_id !== null) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Erreur lors de l'ajout de la tâche.";
        }
    } else {
        $error = "Le nom de la tâche est requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une tâche</title>
    <link rel="stylesheet" href="style2.css">
  
</head>
<body>

    <div class="form-container">
        <h1>Ajouter une nouvelle tâche</h1>

        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <div class="form-group">
                <label for="name">Nom de la tâche :</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>

            <button type="submit">Ajouter</button>
        </form>

        <p><a href="index.php">← Retour à la liste des tâches</a></p>
    </div>

</body>
</html>
