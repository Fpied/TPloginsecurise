<?php
require_once 'config.php';

// 1. Vérification de sécurité (session et présence de l'ID)
if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: list_user.php"); // Redirection si erreur
    exit;
}

$id_a_supprimer = (int)$_GET['id'];
$id_connecte = $_SESSION['user_id'];

// 2. SECURITE : Empêcher l'auto-suppression
if($id_a_supprimer == $id_connecte){
    // Optionnel : Vous pouvez rediriger avec un message d'erreur spécifique
    header("Location: list_user.php?error=cannot_delete_self");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM login WHERE id = :id");
$stmt->execute([':id' => $id_a_supprimer]);

// 3. Redirection immédiate vers la liste
// L'utilisateur ne voit JAMAIS cette page, il est renvoyé à la liste
header("Location: list_user.php?msg=deleted");
exit(); // Important : arrêter le script ici pour éviter tout code suivant
?>