<?php

$username = "";
$password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // récupération des données via l'attribut 'name' du champ HTML
    $username = $_POST['username'];
    $password = $_POST['password'];
}

echo $username;
echo $password;
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);