<?php
require_once "bdd-crud.php";
session_start();

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Vérifie qu'un ID est passé
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$task_id = (int) $_GET["id"];
$user_id = $_SESSION["user_id"];

// Récupère la tâche sécurisée
$task = get_task_by_id_and_user($task_id, $user_id);

// Si la tâche n'existe pas ou n'appartient pas à l'utilisateur
if (!$task) {
    echo "<p style='color:red;'>Tâche introuvable ou accès interdit.</p>";
    echo "<p><a href='index.php'>Retour</a></p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail de la tâche</title>

    <link rel="stylesheet" href="style3.css">

</head>
<body>

    <div class="task-container">
        <h1>Détails de la tâche</h1>

        <div class="task-detail">
            <label>Nom :</label>
            <p><?= htmlspecialchars($task["name"]) ?></p>
        </div>

        <div class="task-detail">
            <label>Description :</label>
            <p><?= htmlspecialchars($task["description"]) ?></p>
        </div>

        <div class="task-detail">
            <label>Statut :</label>
            <p><?= $task["is_done"] ? "✔️ Terminée" : "⏳ En cours" ?></p>
        </div>

        <a href="index.php">← Retour à la liste</a>
    </div>

</body>
</html>
