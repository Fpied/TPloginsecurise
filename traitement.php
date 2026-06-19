<?php
require_once 'config.php';

if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit;
}

$error = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // récupération des données via l'attribut 'name' du champ HTML
    $username = trim($_POST['username'] ?? "");
    $password = $_POST['password'] ?? "";

    if(empty($username) || empty($password)){
            $error[] = "Veuillez remplir tous les champs.";
            $_SESSION['error'] = $error;
            header("Location: index.php");
            exit;
        }

    if(empty($error)){
        // vérifier si l'utilisateur existe en base de données
        $stmt = $pdo->prepare("SELECT id FROM login WHERE username = :username ");
        $stmt->execute([':username' => $username]);

        

        if($stmt->fetch()){
            $error[] = "Le nom d'utilisateur est déjà utilisé.";
        } else{
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insérer dans la base de donnée;

            $insert = $pdo->prepare("INSERT INTO login (username, password) VALUE(:username, :password)");
            $insert->execute([
                ':username' => $username, ':password' => $hashedPassword
            ]);

            $_SESSION['success_message'] = "Inscription réussi ! vous pouvez vous connecter";
            header("Location: connexion.php");
            exit;

        }
    } 
}





