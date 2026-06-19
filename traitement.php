<?php



$username = "";
$password = "";
$error = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // récupération des données via l'attribut 'name' du champ HTML
    $username = trim($_POST['username']);
    $password = $_POST['password'];
}

if(!empty($username)){
    if(!empty($password)){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    } else{
        $error[] = "un mot de passe doit être entré";
        $_SESSION['error'] = $error;
        header("Location: index.php");
        exit;

    }


} else{
    $error[] = "un nom d'utilisateur doit être entré";
    $_SESSION['error'] = $error;
    header("Location: index.php");
    exit;

}

echo $username;
echo $password;
