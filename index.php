<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="w-full h-screen bg-gray-400 p-4">
        <div class="w-full h-full bg-[url('img/fraisier.jpg')] bg-cover bg-center p-6 sm:p-10 flex items-center justify-center">
            <div class="w-full max-w-xl mx-auto bg-red-400 border-2 border-white rounded-lg p-5 sm:p-8 rounded-lg p-5 sm:p-8">
                <h1 class="text-center text-white text-4xl">Page d'inscription</h1>
                <form action="traitement.php" method="POST">
                    <div class="form_div">
                        <label class="form_div_label" for="username">Nom d'utilisateur</label>
                        <input class="w-full rounded-full px-4 py-2 mb-4 text-sm outline-none" type="text" id="username" name="username">
                    </div>
                    <div class="form_div">
                        <label class="form_div_label" for="email">email</label>
                        <input class="w-full rounded-full px-4 py-2 mb-4 text-sm outline-none" type="email" id="email" name="email">
                    </div>
                    <div class="form_div">
                        <label class="form_div_label" for="password">Mot de passe</label>
                        <input class="w-full rounded-full px-4 py-2 mb-4 text-sm outline-none" type="password" name="password" id="password">
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
                <a href="connexion.php">Déjà inscrit connecté vous</a>

            </div>
            
        </div>
    </div>
</body>
</html>