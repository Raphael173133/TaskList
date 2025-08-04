<?php
require_once "bdd-crud.php";
session_start();

// 🛑 Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$tasks = get_tasks_by_user_id($user_id); // Fonction à ajouter si ce n’est pas encore fait
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes tâches</title>

    <link rel="stylesheet" href="style1.css">

    

</head>
<body>
    <header>
        <a href="add-task.php">Ajouter une tâche</a> |
        <a href="logout.php">Déconnexion</a>
    </header>

    <h1>Liste de mes tâches</h1>

    <div class="tasks">
        <?php if (empty($tasks)): ?>
            <p>Aucune tâche pour le moment.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($tasks as $task): ?>
    <li>
        <strong><?= htmlspecialchars($task["name"]) ?></strong><br>
        <?= nl2br(htmlspecialchars($task["description"])) ?><br>
        <a href="delete-task.php?id=<?= $task["id"] ?>">Supprimer</a> |
        <a href="show-task.php?id=<?= $task["id"] ?>">Détails</a> |
        <?php if (!$task["is_done"]): ?>
            <a href="validate-task.php?id=<?= $task["id"] ?>">Valider</a>
        <?php endif; ?>
    </li>
    <hr>
<?php endforeach; ?>

            </ul>
        <?php endif; ?>
    </div>

    <?php if (!$task["is_done"]): ?>
    <a href="validate-task.php?id=<?= $task["id"] ?>">Valider</a> |
<?php endif; ?>

</body>
</html>

