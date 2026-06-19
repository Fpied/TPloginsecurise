<?php

require_once 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT id, username, password FROM login WHERE username = :username");
$stmt->execute([':username' => $username]);
$user = $stmt->fetch();


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
</head>
<body>
    <h1>Bienvenu dans votre dashboard <?php echo htmlspecialchars($username);  ?></h1>
    <a href="logout.php">Déconnexion</a>
    
</body>
</html>