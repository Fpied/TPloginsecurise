<?php

require_once 'config.php';

if(!isset($_SESSION['user_id']) || !isset($_GET['id'])){
    header("Location: list_user.php");
    exit;
}

$id_utilisateur = $_GET['id'];

// 2. Requête SQL avec filstre WHERE sur l'ID
// On sélectionne uniquement la ligne correspondant à cet ID
$stmt = $pdo->prepare("SELECT id, username, email, date FROM login WHERE id=:id");
$stmt->execute([':id' => $id_utilisateur]);

// 3. Récupération du résultat
// On utilise fetch() car on attend une seule ligne (ou false si introuvable)
$utilisateur = $stmt->fetch();

// Si l'utilisateur n'existe pas, on redirige ou on affiche un message
if(!$utilisateur){
    die("Utilisateur introuvable.");
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Profils de <? htmlspecialchars($utilisateur['nom']) ?></title>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="w-full h-screen bg-gray-400 p-4">
        <div class="w-full h-full bg-[url('img/fraisier.jpg')] bg-cover bg-center p-6 sm:p-10 flex items-center justify-center">
            <div class="w-full  mx-auto bg-red-400 border-2 border-white rounded-lg p-5 sm:p-8 overflow-auto"">
                <h1 class="text-center text-white text-4xl">Bienvenu dans la liste des profils</h1>
                <table class="w-full border-collapse border-white text-white whitespace-nowrap">
                    <thead>
                        <tr class="bg-red-500 bg-opacity-50">
                            <th class="border border-white p-3 text-left">Nom</th>
                            <th class="border border-white p-3 text-left">Email</th>
                            <th class="border border-white p-3 text-left">Date d'inscription</th>
                            <th class="border border-white p-3 text-center">Voir le profil</th>
                            <th class="border border-white p-3 text-center">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <tr class="hover:bg-red-500 hover:bg-opacity-30 transition overflow-x-auto">
                                <!-- Affichage sécurisé des données -->
                                 <td class="border border-white p-3"><?= htmlspecialchars($utilisateur['username'] ?? 'Inconnu') ?></td>
                                 <td class="border border-white p-3"><?= htmlspecialchars($utilisateur['email']) ?></td>
                                 <td class="border border-white p-3"><?= htmlspecialchars($utilisateur['date']) ?></td>
                                 <td class="border border-white p-3 text-center"><a class="text-blue-200 hover:text-white font-bold underline" href="profil.php?id=<?= $utilisateur['id'] ?>">Voir le profil</a></td>
                                 <td class="border border-white p-3 text-center"><a class="text-blue-200 hover:text-white font-bold underline" href="delete.php?id=<?=  $utilisateur['id'] ?>">Supprimer</a></td>
                            </tr>
                        
                    </tbody>
                </table>
                <a href="list_user.php" class="block text-center text-white mt-4">Retour à la liste des profils</a>
                <a href="logout.php" class="block text-center text-white mt-4">Déconnexion</a>

            </div>

        </div>
    </div>
    
</body>
</html>