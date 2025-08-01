<?php
require_once "bdd-crud.php";
session_start();

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Vérifie qu'un ID est passé en GET
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$task_id = (int) $_GET["id"];
$user_id = $_SESSION["user_id"];

// Marque la tâche comme terminée si elle appartient à l'utilisateur
validate_task($task_id, $user_id);

// Redirection vers l'accueil
header("Location: index.php");
exit;
?>
