<?php
require_once "bdd-crud.php";
session_start();

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Vérifie que l'ID est présent
if (isset($_GET["id"])) {
    $task_id = (int) $_GET["id"];
    $user_id = $_SESSION["user_id"];

    // Supprimer la tâche
    $success = delete_task($task_id, $user_id);

    // Redirection vers la page d'accueil, avec ou sans succès
    header("Location: index.php");
    exit;
} else {
    // Pas d'ID fourni
    header("Location: index.php");
    exit;
}
?>
