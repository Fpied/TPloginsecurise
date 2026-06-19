<?php

require_once 'config.php';

if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit;
}

$error = [];

if($_SERVER["REQUEST_METHOD"] === "POST"){
    // récupération des données html
    $username = trim($_POST['username'] ?? "");
    $password = $_POST['password'] ?? "";

    if(empty($username) || empty($password)){
        $error[] = "Veuillez remplir tous les champs.";
        $_SESSION['error'] = $error;
        header("Location: connexion.php");
        exit;
    }

        if(empty($error)){
        // Vérifier si l'utilisateur existe en base de données
        $stmt = $pdo->prepare("SELECT id, password FROM login WHERE username = :username");
        $stmt->execute([':username' => $username]);


        $user = $stmt->fetch();

        if($user){
            $hashedPasswordFromDatabase = $user["password"];
            if(password_verify($password, $hashedPasswordFromDatabase)){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit;
            }
            else{
                $error[] = "Le nom d'utilisateur ou le mot de passe n'est pas valide";
                $_SESSION['error'] = $error;
                header("Location: connexion.php");
                exit;

            }

        } else{
            $error[] = "L'utilisateur n'a pas été trouvé";
            $_SESSION['error'] = $error;
            header("Location: connexion.php");
            exit;
        }

        

    }
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
</head>
<body class="body">
    <h1>Connexion</h1>
    <form method="POST" class="body_form">
        <div class="form_div">
            <label class="form_div_label" for="username">Nom d'utilisateur</label>
            <input class="form_div_input" type="text" id="username" name="username">
        </div>
        <div class="form_div">
            <label class="form_div_label" for="password">Mot de passe</label>
            <input class="form_div_input" type="password" name="password" id="password">
        </div>
        <button class="form_button" id="send" type="submit">Envoyé</button>
        
    </form>
    <!-- Affichage des erreurs -->
     <?php if (isset($_SESSION['error'])) :?>
        <div style="color: red;">
            <ul>
                <?php foreach ($_SESSION['error'] as $error) : ?>
                    <li><?= htmlspecialchars($error)  ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php
    // Nettoyage des erreurs
    unset($_SESSION['error']);
    ?>
    <?php endif; ?>
    
</body>
</html>