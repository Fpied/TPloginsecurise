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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>dashboard</title>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="w-full h-screen bg-gray-400 p-4">
        <div class="w-full h-full bg-[url('img/fraisier.jpg')] bg-cover bg-center p-6 sm:p-10 flex items-center justify-center">
            <div class="w-full max-w-xl mx-auto bg-red-400 border-2 border-white rounded-lg p-5 sm:p-8">
                <h1 class="text-center text-white text-4xl">Bienvenu dans votre dashboard <?php echo htmlspecialchars($username);  ?></h1>
                <a class="block text-center text-white mt-4" href="list_user.php">Liste d'utilisateur</a>
                <a href="logout.php" class="block text-center text-white mt-4">Déconnexion</a>

            </div>

        </div>
    </div>
    
    
</body>
</html>