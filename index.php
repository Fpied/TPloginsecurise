<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body class="body">
    <h1 class="body_h1">Login</h1>
    <form action="traitement.php" method="POST" class="body_form">
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
    
</body>
</html>