<?php
require_once 'fonction.ini.php';
$connexion = connexion();

if(isset($_POST['username']) && !empty($_POST['username'])) {
    $result = $connexion->query('select * from users where username="'.$_POST['username'].'" and password="'.sha1($_POST['password']).'"');

    if($result->rowCount() >=1 ) {
        //Todo: Faire le message de succès / Redirection
    } else {
        $error = "Erreur dans la connexion, verifier votre username et mot de passe";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form method="POST">
        <div>
            <input type="hidden" name="ninja" value="je suis un ninja"/>
        </div>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" />
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" />
        </div>
        <button typ="submit">Connexion</button>
    </form>
    <?php if(isset($error) && !empty($error)) {
        echo '<p>'.$error.'</p>';
    }
    ?>
</body>
</html>