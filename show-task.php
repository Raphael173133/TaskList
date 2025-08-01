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
</head>
<body>
    <h1>Détails de la tâche</h1>

    <p><strong>Nom :</strong> <?= htmlspecialchars($task["name"]) ?></p>
    <p><strong>Description :</strong><br><?= nl2br(htmlspecialchars($task["description"])) ?></p>
    <p><strong>Statut :</strong> <?= $task["is_done"] ? "✔️ Terminée" : "⏳ En cours" ?></p>

    <p><a href="index.php">← Retour à la liste</a></p>
</body>
</html>
