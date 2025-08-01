<?php
// TODO Destruction de la session pour déconnecter l'utilisateur et redirection vers la page de connexion


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disconnect</title>
</head>
<body>
    
</body>
</html>

<?php
session_start();
session_unset();    // Supprime toutes les variables de session
session_destroy();  // Détruit complètement la session

header("Location: login.php");
exit;
?>
