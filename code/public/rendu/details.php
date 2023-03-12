<?php
require_once 'fonction.ini.php';
$connexion = connexion();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `games` WHERE `id` = :id;';

    $query = $connexion->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $jeu = $query->fetch();

    if(!$jeu){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: read.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: read.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du jeu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Détails du jeu <?= $jeu['nom'] ?></h1>
                <p>ID : <?= $jeu['id'] ?></p>
                <p>Nom : <?= $jeu['nom'] ?></p>
                <p>Année : <?= $jeu['annee'] ?></p>
                <p>Créateur : <?= $jeu['createur'] ?></p>
                <p>Âge : <?= $jeu['age'] ?></p>
                <p><a href="read.php" class="btn btn-danger">Retour</a> <a href="update.php?id=<?= $jeu['id'] ?>" class="btn btn-light">Modifier</a></p>
            </section>
        </div>
    </main>
</body>
</html>