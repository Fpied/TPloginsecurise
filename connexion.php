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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>connexion</title>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <!-- Div fond gris -->
     <div class="w-full h-screen bg-gray-400 p-4">
        <div class="w-full h-full bg-[url('img/fraisier.jpg')] bg-cover bg-center p-6 sm:p-10 flex items-center justify-center">
            <div class="w-full max-w-xl mx-auto bg-red-400 border-2 border-white rounded-lg p-5 sm:p-8 rounded-lg p-5 sm:p-8">
                <h1 class="text-center text-white text-4xl">Connexion</h1>
                <form method="POST" class="body_form">
                    <div class="form_div">
                        <label class="form_div_label" for="username">Nom d'utilisateur</label>
                        <input class="w-full rounded-full px-4 py-2 mb-4 text-sm outline-none" type="text" id="username" name="username">
                    </div>
                    <div class="form_div">
                        <label class="form_div_label" for="password">Mot de passe</label>
                        <input class="w-full rounded-full px-4 py-2 mb-4 text-sm outline-none" name="password" id="password">
                    </div>
                    <button class="w-full text-white text-lg py-2 hover:text-gray-200" id="send" type="submit">Envoyé</button>
                    
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

                <a href="index.php">Pas encore inscrit ? inscrivez-vous</a>

            </div>

        </div>
        

     </div>
    
    
</body>
</html>